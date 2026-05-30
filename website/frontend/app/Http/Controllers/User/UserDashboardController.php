<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->sudah_verifikasi == false) return view('pages.user.welcoming');

        $user = Auth::user();

        // Lokasi parkir aktif
        $lokasiParkir = LokasiParkir::aktif()
            ->withCount(['slotParkir as slot_tersedia' => fn($q) => $q->where('status', 'tersedia')])
            ->withCount(['slotParkir as total_slot'])
            ->get();

        // Pemesanan aktif milik user
        $pemesananAktif = Pemesanan::with(['slotParkir.lokasiParkir', 'kendaraan'])
            ->where('user_id', $user->id)
            ->where('status', 'aktif')
            ->first();

        // Riwayat terakhir
        $riwayat = Pemesanan::with(['slotParkir.lokasiParkir'])
            ->where('user_id', $user->id)
            // ->whereIn('status', ['selesai', 'batal'])
            ->orderBy('waktu_mulai', 'desc')
            ->limit(4)
            ->get();

        // Quick stats
        $totalParkir  = Pemesanan::where('user_id', $user->id)->count();
        $totalBiaya   = Pemesanan::where('user_id', $user->id)->where('status', 'selesai')->sum('total_harga');
        $totalKendaraan = $user->kendaraan()->count();

        return view('pages.user.dashboard', compact(
            'lokasiParkir', 'pemesananAktif', 'riwayat',
            'totalParkir', 'totalBiaya', 'totalKendaraan'
        ));
    }

    public function updateSudahVerifikasi() {
        if (Auth::user()->sudah_verifikasi == false) {
            $user = User::find(Auth::user()->id);
            $user->update([
                'sudah_verifikasi' => true
            ]);
        } else {
            return redirect()->route('user.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
}
