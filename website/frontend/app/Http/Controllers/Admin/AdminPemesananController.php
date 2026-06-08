<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\SlotParkir;
use App\Models\User;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminPemesananController extends Controller
{
    /**
     * Display a listing of pemesanan.
     */
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'slotParkir.lokasiParkir', 'kendaraan', 'pembayaran'])
            ->latest();

        // ── FILTER: search ──────────────────────────────────────────────
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_pemesanan', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%")
                                                    ->orWhere('email', 'like', "%{$search}%"))
                  ->orWhereHas('kendaraan', fn($k) => $k->where('plat_nomor', 'like', "%{$search}%"));
            });
        }

        // ── FILTER: status ──────────────────────────────────────────────
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // ── FILTER: tanggal ─────────────────────────────────────────────
        if ($tanggal = $request->get('tanggal')) {
            $query->whereDate('waktu_mulai', $tanggal);
        }

        // ── FILTER: lokasi ──────────────────────────────────────────────
        if ($lokasiId = $request->get('lokasi_id')) {
            $query->whereHas('slotParkir', fn($q) => $q->where('lokasi_parkir_id', $lokasiId));
        }

        $pemesanans = $query->paginate(15)->withQueryString();

        // ── STATS SUMMARY ───────────────────────────────────────────────
        $totalHariIni      = Pemesanan::whereDate('created_at', today())->count();
        $totalAktif        = Pemesanan::where('status', 'aktif')->count();
        $totalMenunggu     = Pemesanan::where('status', 'menunggu')->count();
        $totalRunning      = Pemesanan::where('status', 'running')->count();
        $pendapatanHariIni = Pemesanan::whereDate('waktu_selesai', today())
                                ->where('status', 'selesai')
                                ->sum('total_harga');

        // ── DATA FOR FILTERS ────────────────────────────────────────────
        $lokasis = \App\Models\LokasiParkir::aktif()->orderBy('nama')->get(['id', 'nama']);

        return view('pages.admin.pemesanan', compact(
            'pemesanans',
            'totalHariIni',
            'totalAktif',
            'totalMenunggu',
            'totalRunning',
            'pendapatanHariIni',
            'lokasis',
        ));
    }

    /**
     * Show detail modal data (AJAX).
     */
    public function show(Pemesanan $pemesanan)
    {
        $pemesanan->load(['user', 'slotParkir.lokasiParkir', 'kendaraan', 'pembayaran']);
        return response()->json($pemesanan);
    }

    /**
     * Store a manually created pemesanan (admin can create on behalf of user).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'slot_id'      => 'required|exists:slot_parkir,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'waktu_mulai'  => 'required|date',
            'waktu_selesai'=> 'nullable|date|after:waktu_mulai',
            'status'       => 'required|in:menunggu,aktif,running,selesai,dibatalkan',
            'catatan'      => 'nullable|string|max:500',
        ]);

        // Hitung durasi & total harga jika waktu_selesai diisi
        $durasi     = null;
        $totalHarga = 0;

        if (!empty($validated['waktu_selesai'])) {
            $mulai      = Carbon::parse($validated['waktu_mulai']);
            $selesai    = Carbon::parse($validated['waktu_selesai']);
            $durasi     = max(1, (int) ceil($mulai->diffInMinutes($selesai) / 60)); // dalam jam, min 1
            $slot       = SlotParkir::with('lokasiParkir')->findOrFail($validated['slot_id']);
            $totalHarga = $durasi * ($slot->lokasiParkir->harga_per_jam ?? 0);
        }

        Pemesanan::create(array_merge($validated, [
            'kode_pemesanan' => 'PMB-' . strtoupper(Str::random(8)),
            'durasi_parkir'  => $durasi,
            'total_harga'    => $totalHarga,
        ]));

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    /**
     * Update status or data pemesanan.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'status'        => 'required|in:menunggu,aktif,running,selesai,dibatalkan',
            'waktu_mulai'   => 'required|date',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
            'catatan'       => 'nullable|string|max:500',
        ]);

        // Recalculate durasi & harga jika waktu_selesai ada
        if (!empty($validated['waktu_selesai'])) {
            $mulai   = Carbon::parse($validated['waktu_mulai']);
            $selesai = Carbon::parse($validated['waktu_selesai']);
            $durasi  = max(1, (int) ceil($mulai->diffInMinutes($selesai) / 60));
            $validated['durasi_parkir'] = $durasi;
            $slot = SlotParkir::with('lokasiParkir')->find($pemesanan->slot_id);
            $validated['total_harga'] = $durasi * ($slot?->lokasiParkir?->harga_per_jam ?? 0);
        }

        $pemesanan->update($validated);

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Pemesanan #' . $pemesanan->kode_pemesanan . ' berhasil diperbarui.');
    }

    /**
     * Update status only (quick action).
     */
    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,aktif,running,selesai,dibatalkan',
        ]);

        $data = ['status' => $request->status];

        // Jika diselesaikan dan belum ada waktu_selesai, set otomatis
        if ($request->status === 'selesai' && !$pemesanan->waktu_selesai) {
            $selesai = now();
            $mulai   = Carbon::parse($pemesanan->waktu_mulai);
            $durasi  = max(1, (int) ceil($mulai->diffInMinutes($selesai) / 60));
            $slot    = SlotParkir::with('lokasiParkir')->find($pemesanan->slot_id);
            $data['waktu_selesai']  = $selesai;
            $data['durasi_parkir']  = $durasi;
            $data['total_harga']    = $durasi * ($slot?->lokasiParkir?->harga_per_jam ?? 0);
        }

        $pemesanan->update($data);

        // Update status slot parkir berdasarkan status pemesanan
        $slot = $slot ?? SlotParkir::find($pemesanan->slot_id);

        if ($slot) {
            $statusSlot = match ($request->status) {
                'menunggu'   => 'tersedia',
                'aktif'      => 'terisi',
                'running'    => 'terisi',
                'selesai'    => 'tersedia',
                'dibatalkan' => 'tersedia',
                default      => $slot->status,
            };

            $slot->update(['status' => $statusSlot]);
        }

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Status pemesanan diperbarui menjadi ' . $request->status . '.');
    }

    /**
     * Delete pemesanan.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        $kode = $pemesanan->kode_pemesanan;
        $pemesanan->delete();

        return redirect()->route('admin.pemesanan.index')
            ->with('success', "Pemesanan #{$kode} berhasil dihapus.");
    }

    /**
     * Export as CSV.
     */
    public function export(Request $request)
    {
        $query = Pemesanan::with(['user', 'slotParkir.lokasiParkir', 'kendaraan'])->latest();

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        if ($tanggal = $request->get('tanggal')) {
            $query->whereDate('waktu_mulai', $tanggal);
        }

        $rows = $query->get();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="pemesanan_' . date('Ymd_His') . '.csv"',
        ];

        $callback = function () use ($rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Kode', 'Pengguna', 'Email', 'Slot', 'Lokasi',
                'Plat Nomor', 'Waktu Mulai', 'Waktu Selesai',
                'Durasi (Jam)', 'Total Harga', 'Status', 'Catatan',
            ]);
            foreach ($rows as $p) {
                fputcsv($handle, [
                    $p->kode_pemesanan,
                    $p->user?->name,
                    $p->user?->email,
                    $p->slotParkir?->kode_slot,
                    $p->slotParkir?->lokasiParkir?->nama,
                    $p->kendaraan?->plat_nomor,
                    $p->waktu_mulai,
                    $p->waktu_selesai,
                    $p->durasi_parkir,
                    $p->total_harga,
                    $p->status,
                    $p->catatan,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
    
public function exportPdf(Request $request)
{
    $query = Pemesanan::with(['user', 'slotParkir.lokasiParkir', 'kendaraan'])->latest();

    if ($status = $request->get('status')) {
        $query->where('status', $status);
    }
    if ($tanggal = $request->get('tanggal')) {
        $query->whereDate('waktu_mulai', $tanggal);
    }
    if ($lokasiId = $request->get('lokasi_id')) {
        $query->whereHas('slotParkir', fn($q) => $q->where('lokasi_parkir_id', $lokasiId));
    }

    $pemesanans      = $query->get();
    $totalPendapatan = $pemesanans->where('status', 'selesai')->sum('total_harga');
    $filterStatus    = $request->get('status', 'Semua');
    $filterTanggal   = $request->get('tanggal', date('Y-m-d'));

    $pdf = Pdf::loadView('pages.admin.pemesanan-pdf', compact(
        'pemesanans', 'totalPendapatan', 'filterStatus', 'filterTanggal'
    ))->setPaper('a4', 'landscape');

    return $pdf->download('laporan-pemesanan-' . date('Ymd_His') . '.pdf');
}
}