<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pemesanan;
use App\Models\SlotParkir;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    /**
     * POST /pemesanan/cek-kode
     * Validasi kode pemesanan aktif dan toleransi waktu.
     */
    public function cekKodePemesanan($kode): JsonResponse
    {

        $pemesanan = Pemesanan::with([
            'user',
            'slotParkir.lokasiParkir',
            'kendaraan'
        ])
            ->where('kode_pemesanan', $kode)
            ->where('status', 'aktif')
            ->first();

        if (!$pemesanan) {
            return response()->json([
                'status' => false,
                'pesan' => 'Kode pemesanan tidak ditemukan atau tidak aktif.',
            ], 404);
        }

        $now = now();

        $waktuMulai = \Carbon\Carbon::parse($pemesanan->waktu_mulai);

        // Toleransi:
        // 1 jam sebelum mulai
        $batasAwal = $waktuMulai->copy()->subHour();

        // 1 jam setelah mulai
        $batasAkhir = $waktuMulai->copy()->addHour();

        if ($now->lt($batasAwal) || $now->gt($batasAkhir)) {
            return response()->json([
                'status' => false,
                'pesan' => 'Kode pemesanan berada di luar toleransi waktu.',
                'waktu_mulai' => $waktuMulai->format('Y-m-d H:i:s'),
                'batas_awal' => $batasAwal->format('Y-m-d H:i:s'),
                'batas_akhir' => $batasAkhir->format('Y-m-d H:i:s'),
                'waktu_sekarang' => $now->format('Y-m-d H:i:s'),
            ], 422);
        }

        // update pemesanan
        $pemesanan->update([
            'status' => 'running'
        ]);

        // buat notifikasi ke user
        $mulai = Carbon::parse($pemesanan->waktu_mulai);
        $selesai = Carbon::parse($pemesanan->waktu_selesai);

        $jamMulai = $mulai->translatedFormat('d F Y H:i');
        $jamSelesai = $selesai->translatedFormat('d F Y H:i');

        $namaSlot = $pemesanan->slotParkir->nama_slot ?? 'Slot Parkir';

        Notifikasi::create([
            'user_id' => $pemesanan->user->id,
            'judul' => 'Pemesanan Parkir Aktif',
            'pesan' => "Pemesanan parkir Anda untuk {$namaSlot} telah aktif mulai {$jamMulai} sampai {$jamSelesai}.",
            'jenis' => 'pemesanan',
            'sudah_dibaca' => false,
        ]);

        return response()->json([
            'status' => true,
            'pesan' => 'Kode pemesanan valid.',
            'data' => $pemesanan,
        ]);
    }
    /**
     * GET /pemesanan
     * Daftar pemesanan milik pengguna yang login.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Pemesanan::with(['slotParkir.lokasiParkir', 'kendaraan', 'pembayaran'])
            ->where('pengguna_id', $request->user()->id);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pemesanan = $query->orderByDesc('dibuat_pada')
            ->paginate($request->get('per_halaman', 10));

        return response()->json($pemesanan);
    }

    /**
     * POST /pemesanan
     * Buat pemesanan baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'slot_id'      => 'required|uuid|exists:slot_parkir,id',
            'kendaraan_id' => 'required|uuid|exists:kendaraan,id',
            'waktu_mulai'  => 'required|date|after_or_equal:now',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
            'catatan'      => 'nullable|string',
        ]);

        // Pastikan slot masih tersedia
        $slot = SlotParkir::findOrFail($validated['slot_id']);
        if ($slot->status !== 'tersedia') {
            return response()->json(['pesan' => 'Slot parkir tidak tersedia.'], 422);
        }

        // Hitung durasi & harga jika waktu selesai tersedia
        $durasi     = null;
        $totalHarga = 0;

        if (!empty($validated['waktu_selesai'])) {
            $mulai  = \Carbon\Carbon::parse($validated['waktu_mulai']);
            $selesai = \Carbon\Carbon::parse($validated['waktu_selesai']);
            $durasi  = round($selesai->diffInMinutes($mulai) / 60, 2);
            $totalHarga = $durasi * $slot->lokasiParkir->harga_per_jam;
        }

        $pemesanan = Pemesanan::create([
            'pengguna_id'    => $request->user()->id,
            'slot_id'        => $validated['slot_id'],
            'kendaraan_id'   => $validated['kendaraan_id'],
            'kode_pemesanan' => strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(6)),
            'waktu_mulai'    => $validated['waktu_mulai'],
            'waktu_selesai'  => $validated['waktu_selesai'] ?? null,
            'durasi_jam'     => $durasi,
            'total_harga'    => $totalHarga,
            'status'         => 'menunggu',
            'catatan'        => $validated['catatan'] ?? null,
            'dibuat_pada'    => now(),
            'diperbarui_pada' => now(),
        ]);

        // Ubah status slot menjadi dipesan
        $slot->update(['status' => 'dipesan', 'terakhir_diperbarui' => now()]);

        return response()->json($pemesanan->load(['slotParkir.lokasiParkir', 'kendaraan']), 201);
    }

    /**
     * GET /pemesanan/{id}
     * Detail pemesanan.
     */
    public function show(string $id): JsonResponse
    {
        $pemesanan = Pemesanan::with(['pengguna', 'slotParkir.lokasiParkir', 'kendaraan', 'pembayaran'])
            ->findOrFail($id);

        return response()->json($pemesanan);
    }

    /**
     * PUT|PATCH /pemesanan/{id}
     * Perbarui pemesanan (misal: ubah status atau waktu selesai).
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $validated = $request->validate([
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
            'status'        => 'nullable|in:menunggu,aktif,selesai,dibatalkan',
            'catatan'       => 'nullable|string',
        ]);

        // Recalculate durasi & harga jika waktu_selesai berubah
        if (!empty($validated['waktu_selesai'])) {
            $mulai   = \Carbon\Carbon::parse($pemesanan->waktu_mulai);
            $selesai = \Carbon\Carbon::parse($validated['waktu_selesai']);
            $validated['durasi_jam'] = round($selesai->diffInMinutes($mulai) / 60, 2);

            $hargaPerJam = $pemesanan->slotParkir->lokasiParkir->harga_per_jam;
            $validated['total_harga'] = $validated['durasi_jam'] * $hargaPerJam;
        }

        // Jika dibatalkan, kembalikan status slot
        if (isset($validated['status']) && $validated['status'] === 'dibatalkan') {
            $pemesanan->slotParkir->update(['status' => 'tersedia', 'terakhir_diperbarui' => now()]);
        }

        $validated['diperbarui_pada'] = now();
        $pemesanan->update($validated);

        return response()->json($pemesanan->fresh());
    }

    /**
     * DELETE /pemesanan/{id}
     * Hapus / batalkan pemesanan.
     */
    public function destroy(string $id): JsonResponse
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Kembalikan slot ke tersedia
        $pemesanan->slotParkir->update(['status' => 'tersedia', 'terakhir_diperbarui' => now()]);

        $pemesanan->delete();

        return response()->json(['pesan' => 'Pemesanan berhasil dihapus.']);
    }
}
