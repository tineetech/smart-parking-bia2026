<?php

namespace App\Http\Controllers;

use App\Models\LokasiParkir;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LokasiParkirController extends Controller
{
    /**
     * GET /lokasi-parkir
     * Daftar semua lokasi parkir.
     */
    public function index(Request $request): JsonResponse
    {
        $query = LokasiParkir::withCount('slotParkir');

        if ($request->boolean('hanya_aktif', false)) {
            $query->aktif();
        }

        $lokasi = $query->orderBy('nama')
                        ->paginate($request->get('per_halaman', 15));

        return response()->json($lokasi);
    }

    /**
     * POST /lokasi-parkir
     * Tambah lokasi parkir baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:150',
            'alamat'       => 'required|string',
            'latitude'     => 'required|numeric|between:-90,90',
            'longitude'    => 'required|numeric|between:-180,180',
            'total_slot'   => 'required|integer|min:0',
            'harga_per_jam' => 'required|numeric|min:0',
            'jam_buka'     => 'required|date_format:H:i',
            'jam_tutup'    => 'required|date_format:H:i|after:jam_buka',
            'aktif'        => 'nullable|boolean',
        ]);

        $validated['dibuat_pada']    = now();
        $validated['diperbarui_pada'] = now();

        $lokasi = LokasiParkir::create($validated);

        return response()->json($lokasi, 201);
    }

    /**
     * GET /lokasi-parkir/{id}
     * Detail lokasi parkir beserta slot.
     */
    public function show(string $id): JsonResponse
    {
        $lokasi = LokasiParkir::with('slotParkir')->findOrFail($id);

        return response()->json($lokasi);
    }

    /**
     * PUT|PATCH /lokasi-parkir/{id}
     * Perbarui lokasi parkir.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $lokasi = LokasiParkir::findOrFail($id);

        $validated = $request->validate([
            'nama'         => 'sometimes|string|max:150',
            'alamat'       => 'sometimes|string',
            'latitude'     => 'sometimes|numeric|between:-90,90',
            'longitude'    => 'sometimes|numeric|between:-180,180',
            'total_slot'   => 'sometimes|integer|min:0',
            'harga_per_jam' => 'sometimes|numeric|min:0',
            'jam_buka'     => 'sometimes|date_format:H:i',
            'jam_tutup'    => 'sometimes|date_format:H:i',
            'aktif'        => 'nullable|boolean',
        ]);

        $validated['diperbarui_pada'] = now();
        $lokasi->update($validated);

        return response()->json($lokasi);
    }

    /**
     * DELETE /lokasi-parkir/{id}
     * Hapus lokasi parkir.
     */
    public function destroy(string $id): JsonResponse
    {
        $lokasi = LokasiParkir::findOrFail($id);
        $lokasi->delete();

        return response()->json(['pesan' => 'Lokasi parkir berhasil dihapus.']);
    }
}
