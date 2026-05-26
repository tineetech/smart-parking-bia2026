<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\SlotParkir;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
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
