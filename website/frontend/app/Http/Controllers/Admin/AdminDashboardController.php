<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\LokasiParkir;
use App\Models\Pemesanan;
use App\Models\SlotParkir;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
 

class AdminDashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $today = $now->toDateString();
        $yesterday = $now->copy()->subDay()->toDateString();
 
        // ── STAT CARDS ────────────────────────────────────────────────
        $totalSlot = SlotParkir::count();
 
        $slotTerisi = SlotParkir::where('status', 'terisi')->count();
        $slotTersedia = SlotParkir::where('status', 'tersedia')->count();
        $slotDipesan = SlotParkir::where('status', 'dipesan')->count();
        $persenTerisi = $totalSlot > 0 ? round(($slotTerisi / $totalSlot) * 100) : 0;
 
        $totalLokasi = LokasiParkir::aktif()->count();
 
        // Lokasi penuh (>= 90% terisi) → perlu perhatian
        $lokasiAlert = LokasiParkir::aktif()
            ->withCount([
                'slotParkir',
                'slotParkir as slot_terisi_count' => fn($q) => $q->where('status', 'terisi'),
            ])
            ->get()
            ->filter(function ($l) {
                if ($l->slot_parkir_count === 0) return false;
                return ($l->slot_terisi_count / $l->slot_parkir_count) >= 0.9;
            })
            ->count();
 
        // Pendapatan hari ini
        $pendapatanHariIni = Pemesanan::whereDate('created_at', $today)
            ->whereIn('status', ['selesai', 'aktif', 'running'])
            ->sum('total_harga');
 
        $pendapatanKemarin = Pemesanan::whereDate('created_at', $yesterday)
            ->whereIn('status', ['selesai', 'aktif', 'running'])
            ->sum('total_harga');
 
        $trendPendapatan = $pendapatanKemarin > 0
            ? round((($pendapatanHariIni - $pendapatanKemarin) / $pendapatanKemarin) * 100, 1)
            : 0;
 
        // ── CHART: Tren 7 Hari ────────────────────────────────────────
        $trendData = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo)->toDateString();
            return [
                'label' => Carbon::now()->subDays($daysAgo)->locale('id')->isoFormat('ddd'),
                'masuk'  => Pemesanan::whereDate('waktu_mulai', $date)->count(),
                'keluar' => Pemesanan::whereDate('waktu_selesai', $date)
                    ->whereIn('status', ['selesai'])->count(),
            ];
        });
 
        $chartLabels    = $trendData->pluck('label');
        $chartMasuk     = $trendData->pluck('masuk');
        $chartKeluar    = $trendData->pluck('keluar');
 
        // ── TRANSAKSI TERBARU ─────────────────────────────────────────
        $transaksiTerbaru = Pemesanan::with(['kendaraan', 'slotParkir.lokasiParkir'])
            ->latest()
            ->take(5)
            ->get();
 
        // ── AKTIVITAS SISTEM (log sederhana dari pemesanan terbaru) ───
        // Gabungkan berbagai event menjadi activity feed
        $activities = collect();
 
        // Slot baru dibebaskan (selesai)
        Pemesanan::with(['slotParkir.lokasiParkir'])
            ->where('status', 'selesai')
            ->latest('updated_at')
            ->take(2)
            ->get()
            ->each(fn($p) => $activities->push([
                'type'  => 'selesai',
                'text'  => 'Slot ' . ($p->slotParkir->kode_slot ?? '-') . ' dibebaskan — ' . ($p->slotParkir->lokasiParkir->nama ?? '-'),
                'time'  => $p->updated_at,
            ]));
 
        // Pemesanan baru masuk
        Pemesanan::with(['kendaraan'])
            ->where('status', 'menunggu')
            ->latest()
            ->take(2)
            ->get()
            ->each(fn($p) => $activities->push([
                'type'  => 'masuk',
                'text'  => 'Reservasi baru — ' . ($p->kendaraan->plat_nomor ?? '-') . ' (' . ($p->kode_pemesanan ?? '') . ')',
                'time'  => $p->created_at,
            ]));
 
        // Pengguna baru (kendaraan terdaftar hari ini)
        $kendaraanBaru = Kendaraan::whereDate('created_at', $today)->count();
        if ($kendaraanBaru > 0) {
            $activities->push([
                'type' => 'user',
                'text' => $kendaraanBaru . ' kendaraan baru terdaftar hari ini',
                'time' => Kendaraan::whereDate('created_at', $today)->latest()->value('created_at'),
            ]);
        }
 
        $activities = $activities->sortByDesc('time')->take(5)->values();
 
        // ── DISTRIBUSI SLOT (untuk donut chart) ───────────────────────
        $distribusiSlot = [
            'terisi'   => $totalSlot > 0 ? round(($slotTerisi   / $totalSlot) * 100) : 0,
            'tersedia' => $totalSlot > 0 ? round(($slotTersedia / $totalSlot) * 100) : 0,
            'dipesan'  => $totalSlot > 0 ? round(($slotDipesan  / $totalSlot) * 100) : 0,
        ];
 
        return view('pages.admin.dashboard', compact(
            'totalSlot',
            'slotTerisi',
            'persenTerisi',
            'totalLokasi',
            'lokasiAlert',
            'pendapatanHariIni',
            'pendapatanKemarin',
            'trendPendapatan',
            'chartLabels',
            'chartMasuk',
            'chartKeluar',
            'transaksiTerbaru',
            'activities',
            'distribusiSlot',
            'now',
        ));
    }
}
