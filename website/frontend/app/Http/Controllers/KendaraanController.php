<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    /**
     * GET /kendaraan
     * Daftar kendaraan milik pengguna yang login.
     */
    public function index(Request $request): JsonResponse
    {
        $kendaraan = Kendaraan::where('pengguna_id', $request->user()->id)
                              ->orderByDesc('utama')
                              ->orderBy('dibuat_pada')
                              ->get();

        return response()->json($kendaraan);
    }

    /**
     * POST /kendaraan
     * Tambah kendaraan baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'plat_nomor' => 'required|string|max:20|unique:kendaraan,plat_nomor',
            'merek'      => 'nullable|string|max:50',
            'model'      => 'nullable|string|max:50',
            'warna'      => 'nullable|string|max:30',
            'jenis'      => 'nullable|in:mobil,motor,truk',
            'utama'      => 'nullable|boolean',
        ]);

        // Jika ditandai utama, reset kendaraan utama lainnya
        if (!empty($validated['utama']) && $validated['utama']) {
            Kendaraan::where('pengguna_id', $request->user()->id)
                     ->update(['utama' => false]);
        }

        $validated['pengguna_id']    = $request->user()->id;
        $validated['dibuat_pada']    = now();
        $validated['diperbarui_pada'] = now();

        $kendaraan = Kendaraan::create($validated);

        return response()->json($kendaraan, 201);
    }

    /**
     * GET /kendaraan/{id}
     * Detail kendaraan.
     */
    public function show(string $id): JsonResponse
    {
        $kendaraan = Kendaraan::with('pengguna')->findOrFail($id);

        return response()->json($kendaraan);
    }

    /**
     * PUT|PATCH /kendaraan/{id}
     * Perbarui kendaraan.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'plat_nomor' => ['sometimes', 'string', 'max:20', Rule::unique('kendaraan', 'plat_nomor')->ignore($kendaraan->id)],
            'merek'      => 'nullable|string|max:50',
            'model'      => 'nullable|string|max:50',
            'warna'      => 'nullable|string|max:30',
            'jenis'      => 'nullable|in:mobil,motor,truk',
            'utama'      => 'nullable|boolean',
        ]);

        if (!empty($validated['utama']) && $validated['utama']) {
            Kendaraan::where('pengguna_id', $kendaraan->pengguna_id)
                     ->where('id', '!=', $kendaraan->id)
                     ->update(['utama' => false]);
        }

        $validated['diperbarui_pada'] = now();
        $kendaraan->update($validated);

        return response()->json($kendaraan);
    }

    /**
     * DELETE /kendaraan/{id}
     * Hapus kendaraan.
     */
    public function destroy(string $id): JsonResponse
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return response()->json(['pesan' => 'Kendaraan berhasil dihapus.']);
    }
}
