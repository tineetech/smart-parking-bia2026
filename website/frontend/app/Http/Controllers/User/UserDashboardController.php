<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index() {
        if (Auth::user()->sudah_verifikasi == false) return view('pages.user.welcoming');
        return view('pages.user.dashboard');
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
