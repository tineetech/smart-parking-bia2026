<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use App\Models\Pemesanan;
use App\Models\SlotParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminMonitorController extends Controller
{
    public function index(Request $request)
    {
        // Lokasi yang dipilih (default: lokasi pertama yang aktif)
        $lokasiList = LokasiParkir::aktif()->orderBy('nama')->get(['id', 'nama', 'kode_unik']);
        $selectedLokasiId = $request->get('lokasi_id', $lokasiList->first()?->id);
        $selectedLokasi   = $lokasiList->firstWhere('id', $selectedLokasiId);
 
        // ── STAT CARDS GLOBAL ─────────────────────────────────────
        $totalSlot    = SlotParkir::count();
        $totalTerisi  = SlotParkir::where('status', 'terisi')->count();
        $totalTersedia = SlotParkir::where('status', 'tersedia')->count();
        $totalDipesan  = SlotParkir::where('status', 'dipesan')->count();
        $hunian        = $totalSlot > 0 ? round(($totalTerisi / $totalSlot) * 100) : 0;
 
        // Sensor error: slot yang sensor-nya tidak null tapi status = nonaktif
        $sensorError = SlotParkir::where('status', 'nonaktif')
            ->whereNotNull('id_sensor')
            ->count();
 
        // ── SLOT PARKIR PER LOKASI YANG DIPILIH ───────────────────
        // Ambil semua lantai yang tersedia di lokasi ini
        $lantaiList = SlotParkir::where('lokasi_parkir_id', $selectedLokasiId)
            ->whereNotNull('lantai')
            ->distinct()
            ->orderBy('lantai')
            ->pluck('lantai');
 
        $selectedLantai = $request->get('lantai', $lantaiList->first());
 
        // Slot per lantai yang dipilih
        $slots = SlotParkir::where('lokasi_parkir_id', $selectedLokasiId)
            ->when($selectedLantai, fn($q) => $q->where('lantai', $selectedLantai))
            ->orderBy('kode_slot')
            ->get(['id', 'kode_slot', 'lantai', 'zona', 'status', 'jenis_slot']);
 
        // ── LOG KEJADIAN (30 pemesanan terbaru di lokasi ini) ─────
        $logs = Pemesanan::with(['kendaraan', 'slotParkir'])
            ->whereHas('slotParkir', fn($q) => $q->where('lokasi_parkir_id', $selectedLokasiId))
            ->latest('updated_at')
            ->take(20)
            ->get()
            ->map(function ($p) {
                $type = match ($p->status) {
                    'aktif', 'running' => 'in',
                    'selesai'          => 'out',
                    'dibatalkan'       => 'warn',
                    'menunggu'         => 'pay',
                    default            => 'in',
                };
                return [
                    'time'  => Carbon::parse($p->updated_at)->format('H:i'),
                    'plate' => $p->kendaraan->plat_nomor ?? '-',
                    'desc'  => match ($p->status) {
                        'aktif', 'running' => 'Masuk — Slot ' . ($p->slotParkir->kode_slot ?? '-'),
                        'selesai'          => 'Keluar — Slot ' . ($p->slotParkir->kode_slot ?? '-'),
                        'dibatalkan'       => 'Reservasi dibatalkan — Slot ' . ($p->slotParkir->kode_slot ?? '-'),
                        'menunggu'         => 'Pembayaran Rp ' . number_format($p->total_harga, 0, ',', '.'),
                        default            => ucfirst($p->status),
                    },
                    'type'  => $type,
                ];
            });
 
        return view('pages.admin.monitor', compact(
            'lokasiList',
            'selectedLokasi',
            'selectedLokasiId',
            'lantaiList',
            'selectedLantai',
            'slots',
            'logs',
            'hunian',
            'totalTersedia',
            'totalDipesan',
            'sensorError',
        ));
    }
 
    /**
     * API endpoint: refresh slot data (AJAX polling setiap 5 detik)
     */
    public function slotData(Request $request)
    {
        $lokasiId = $request->get('lokasi_id');
        $lantai   = $request->get('lantai');
 
        $slots = SlotParkir::where('lokasi_parkir_id', $lokasiId)
            ->when($lantai, fn($q) => $q->where('lantai', $lantai))
            ->orderBy('kode_slot')
            ->get(['id', 'kode_slot', 'lantai', 'zona', 'status', 'jenis_slot'])
            ->map(fn($s) => [
                'id'       => $s->id,
                'kode'     => $s->kode_slot,
                'status'   => $s->status,   // tersedia | terisi | dipesan | nonaktif
                'jenis'    => $s->jenis_slot,
            ]);
 
        $total    = SlotParkir::where('lokasi_parkir_id', $lokasiId)->count();
        $terisi   = SlotParkir::where('lokasi_parkir_id', $lokasiId)->where('status', 'terisi')->count();
        $tersedia = SlotParkir::where('lokasi_parkir_id', $lokasiId)->where('status', 'tersedia')->count();
        $dipesan  = SlotParkir::where('lokasi_parkir_id', $lokasiId)->where('status', 'dipesan')->count();
 
        return response()->json([
            'slots'    => $slots,
            'hunian'   => $total > 0 ? round(($terisi / $total) * 100) : 0,
            'tersedia' => $tersedia,
            'dipesan'  => $dipesan,
        ]);
    }
}
