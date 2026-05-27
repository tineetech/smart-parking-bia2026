<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index() {
        if (Auth::user()->sudah_verifikasi == false) return view('pages.user.welcoming');
        return view('pages.user.dashboard');
    }
}
