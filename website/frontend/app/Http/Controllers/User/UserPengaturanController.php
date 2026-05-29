<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserPengaturanController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['kendaraan', 'pemesanan']);
 
        $stats = [
            'total_parkir'   => $user->pemesanan()->whereIn('status', ['selesai', 'aktif'])->count(),
            'total_kendaraan'=> $user->kendaraan()->count(),
            'booking_aktif'  => $user->pemesanan()->where('status', 'aktif')->count(),
        ];
 
        return view('pages.user.pengaturan', compact('user', 'stats'));
    }
    
    public function indexUserEdit() {
        $user = Auth::user();
        return view('pages.user.pengaturan-user-edit', compact('user'));
    }

    
    public function editProfil()
    {
        $user = Auth::user();
        return view('pages.user.pengaturan-profil', compact('user'));
    }
 
    public function updateUserEdit(Request $request)
    {
        $user = Auth::user();
 
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'no_telepon'  => 'nullable|string|max:20',
            'alamat'  => 'nullable|string',
            'jenis_kelamin'  => 'nullable|string',
            'tanggal_lahir'  => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
 
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $validated['foto_profil'] = $request->file('foto_profil')
                ->store('foto_profil', 'public');
        }
 
        $user->update($validated);
 
        return redirect()->route('user.pengaturan')
            ->with('success', 'Profil berhasil diperbarui.');
    }
    
    public function indexKendaraan(Request $request) {
        $query = Auth::user()->kendaraan();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('merek', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('plat_nomor', 'like', "%{$search}%")
                  ->orWhere('warna', 'like', "%{$search}%")
                  ->orWhere('jenis', 'like', "%{$search}%");
            });
        }

        $kendaraan = $query->latest()->get();

        return view('pages.user.pengaturan-kendaraan', compact('kendaraan', 'search'));
    }
    
    public function indexKendaraanCreate() {
        return view('pages.user.pengaturan-kendaraan-create');
    }

    
    public function storeKendaraan(Request $request)
    {
        $validated = $request->validate([
            'jenis'      => ['required', 'in:mobil,motor'],
            'merek'      => ['required', 'string', 'max:50'],
            'model'      => ['required', 'string', 'max:50'],
            'plat_nomor' => ['required', 'string', 'max:20', 'unique:kendaraan,plat_nomor'],
            'warna'      => ['nullable', 'string', 'max:30'],
            'utama'      => ['boolean'],
        ], [
            'jenis.required'      => 'Jenis kendaraan wajib dipilih.',
            'jenis.in'            => 'Jenis kendaraan tidak valid.',
            'merek.required'      => 'Merek kendaraan wajib diisi.',
            'model.required'      => 'Model / varian wajib diisi.',
            'plat_nomor.required' => 'Plat nomor wajib diisi.',
            'plat_nomor.unique'   => 'Plat nomor ini sudah terdaftar.',
            'plat_nomor.max'      => 'Plat nomor maksimal 20 karakter.',
        ]);

        $user = Auth::user();

        // Jika dijadikan utama, reset semua kendaraan lain milik user ini
        if (!empty($validated['utama'])) {
            $user->kendaraan()->update(['utama' => false]);
        }

        $user->kendaraan()->create([
            'jenis'      => $validated['jenis'],
            'merek'      => $validated['merek'],
            'model'      => $validated['model'],
            'plat_nomor' => strtoupper(trim($validated['plat_nomor'])),
            'warna'      => $validated['warna'] ?? null,
            'utama'      => !empty($validated['utama']),
        ]);

        return redirect()
            ->route('user.kendaraan')
            ->with('success', 'Kendaraan berhasil ditambahkan!');
    }
    
    public function indexKendaraanDetail($id) {
        $kendaraan = Kendaraan::find($id);
        $totalParkir = Auth::user()->pemesanan()->whereIn('status', ['selesai', 'aktif'])->count();
        $totalBayar = 0;
        return view('pages.user.pengaturan-kendaraan-detail', compact('kendaraan', 'totalParkir', 'totalBayar'));
    }

    
    public function updateKendaraan(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'jenis'      => ['required', 'in:mobil,motor'],
            'merek'      => ['required', 'string', 'max:50'],
            'model'      => ['required', 'string', 'max:50'],
            'plat_nomor' => ['required', 'string', 'max:20'],
            'warna'      => ['nullable', 'string', 'max:30'],
            'utama'      => ['boolean'],
        ], [
            'jenis.required'      => 'Jenis kendaraan wajib dipilih.',
            'jenis.in'            => 'Jenis kendaraan tidak valid.',
            'merek.required'      => 'Merek kendaraan wajib diisi.',
            'model.required'      => 'Model / varian wajib diisi.',
            'plat_nomor.required' => 'Plat nomor wajib diisi.',
            'plat_nomor.max'      => 'Plat nomor maksimal 20 karakter.',
        ]);

        $user = Auth::user();

        // Jika dijadikan utama, reset semua kendaraan lain milik user ini
        if (!empty($validated['utama'])) {
            $user->kendaraan()->update(['utama' => false]);
        }

        // dd($validated['jenis']);

        $kendaraan->update([
            'jenis'      => $validated['jenis'],
            'merek'      => $validated['merek'],
            'model'      => $validated['model'],
            'plat_nomor' => strtoupper(trim($validated['plat_nomor'])),
            'warna'      => $validated['warna'] ?? null,
            'utama'      => $validated['utama'] ?? false,
        ]);

        // dd($updateKendaraan);

        return redirect()
            ->route('user.kendaraan')
            ->with('success', 'Kendaraan berhasil diupdate!');
    }
            
    public function deleteKendaraan(Kendaraan $kendaraan) {
        $kendaraan->delete();
        return redirect()
            ->route('user.kendaraan')
            ->with('success', 'Kendaraan berhasil dihapus!');

    }
    
}
