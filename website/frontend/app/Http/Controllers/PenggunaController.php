<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    /**
     * GET /pengguna
     * Tampilkan daftar semua pengguna.
     */
    public function index(Request $request): JsonResponse
    {
        $query = User::query();

        if ($request->filled('peran')) {
            $query->where('peran', $request->peran);
        }

        if ($request->filled('sudah_verifikasi')) {
            $query->where('sudah_verifikasi', filter_var($request->sudah_verifikasi, FILTER_VALIDATE_BOOLEAN));
        }

        $pengguna = $query->orderBy('created_at', 'desc')
                          ->paginate($request->get('per_halaman', 15));

        return response()->json($pengguna);
    }

    /**
     * POST /pengguna
     * Simpan pengguna baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:100',
            'email'           => 'required|email|max:150|unique:pengguna,email',
            'kata_sandi'      => 'required|string|min:8',
            'no_telepon'      => 'nullable|string|max:20',
            'peran'           => 'nullable|in:user,admin',
            'foto_profil'     => 'nullable|string|max:255',
            'sudah_verifikasi' => 'nullable|boolean',
        ]);

        $validated['kata_sandi']   = Hash::make($validated['kata_sandi']);

        $pengguna = User::create($validated);

        return response()->json($pengguna, 201);
    }

    /**
     * GET /pengguna/{id}
     * Tampilkan pengguna tertentu.
     */
    public function show(string $id): JsonResponse
    {
        $pengguna = User::with(['kendaraan', 'pemesanan', 'notifikasi'])
                            ->findOrFail($id);

        return response()->json($pengguna);
    }

    /**
     * PUT|PATCH /pengguna/{id}
     * Perbarui data pengguna.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $pengguna = User::findOrFail($id);

        $validated = $request->validate([
            'nama'            => 'sometimes|string|max:100',
            'email'           => ['sometimes', 'email', 'max:150', Rule::unique('pengguna', 'email')->ignore($pengguna->id)],
            'kata_sandi'      => 'sometimes|string|min:8',
            'no_telepon'      => 'nullable|string|max:20',
            'peran'           => 'nullable|in:user,admin',
            'foto_profil'     => 'nullable|string|max:255',
            'sudah_verifikasi' => 'nullable|boolean',
        ]);

        if (isset($validated['kata_sandi'])) {
            $validated['kata_sandi'] = Hash::make($validated['kata_sandi']);
        }

        $pengguna->update($validated);

        return response()->json($pengguna);
    }

    /**
     * DELETE /pengguna/{id}
     * Hapus pengguna.
     */
    public function destroy(string $id): JsonResponse
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return response()->json(['pesan' => 'Pengguna berhasil dihapus.']);
    }
}
