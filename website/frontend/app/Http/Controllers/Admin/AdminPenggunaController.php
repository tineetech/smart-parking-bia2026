<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminPenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name',        'like', "%{$search}%")
                  ->orWhere('email',     'like', "%{$search}%")
                  ->orWhere('no_telepon','like', "%{$search}%");
            });
        }

        // Filter role
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        // Filter status  (aktif = email_verified_at not null, nonaktif = null, diblokir via role)
        if ($status = $request->input('status')) {
            match ($status) {
                'aktif'    => $query->whereNotNull('email_verified_at'),
                'nonaktif' => $query->whereNull('email_verified_at'),
                'diblokir' => $query->where('role', 'diblokir'),
                default    => null,
            };
        }

        $pengguna     = $query->latest()->paginate(15)->withQueryString();
        $totalPengguna = User::count();
        $aktifHariIni  = User::whereDate('updated_at', today())->count();

        return view('pages.admin.pengguna', compact('pengguna', 'totalPengguna', 'aktifHariIni'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|string|min:8|confirmed',
            'role'            => 'required|in:admin,user',
            'no_telepon'      => 'nullable|string|max:20',
            'sudah_verifikasi'=> 'nullable|boolean',
            'foto_profil'     => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('foto-profil', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        if ($request->boolean('sudah_verifikasi')) {
            $validated['sudah_verifikasi'] = true;
        }

        User::create($validated);

        return redirect()->route('admin.pengguna.index')
                         ->with('success', "Pengguna {$validated['name']} berhasil ditambahkan.");
    }

    public function update(Request $request, User $pengguna)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => ['required', 'email', Rule::unique('users','email')->ignore($pengguna->id)],
            'password'        => 'nullable|string|min:8|confirmed',
            'role'            => 'required|in:admin,user',
            'no_telepon'      => 'nullable|string|max:20',
            'sudah_verifikasi'=> 'nullable|boolean',
            'foto_profil'     => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'hapus_foto'      => 'nullable|boolean',
        ]);

        // Handle foto
        if ($request->boolean('hapus_foto')) {
            if ($pengguna->foto_profil) Storage::disk('public')->delete($pengguna->foto_profil);
            $validated['foto_profil'] = null;
        } elseif ($request->hasFile('foto_profil')) {
            if ($pengguna->foto_profil) Storage::disk('public')->delete($pengguna->foto_profil);
            $validated['foto_profil'] = $request->file('foto_profil')->store('foto-profil', 'public');
        }

        // Password opsional
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Verifikasi email
        $validated['sudah_verifikasi'] = $request->boolean('sudah_verifikasi') ? true : false;

        $pengguna->update($validated);

        return redirect()->route('admin.pengguna.index')
                         ->with('success', "Pengguna {$pengguna->name} berhasil diperbarui.");
    }

    public function destroy(User $pengguna)
    {
        if ($pengguna->foto_profil) {
            Storage::disk('public')->delete($pengguna->foto_profil);
        }

        $nama = $pengguna->name;
        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')
                         ->with('success', "Pengguna {$nama} berhasil dihapus.");
    }

    public function indexProfile() {
        return view('pages.admin.profile');
    }
    public function updateInfo(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email,' . $user->id],
            'no_telepon' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($request->only('name', 'email', 'no_telepon'));
        return back()->with('success', 'Informasi profil berhasil diperbarui.');
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        $request->validate(['foto_profil' => ['nullable', 'image', 'max:4096']]);

        if ($request->boolean('hapus_foto') && $user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
            $user->update(['foto_profil' => null]);
            return back()->with('success', 'Foto profil dihapus.');
        }

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) Storage::disk('public')->delete($user->foto_profil);
            $path = $request->file('foto_profil')->store('avatars', 'public');
            $user->update(['foto_profil' => $path]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        Auth::user()->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function logoutOther(Request $request)
    {
        Auth::logoutOtherDevices($request->password ?? '');
        return back()->with('success', 'Semua sesi lain telah diakhiri.');
    }
}