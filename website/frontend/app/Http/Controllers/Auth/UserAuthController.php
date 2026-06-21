<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class UserAuthController extends Controller
{
    public function loginShow() {
        return view('pages.user.auth.login');
    }
    
    
    public function loginStore(Request $request)
    {
        // VALIDASI
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // LOGIN
        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah'
                ])
                ->withInput();
        }

        // REGENERATE SESSION
        $request->session()->regenerate();

        // REDIRECT
        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Login berhasil!');
    }

    public function registerShow() {
        return view('pages.user.auth.register');
    }

    public function registerStore(Request $request)
    {
        // VALIDASI
        $request->validate([
            'nama_depan' => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // SIMPAN DATA
        User::create([
            'name' => $request->nama_depan . ' ' . $request->nama_belakang,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'user',
            'sudah_verifikasi' => false,
            'dibuat_pada' => now(),
            'diperbarui_pada' => now(),
        ]);

        return redirect()->route('user.login')->with('success', 'Registrasi berhasil!');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('user.login')->withErrors(['email' => 'Login Google gagal, silakan coba lagi.']);
        }

        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update(['google_id' => $googleUser->getId()]);
            } else {
                $name = $googleUser->getName() ?? $googleUser->getEmail();
                $user = User::create([
                    'name' => $name,
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(24)),
                    'role' => 'user',
                    'sudah_verifikasi' => true,
                    'foto_profil' => $googleUser->getAvatar(),
                ]);
            }
        }

        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
    }
}
