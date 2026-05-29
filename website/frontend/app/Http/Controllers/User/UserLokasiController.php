<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserLokasiController extends Controller
{
    public function index(Request $request) {
        $query = LokasiParkir::aktif()->withCount([
            'slotParkir',
            'slotParkir as total_slot_aktif',
            'slotParkir as slot_tersedia_count' => fn($q) => $q->where('status', 'tersedia'),
            'slotParkir as slot_terpakai_count' => fn($q) => $q->where('status', 'terpakai'),
        ]);
 
        // Search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%')
                  ->orWhere('alamat', 'like', '%' . $request->q . '%');
            });
        }
 
        // Filter
        $filter = $request->get('filter', 'all');
 
        if ($filter === 'avail') {
            $query->whereHas('slotParkir', fn($q) => $q->where('status', 'tersedia'));
        } elseif ($filter === 'cheapest') {
            $query->orderBy('harga_per_jam', 'asc');
        } elseif ($filter === 'popular') {
            // Bisa diganti dengan rating jika ada kolom rating
            $query->orderBy('total_slot', 'desc');
        }
 
        $lokasis = $query->get()->map(function ($lokasi) {
            $slotTersedia = $lokasi->slot_tersedia_count ?? 0;
            $slotTerpakai = $lokasi->slot_terpakai_count ?? 0;
 
            if ($slotTersedia === 0) {
                $lokasi->status_slot = 'full';
            } elseif ($slotTersedia <= 5) {
                $lokasi->status_slot = 'busy';
            } else {
                $lokasi->status_slot = 'avail';
            }
 
            $lokasi->slot_tersedia = $slotTersedia;
            return $lokasi;
        });
 
        // Untuk map markers — kirim semua lokasi aktif (tidak terfilter)
        $allLokasi = LokasiParkir::aktif()->withCount([
            'slotParkir as slot_tersedia_count' => fn($q) => $q->where('status', 'tersedia'),
        ])->get()->map(function ($l) {
            $s = $l->slot_tersedia_count ?? 0;
            return [
                'id'     => $l->id,
                'nama'   => $l->nama,
                'alamat' => $l->alamat,
                'lat'    => (float) $l->latitude,
                'lng'    => (float) $l->longitude,
                'status' => $s === 0 ? 'full' : ($s <= 5 ? 'busy' : 'avail'),
                'slots'  => $s,
                'harga'  => 'Rp ' . number_format($l->harga_per_jam, 0, ',', '.') . '/jam',
                'foto'   => $l->foto ? asset('storage/' . $l->foto) : null,
            ];
        })->values();
 
        return view('pages.user.lokasi', compact('lokasis', 'allLokasi', 'filter'));
    }

    public function showLokasi(LokasiParkir $lokasi) {
        $user = Auth::user();

        // ── Status buka/tutup berdasarkan jam sekarang ──────────────────
        $now      = Carbon::now();
        $jamBuka  = Carbon::createFromTimeString($lokasi->jam_buka);
        $jamTutup = Carbon::createFromTimeString($lokasi->jam_tutup);

        // Handle overnight (jam_tutup < jam_buka, e.g. 22:00 – 06:00)
        if ($jamTutup->lt($jamBuka)) {
            $sedangBuka = $now->gte($jamBuka) || $now->lte($jamTutup);
        } else {
            $sedangBuka = $now->between($jamBuka, $jamTutup);
        }

        // ── Slot: hitung dari relasi slotParkir ─────────────────────────
        $slotAll = $lokasi->slotParkir()->where('status', '!=', 'nonaktif')->get();

        $totalMotor     = $slotAll->where('kendaraan_type', 'motor')->count();
        $tersediaMotor  = $slotAll->where('kendaraan_type', 'motor')->where('status', 'tersedia')->count();

        $totalMobil     = $slotAll->where('kendaraan_type', 'mobil')->count();
        $tersediaMobil  = $slotAll->where('kendaraan_type', 'mobil')->where('status', 'tersedia')->count();

        $totalSlot      = $totalMotor + $totalMobil;
        $totalTersedia  = $tersediaMotor + $tersediaMobil;

        // Persen slot tersedia (untuk progress bar)
        $pctMotor = $totalMotor > 0 ? round(($tersediaMotor / $totalMotor) * 100) : 0;
        $pctMobil = $totalMobil > 0 ? round(($tersediaMobil / $totalMobil) * 100) : 0;

        // ── Jam operasional string ───────────────────────────────────────
        $jamOperasional = Carbon::createFromTimeString($lokasi->jam_buka)->format('H.i')
            . ' - '
            . Carbon::createFromTimeString($lokasi->jam_tutup)->format('H.i');

        $slotAll = $lokasi->slotParkir()->where('status', '!=', 'nonaktif')->get();

        $slotData = $slotAll->map(function ($s) {
            return [
                'id'     => $s->id,
                'kode'   => $s->kode_slot,
                'type'   => $s->kendaraan_type,
                'status' => $s->status,
                'nomor'  => $s->nomor_slot,
            ];
        })->values()->toArray();

        // $foto360Url = $lokasi->foto_360
        //     ? Storage::url($lokasi->foto_360)
        //     : null;
        // SEMENTARA untuk testing — hapus setelah selesai
        $lokasi->foto_360 = asset('assets/img/location-parking/360_test.jpg');

        $foto360Url = $lokasi->foto_360;

        return view('pages.user.lokasi-detail', compact(
            'lokasi',
            'user',
            'sedangBuka',
            'jamOperasional',
            'totalSlot',
            'totalTersedia',
            'totalMotor',
            'tersediaMotor',
            'totalMobil',
            'tersediaMobil',
            'slotData',
            'foto360Url',
            'pctMotor',
            'pctMobil',
            'slotAll',
        ));
    }
}
