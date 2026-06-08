<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRiwayatController extends Controller
{
    public function index() {
        $pemesanan = Pemesanan::with(['slotParkir.lokasiParkir', 'kendaraan', 'pembayaran'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('waktu_mulai', 'desc')
            ->get();

        return view('pages.user.riwayat', compact('pemesanan'));
    }
}
