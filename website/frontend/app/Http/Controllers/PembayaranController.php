<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    /**
     * GET /pembayaran
     * Daftar pembayaran.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Pembayaran::with('pemesanan.pengguna');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('metode')) {
            $query->where('metode', $request->metode);
        }

        $pembayaran = $query->orderByDesc('dibuat_pada')
                            ->paginate($request->get('per_halaman', 15));

        return response()->json($pembayaran);
    }

    /**
     * POST /pembayaran
     * Proses pembayaran untuk suatu pemesanan.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'pemesanan_id' => 'required|uuid|exists:pemesanan,id',
            'jumlah'       => 'required|numeric|min:0',
            'metode'       => 'required|string|max:30|in:transfer,qris,tunai,e-wallet',
        ]);

        $pemesanan = Pemesanan::findOrFail($validated['pemesanan_id']);

        // Cek pembayaran sudah ada
        if ($pemesanan->pembayaran && $pemesanan->pembayaran->status === 'sukses') {
            return response()->json(['pesan' => 'Pemesanan ini sudah dibayar.'], 422);
        }

        $pembayaran = Pembayaran::create([
            'pemesanan_id'          => $validated['pemesanan_id'],
            'jumlah'                => $validated['jumlah'],
            'metode'                => $validated['metode'],
            'status'                => 'menunggu',
            'referensi_pembayaran'  => strtoupper('PAY-' . Str::random(12)),
            'dibuat_pada'           => now(),
            'diperbarui_pada'       => now(),
        ]);

        return response()->json($pembayaran->load('pemesanan'), 201);
    }

    /**
     * GET /pembayaran/{id}
     * Detail pembayaran.
     */
    public function show(string $id): JsonResponse
    {
        $pembayaran = Pembayaran::with(['pemesanan.pengguna', 'pemesanan.slotParkir.lokasiParkir'])
                                ->findOrFail($id);

        return response()->json($pembayaran);
    }

    /**
     * PUT|PATCH /pembayaran/{id}
     * Perbarui status pembayaran (misal: konfirmasi dari payment gateway).
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'status'                => 'required|in:menunggu,sukses,gagal,dikembalikan',
            'referensi_pembayaran'  => 'nullable|string|max:100',
        ]);

        if ($validated['status'] === 'sukses') {
            $validated['dibayar_pada'] = now();

            // Aktifkan pemesanan
            $pembayaran->pemesanan->update([
                'status'         => 'aktif',
                'diperbarui_pada' => now(),
            ]);

            // Ubah status slot menjadi terisi
            $pembayaran->pemesanan->slotParkir->update([
                'status'             => 'terisi',
                'terakhir_diperbarui' => now(),
            ]);
        }

        $validated['diperbarui_pada'] = now();
        $pembayaran->update($validated);

        return response()->json($pembayaran->fresh());
    }

    /**
     * DELETE /pembayaran/{id}
     * Hapus catatan pembayaran (hanya jika belum sukses).
     */
    public function destroy(string $id): JsonResponse
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->status === 'sukses') {
            return response()->json(['pesan' => 'Pembayaran yang sudah sukses tidak dapat dihapus.'], 422);
        }

        $pembayaran->delete();

        return response()->json(['pesan' => 'Catatan pembayaran berhasil dihapus.']);
    }
}
