<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * GET /notifikasi
     * Daftar notifikasi milik pengguna yang login.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Notifikasi::where('pengguna_id', $request->user()->id);

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->has('belum_dibaca')) {
            $query->belumDibaca();
        }

        $notifikasi = $query->orderByDesc('dibuat_pada')
                            ->paginate($request->get('per_halaman', 20));

        return response()->json($notifikasi);
    }

    /**
     * POST /notifikasi
     * Kirim notifikasi baru ke pengguna (biasanya dari sistem/admin).
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'pengguna_id'  => 'required|uuid|exists:pengguna,id',
            'judul'        => 'required|string|max:150',
            'pesan'        => 'required|string',
            'jenis'        => 'required|in:pemesanan,pembayaran,sistem,promo',
            'sudah_dibaca' => 'nullable|boolean',
        ]);

        $validated['dibuat_pada'] = now();

        $notifikasi = Notifikasi::create($validated);

        return response()->json($notifikasi, 201);
    }

    /**
     * GET /notifikasi/{id}
     * Detail notifikasi dan tandai sebagai sudah dibaca.
     */
    public function show(string $id): JsonResponse
    {
        $notifikasi = Notifikasi::findOrFail($id);

        if (!$notifikasi->sudah_dibaca) {
            $notifikasi->update(['sudah_dibaca' => true]);
        }

        return response()->json($notifikasi);
    }

    /**
     * PUT|PATCH /notifikasi/{id}
     * Perbarui status baca notifikasi.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $notifikasi = Notifikasi::findOrFail($id);

        $validated = $request->validate([
            'sudah_dibaca' => 'required|boolean',
        ]);

        $notifikasi->update($validated);

        return response()->json($notifikasi);
    }

    /**
     * DELETE /notifikasi/{id}
     * Hapus notifikasi.
     */
    public function destroy(string $id): JsonResponse
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return response()->json(['pesan' => 'Notifikasi berhasil dihapus.']);
    }
}
