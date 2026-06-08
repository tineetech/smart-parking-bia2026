<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use App\Models\SlotParkir;
use Illuminate\Http\Request;

/*
 * ROUTE REGISTRATION (web.php):
 *
 *   Route::resource('/slot', AdminSlotParkirController::class);
 *   Route::delete('/slot/bulk-destroy', [AdminSlotParkirController::class, 'bulkDestroy'])
 *        ->name('admin.slot.bulk-destroy');
 *
 * The bulk-destroy route MUST be registered BEFORE the resource route
 * to prevent Laravel from treating "bulk-destroy" as a {slot} wildcard.
 */

class AdminSlotParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SlotParkir::with('lokasiParkir');

        // Filter by search (kode_slot or lokasi nama)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_slot', 'like', "%{$search}%")
                  ->orWhereHas('lokasiParkir', fn($lq) => $lq->where('nama', 'like', "%{$search}%"));
            });
        }

        // Filter by lokasi
        if ($request->filled('lokasi_id')) {
            $query->where('lokasi_parkir_id', $request->lokasi_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jenis_slot
        if ($request->filled('jenis_slot')) {
            $query->where('jenis_slot', $request->jenis_slot);
        }

        // Filter by kendaraan_type
        if ($request->filled('kendaraan_type')) {
            $query->where('kendaraan_type', $request->kendaraan_type);
        }

        $slots = $query->orderBy('lokasi_parkir_id')->orderBy('kode_slot')->paginate(15)->withQueryString();

        // Stats
        $totalSlot       = SlotParkir::count();
        $totalTersedia   = SlotParkir::where('status', 'tersedia')->count();
        $totalTerisi     = SlotParkir::where('status', 'terisi')->count();
        $totalDipesan    = SlotParkir::where('status', 'dipesan')->count();
        $totalNonaktif   = SlotParkir::where('status', 'nonaktif')->count();

        // All active lokasi for dropdown
        $lokasiList = LokasiParkir::aktif()->orderBy('nama')->get();

        // Top lokasi cards (up to 3, by most slots)
        $topLokasi = LokasiParkir::withCount([
            'slotParkir',
            'slotParkir as slot_tersedia_count' => fn($q) => $q->where('status', 'tersedia'),
            'slotParkir as slot_terisi_count'   => fn($q) => $q->where('status', 'terisi'),
        ])->orderByDesc('slot_parkir_count')->take(3)->get();

        return view('pages.admin.slot', compact(
            'slots',
            'totalSlot',
            'totalTersedia',
            'totalTerisi',
            'totalDipesan',
            'totalNonaktif',
            'lokasiList',
            'topLokasi',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $isBulk = $request->boolean('bulk_generate');

        $validated = $request->validate([
            'lokasi_parkir_id' => 'required|exists:lokasi_parkir,id',
            'kode_slot'        => $isBulk ? 'nullable|string|max:10' : 'required|string|max:10',
            'lantai'           => 'nullable|string|max:10',
            'zona'             => 'nullable|string|max:10',
            'jenis_slot'       => 'required|in:reguler,vip',
            'kendaraan_type'   => 'required|in:mobil,motor',
            'status'           => 'required|in:tersedia,terisi,dipesan,nonaktif',
            'id_sensor'        => 'nullable|integer',
            'bulk_generate'    => 'nullable|boolean',
            'bulk_prefix'      => $isBulk ? 'required|string|max:5' : 'nullable|string|max:5',
            'bulk_jumlah'      => $isBulk ? 'required|integer|min:1|max:100' : 'nullable|integer|min:1|max:100',
        ]);

        // Bulk generate mode
        if ($isBulk) {
            $prefix  = strtoupper(trim($request->bulk_prefix));
            $jumlah  = (int) $request->bulk_jumlah;
            $created = 0;

            for ($i = 1; $i <= $jumlah; $i++) {
                $kode = $prefix . str_pad($i, 2, '0', STR_PAD_LEFT);
                // Skip if kode already exists in this lokasi
                $exists = SlotParkir::where('lokasi_parkir_id', $validated['lokasi_parkir_id'])
                                    ->where('kode_slot', $kode)->exists();
                if (!$exists) {
                    SlotParkir::create([
                        'lokasi_parkir_id' => $validated['lokasi_parkir_id'],
                        'kode_slot'        => $kode,
                        'lantai'           => $validated['lantai'] ?? null,
                        'zona'             => $validated['zona'] ?? null,
                        'jenis_slot'       => $validated['jenis_slot'],
                        'kendaraan_type'   => $validated['kendaraan_type'],
                        'status'           => $validated['status'],
                        'id_sensor'        => $validated['id_sensor'] ?? null,
                    ]);
                    $created++;
                }
            }

            return redirect()->route('admin.slot.index')
                ->with('success', "{$created} slot parkir berhasil dibuat.");
        }

        // Single create — check unique kode_slot per lokasi
        $exists = SlotParkir::where('lokasi_parkir_id', $validated['lokasi_parkir_id'])
                            ->where('kode_slot', $validated['kode_slot'])->exists();
        if ($exists) {
            return back()->withInput()
                ->with('error', "Kode slot '{$validated['kode_slot']}' sudah ada di lokasi ini.");
        }

        SlotParkir::create([
            'lokasi_parkir_id' => $validated['lokasi_parkir_id'],
            'kode_slot'        => $validated['kode_slot'],
            'lantai'           => $validated['lantai'] ?? null,
            'zona'             => $validated['zona'] ?? null,
            'jenis_slot'       => $validated['jenis_slot'],
            'kendaraan_type'   => $validated['kendaraan_type'],
            'status'           => $validated['status'],
            'id_sensor'        => $validated['id_sensor'] ?? null,
        ]);

        return redirect()->route('admin.slot.index')
            ->with('success', "Slot parkir '{$validated['kode_slot']}' berhasil ditambahkan.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SlotParkir $slot)
    {
        $validated = $request->validate([
            'lokasi_parkir_id' => 'required|exists:lokasi_parkir,id',
            'kode_slot'        => 'required|string|max:10',
            'lantai'           => 'nullable|string|max:10',
            'zona'             => 'nullable|string|max:10',
            'jenis_slot'       => 'required|in:reguler,vip',
            'kendaraan_type'   => 'required|in:mobil,motor',
            'status'           => 'required|in:tersedia,terisi,dipesan,nonaktif',
            'id_sensor'        => 'nullable|exists:sensor,id',
        ]);

        // Check unique kode_slot per lokasi (exclude self)
        $exists = SlotParkir::where('lokasi_parkir_id', $validated['lokasi_parkir_id'])
                            ->where('kode_slot', $validated['kode_slot'])
                            ->where('id', '!=', $slot->id)
                            ->exists();
        if ($exists) {
            return back()->withInput()
                ->with('error', "Kode slot '{$validated['kode_slot']}' sudah ada di lokasi ini.");
        }

        $slot->update($validated);

        return redirect()->route('admin.slot.index')
            ->with('success', "Slot parkir '{$slot->kode_slot}' berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SlotParkir $slot)
    {
        $kode = $slot->kode_slot;
        $slot->delete();

        return redirect()->route('admin.slot.index')
            ->with('success', "Slot parkir '{$kode}' berhasil dihapus.");
    }

    /**
     * Bulk delete selected slots.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer|exists:slot_parkir,id',
        ]);

        $count = SlotParkir::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.slot.index')
            ->with('success', "{$count} slot parkir berhasil dihapus.");
    }
}