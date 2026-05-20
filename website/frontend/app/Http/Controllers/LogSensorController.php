<?php

namespace App\Http\Controllers;

use App\Models\LogSensor;
use App\Models\SlotParkir;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogSensorController extends Controller
{
    /**
     * GET /log-sensor
     * Daftar log sensor (bisa difilter per slot).
     */
    public function index(Request $request): JsonResponse
    {
        $query = LogSensor::with('slotParkir.lokasiParkir');

        if ($request->filled('slot_id')) {
            $query->where('slot_id', $request->slot_id);
        }

        if ($request->filled('id_sensor')) {
            $query->where('id_sensor', $request->id_sensor);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $log = $query->orderByDesc('dicatat_pada')
                     ->paginate($request->get('per_halaman', 50));

        return response()->json($log);
    }

    /**
     * POST /log-sensor
     * Simpan data baru dari sensor (dipanggil oleh perangkat IoT).
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'slot_id'   => 'required|uuid|exists:slot_parkir,id',
            'id_sensor' => 'required|string|max:50',
            'status'    => 'required|in:tersedia,terisi',
            'jarak_cm'  => 'nullable|numeric|min:0',
        ]);

        $validated['dicatat_pada'] = now();

        $log = LogSensor::create($validated);

        // Sinkronisasi status slot dengan data sensor terbaru
        SlotParkir::where('id', $validated['slot_id'])->update([
            'status'             => $validated['status'],
            'terakhir_diperbarui' => now(),
        ]);

        return response()->json($log, 201);
    }

    /**
     * GET /log-sensor/{id}
     * Detail satu log sensor.
     */
    public function show(string $id): JsonResponse
    {
        $log = LogSensor::with('slotParkir')->findOrFail($id);

        return response()->json($log);
    }

    /**
     * PUT|PATCH /log-sensor/{id}
     * Perbarui log sensor (umumnya jarang digunakan).
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $log = LogSensor::findOrFail($id);

        $validated = $request->validate([
            'status'   => 'sometimes|in:tersedia,terisi',
            'jarak_cm' => 'nullable|numeric|min:0',
        ]);

        $log->update($validated);

        return response()->json($log);
    }

    /**
     * DELETE /log-sensor/{id}
     * Hapus log sensor.
     */
    public function destroy(string $id): JsonResponse
    {
        $log = LogSensor::findOrFail($id);
        $log->delete();

        return response()->json(['pesan' => 'Log sensor berhasil dihapus.']);
    }
}
