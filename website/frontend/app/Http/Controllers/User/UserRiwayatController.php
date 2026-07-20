<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRiwayatController extends Controller
{
    public function index() {
        $pemesanan = Pemesanan::with(['slotParkir.lokasiParkir', 'kendaraan', 'pembayaran'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('waktu_mulai', 'desc')
            ->get();

        $pembayaranList = Pembayaran::with('pemesanan.slotParkir.lokasiParkir')
            ->whereHas('pemesanan', fn($q) => $q->where('user_id', Auth::id()))
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.user.riwayat', compact('pemesanan', 'pembayaranList'));
    }
}
