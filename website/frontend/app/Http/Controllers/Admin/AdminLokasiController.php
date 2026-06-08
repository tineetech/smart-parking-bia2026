<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use App\Models\Pemesanan;
use App\Models\SlotParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminLokasiController extends Controller
{
    // ── INDEX ──────────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = LokasiParkir::withCount([
            'slotParkir',
            'slotParkir as slot_terisi_count' => fn($q) => $q->where('status', 'terisi'),
            'slotParkir as slot_dipesan_count' => fn($q) => $q->where('status', 'dipesan'),
        ]);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_unik', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('aktif', $request->status === 'aktif');
        }

        $totalLokasi = LokasiParkir::count();
        $totalAktif  = LokasiParkir::where('aktif', true)->count();

        $topLokasi = LokasiParkir::withCount([
            'slotParkir',
            'slotParkir as slot_terisi_count' => fn($q) => $q->where('status', 'terisi'),
        ])
        ->where('aktif', true)
        ->orderByDesc('total_slot')
        ->take(3)
        ->get()
        ->map(fn($l) => $l->setRelation('__hunian', $l->slot_parkir_count > 0
            ? round(($l->slot_terisi_count / $l->slot_parkir_count) * 100) : 0));

        $pendapatanHariIni = Pemesanan::selectRaw(
            'slot_parkir.lokasi_parkir_id, SUM(pemesanan.total_harga) as total'
        )
        ->join('slot_parkir', 'slot_parkir.id', '=', 'pemesanan.slot_id')
        ->whereDate('pemesanan.created_at', today())
        ->whereIn('pemesanan.status', ['selesai', 'aktif', 'running'])
        ->groupBy('slot_parkir.lokasi_parkir_id')
        ->pluck('total', 'lokasi_parkir_id');

        $lokasis = $query->orderBy('nama')->paginate(10)->withQueryString();

        $lokasis->getCollection()->transform(function ($l) use ($pendapatanHariIni) {
            $l->hunian = $l->slot_parkir_count > 0
                ? round(($l->slot_terisi_count / $l->slot_parkir_count) * 100) : 0;
            $l->pendapatan_hari_ini = $pendapatanHariIni[$l->id] ?? 0;
            return $l;
        });

        return view('pages.admin.lokasi', compact(
            'lokasis',
            'topLokasi',
            'totalLokasi',
            'totalAktif',
            'pendapatanHariIni',
        ));
    }

    // ── STORE ──────────────────────────────────────────────────
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'              => 'required|string|max:150',
            'alamat'            => 'required|string',
            'deskripsi'         => 'nullable|string',
            'kontak_no_telepon' => 'nullable|string|max:20',
            'latitude'          => 'required|numeric',
            'longitude'         => 'required|numeric',
            'total_slot'        => 'required|integer|min:1',
            'harga_per_jam'     => 'required|numeric|min:0',
            'jam_buka'          => 'required|date_format:H:i',
            'jam_tutup'         => 'required|date_format:H:i',
            'aktif'             => 'boolean',
            // Foto opsional
            'foto'              => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'foto_360'          => 'nullable|image|mimes:jpeg,jpg,png,webp|max:8192',
        ]);

        $data['kode_unik'] = strtoupper(Str::slug($data['nama'], '')) . rand(100, 999);
        $data['aktif']     = $request->boolean('aktif', true);

        // Upload foto lokasi
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('lokasi/foto', 'public');
        }

        // Upload foto 360
        if ($request->hasFile('foto_360')) {
            $data['foto_360'] = $request->file('foto_360')
                ->store('lokasi/foto_360', 'public');
        }

        LokasiParkir::create($data);

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    // ── UPDATE ─────────────────────────────────────────────────
    public function update(Request $request, LokasiParkir $lokasi)
    {
        $data = $request->validate([
            'nama'              => 'required|string|max:150',
            'alamat'            => 'required|string',
            'deskripsi'         => 'nullable|string',
            'kontak_no_telepon' => 'nullable|string|max:20',
            'latitude'          => 'required|numeric',
            'longitude'         => 'required|numeric',
            'total_slot'        => 'required|integer|min:1',
            'harga_per_jam'     => 'required|numeric|min:0',
            'jam_buka'          => 'required|date_format:H:i',
            'jam_tutup'         => 'required|date_format:H:i',
            'aktif'             => 'boolean',
            'foto'              => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'foto_360'          => 'nullable|image|mimes:jpeg,jpg,png,webp|max:8192',
            // Flag hapus foto
            'hapus_foto'        => 'nullable|boolean',
            'hapus_foto_360'    => 'nullable|boolean',
        ]);

        $data['aktif'] = $request->boolean('aktif', true);

        // ── Foto lokasi ──────────────────────────────────────
        if ($request->hasFile('foto')) {
            // Hapus file lama jika ada
            if ($lokasi->foto) {
                Storage::disk('public')->delete($lokasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('lokasi/foto', 'public');
        } elseif ($request->boolean('hapus_foto') && $lokasi->foto) {
            Storage::disk('public')->delete($lokasi->foto);
            $data['foto'] = null;
        } else {
            // Tidak ada perubahan — jaga nilai lama
            unset($data['foto']);
        }

        // ── Foto 360 ─────────────────────────────────────────
        if ($request->hasFile('foto_360')) {
            if ($lokasi->foto_360) {
                Storage::disk('public')->delete($lokasi->foto_360);
            }
            $data['foto_360'] = $request->file('foto_360')->store('lokasi/foto_360', 'public');
        } elseif ($request->boolean('hapus_foto_360') && $lokasi->foto_360) {
            Storage::disk('public')->delete($lokasi->foto_360);
            $data['foto_360'] = null;
        } else {
            unset($data['foto_360']);
        }

        $lokasi->update($data);

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Lokasi berhasil diperbarui.');
    }

    // ── DESTROY ────────────────────────────────────────────────
    public function destroy(LokasiParkir $lokasi)
    {
        $aktif = $lokasi->slotParkir()
            ->whereIn('status', ['terisi', 'dipesan'])
            ->count();

        if ($aktif > 0) {
            return redirect()->route('admin.lokasi.index')
                ->with('error', 'Tidak dapat menghapus lokasi yang masih memiliki slot aktif.');
        }

        // Hapus file foto jika ada
        if ($lokasi->foto) {
            Storage::disk('public')->delete($lokasi->foto);
        }
        if ($lokasi->foto_360) {
            Storage::disk('public')->delete($lokasi->foto_360);
        }

        $lokasi->slotParkir()->delete();
        $lokasi->delete();

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Lokasi berhasil dihapus.');
    }

    // ── TOGGLE AKTIF (AJAX) ────────────────────────────────────
    public function toggleAktif(LokasiParkir $lokasi)
    {
        $lokasi->update(['aktif' => !$lokasi->aktif]);

        return response()->json([
            'aktif'   => $lokasi->aktif,
            'message' => 'Status lokasi diperbarui.',
        ]);
    }
}