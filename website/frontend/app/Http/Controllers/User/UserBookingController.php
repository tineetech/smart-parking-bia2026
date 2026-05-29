<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserBookingController extends Controller
{
    public function index(LokasiParkir $lokasi) {
        return view('pages.user.lokasi-booking', compact(
            'lokasi',
        ));
    }
}
