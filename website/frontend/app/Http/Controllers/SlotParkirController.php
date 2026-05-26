<?php

namespace App\Http\Controllers;

use App\Models\SlotParkir;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SlotParkirController extends Controller
{
    /**
     * GET /slot-parkir
     * Daftar slot parkir (bisa difilter per lokasi).
     */
    public function index(Request $request): JsonResponse
    {
        $query = SlotParkir::with('lokasiParkir');

        if ($request->filled('lokasi_parkir_id')) {
            $query->where('lokasi_parkir_id', $request->lokasi_parkir_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jenis_slot')) {
            $query->where('jenis_slot', $request->jenis_slot);
        }

        if ($request->filled('lantai')) {
            $query->where('lantai', $request->lantai);
        }

        $slot = $query->orderBy('kode_slot')
                      ->paginate($request->get('per_halaman', 20));

        return response()->json($slot);
    }

    /**
     * POST /slot-parkir
     * Tambah slot parkir baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'lokasi_parkir_id' => 'required|uuid|exists:lokasi_parkir,id',
            'kode_slot'        => 'required|string|max:10',
            'lantai'           => 'nullable|string|max:10',
            'zona'             => 'nullable|string|max:10',
            'jenis_slot'       => 'nullable|in:reguler,disabilitas,vip',
            'status'           => 'nullable|in:tersedia,terisi,dipesan,nonaktif',
            'id_sensor'        => 'nullable|string|max:50',
        ]);

        $validated['dibuat_pada'] = now();

        $slot = SlotParkir::create($validated);

        return response()->json($slot->load('lokasiParkir'), 201);
    }

    /**
     * GET /slot-parkir/{id}
     * Detail slot parkir.
     */
    public function show(string $id): JsonResponse
    {
        $slot = SlotParkir::with(['lokasiParkir', 'logSensor' => fn($q) => $q->latest('dicatat_pada')->limit(10)])
                          ->findOrFail($id);

        return response()->json($slot);
    }

    /**
     * PUT|PATCH /slot-parkir/{id}
     * Perbarui slot parkir.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $slot = SlotParkir::findOrFail($id);

        $validated = $request->validate([
            'kode_slot'  => 'sometimes|string|max:10',
            'lantai'     => 'nullable|string|max:10',
            'zona'       => 'nullable|string|max:10',
            'jenis_slot' => 'nullable|in:reguler,disabilitas,vip',
            'status'     => 'nullable|in:tersedia,terisi,dipesan,nonaktif',
            'id_sensor'  => 'nullable|string|max:50',
        ]);

        $validated['terakhir_diperbarui'] = now();
        $slot->update($validated);

        return response()->json($slot);
    }

    /**
     * DELETE /slot-parkir/{id}
     * Hapus slot parkir.
     */
    public function destroy(string $id): JsonResponse
    {
        $slot = SlotParkir::findOrFail($id);
        $slot->delete();

        return response()->json(['pesan' => 'Slot parkir berhasil dihapus.']);
    }
}
