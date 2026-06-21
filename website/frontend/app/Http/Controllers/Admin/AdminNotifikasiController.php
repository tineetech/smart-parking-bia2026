<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminNotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Notifikasi::with('user');

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        // Filter jenis
        if ($jenis = $request->input('jenis')) {
            $query->where('jenis', $jenis);
        }

        // Filter status baca
        if ($status = $request->input('status')) {
            match ($status) {
                'dibaca'    => $query->where('sudah_dibaca', true),
                'belum'     => $query->where('sudah_dibaca', false),
                default     => null,
            };
        }

        $notifikasi = $query->latest()->paginate(15)->withQueryString();
        $totalNotifikasi = Notifikasi::count();
        $belumDibaca = Notifikasi::belumDibaca()->count();
        $users = User::orderBy('name')->get();

        return view('pages.admin.notifikasi', compact('notifikasi', 'totalNotifikasi', 'belumDibaca', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'judul'   => 'required|string|max:150',
            'pesan'   => 'required|string',
            'jenis'   => 'required|in:pemesanan,pembayaran,sistem,promo',
            'sudah_dibaca' => 'nullable|boolean',
        ]);

        $validated['sudah_dibaca'] = $request->boolean('sudah_dibaca');
        $sudahDibaca = $validated['sudah_dibaca'];

        if ($validated['user_id'] === 'all') {
            $users = User::all();
            $notifData = [];
            foreach ($users as $user) {
                $notifData[] = [
                    'user_id'      => $user->id,
                    'judul'        => $validated['judul'],
                    'pesan'        => $validated['pesan'],
                    'jenis'        => $validated['jenis'],
                    'sudah_dibaca' => $sudahDibaca,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }
            Notifikasi::insert($notifData);

            return redirect()->route('admin.notifikasi.index')
                             ->with('success', 'Notifikasi berhasil dikirim ke semua pengguna (' . count($users) . ' pengguna).');
        }

        $validated['user_id'] = (int) $validated['user_id'];

        Notifikasi::create($validated);

        $userName = User::find($validated['user_id'])->name;

        return redirect()->route('admin.notifikasi.index')
                         ->with('success', "Notifikasi untuk {$userName} berhasil dikirim.");
    }

    public function update(Request $request, Notifikasi $notifikasi)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'judul'   => 'required|string|max:150',
            'pesan'   => 'required|string',
            'jenis'   => 'required|in:pemesanan,pembayaran,sistem,promo',
            'sudah_dibaca' => 'nullable|boolean',
        ]);

        $validated['sudah_dibaca'] = $request->boolean('sudah_dibaca');

        if ($validated['user_id'] === 'all') {
            unset($validated['user_id']);
        } else {
            $validated['user_id'] = (int) $validated['user_id'];
        }

        $notifikasi->update($validated);

        return redirect()->route('admin.notifikasi.index')
                         ->with('success', "Notifikasi {$notifikasi->judul} berhasil diperbarui.");
    }

    public function markAsRead(Notifikasi $notifikasi)
    {
        $notifikasi->update(['sudah_dibaca' => true]);

        return redirect()->route('admin.notifikasi.index')
                         ->with('success', 'Notifikasi ditandai sebagai sudah dibaca.');
    }

    public function markAllAsRead()
    {
        Notifikasi::belumDibaca()->update(['sudah_dibaca' => true]);

        return redirect()->route('admin.notifikasi.index')
                         ->with('success', 'Semua notifikasi ditandai sebagai sudah dibaca.');
    }

    public function destroy(Notifikasi $notifikasi)
    {
        $notifikasi->delete();

        return redirect()->route('admin.notifikasi.index')
                         ->with('success', 'Notifikasi berhasil dihapus.');
    }
}
