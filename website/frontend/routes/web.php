<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LokasiParkirController;
use App\Http\Controllers\SlotParkirController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LogSensorController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes - Smart Parking BIA 2026
|--------------------------------------------------------------------------
*/

// ─── Halaman Utama ───────────────────────────────────────────────────────────

// ─── Publik ───────────────────────────────────────────────────────────────────
Route::prefix('lokasi')->name('lokasi.')->group(function () {
    Route::get('/',         [LokasiParkirController::class, 'index'])->name('index');
    Route::get('/{id}',     [LokasiParkirController::class, 'show'])->name('show');
});

Route::get('/', function () {
    return view('pages.home');
});
    

// ─── Terproteksi (harus login) ────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ── Pengguna (admin only) ────────────────────────────────────────────────
    Route::prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/',             [PenggunaController::class, 'index'])->name('index');
        Route::get('/tambah',       [PenggunaController::class, 'create'])->name('create');
        Route::post('/',            [PenggunaController::class, 'store'])->name('store');
        Route::get('/{id}',         [PenggunaController::class, 'show'])->name('show');
        Route::get('/{id}/ubah',    [PenggunaController::class, 'edit'])->name('edit');
        Route::put('/{id}',         [PenggunaController::class, 'update'])->name('update');
        Route::delete('/{id}',      [PenggunaController::class, 'destroy'])->name('destroy');
    });

    // ── Profil pengguna sendiri ──────────────────────────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Lokasi Parkir (admin: write, user: read sudah di atas) ───────────────
    Route::prefix('lokasi')->name('lokasi.')->group(function () {
        Route::get('/tambah',       [LokasiParkirController::class, 'create'])->name('create');
        Route::post('/',            [LokasiParkirController::class, 'store'])->name('store');
        Route::get('/{id}/ubah',    [LokasiParkirController::class, 'edit'])->name('edit');
        Route::put('/{id}',         [LokasiParkirController::class, 'update'])->name('update');
        Route::delete('/{id}',      [LokasiParkirController::class, 'destroy'])->name('destroy');
    });

    // ── Slot Parkir ──────────────────────────────────────────────────────────
    Route::prefix('slot')->name('slot.')->group(function () {
        Route::get('/',             [SlotParkirController::class, 'index'])->name('index');
        Route::get('/{id}',         [SlotParkirController::class, 'show'])->name('show');
    });
    Route::prefix('slot')->name('slot.')->group(function () {
        Route::get('/tambah',       [SlotParkirController::class, 'create'])->name('create');
        Route::post('/',            [SlotParkirController::class, 'store'])->name('store');
        Route::get('/{id}/ubah',    [SlotParkirController::class, 'edit'])->name('edit');
        Route::put('/{id}',         [SlotParkirController::class, 'update'])->name('update');
        Route::delete('/{id}',      [SlotParkirController::class, 'destroy'])->name('destroy');
    });

    // ── Kendaraan ────────────────────────────────────────────────────────────
    Route::prefix('kendaraan')->name('kendaraan.')->group(function () {
        Route::get('/',             [KendaraanController::class, 'index'])->name('index');
        Route::get('/tambah',       [KendaraanController::class, 'create'])->name('create');
        Route::post('/',            [KendaraanController::class, 'store'])->name('store');
        Route::get('/{id}',         [KendaraanController::class, 'show'])->name('show');
        Route::get('/{id}/ubah',    [KendaraanController::class, 'edit'])->name('edit');
        Route::put('/{id}',         [KendaraanController::class, 'update'])->name('update');
        Route::delete('/{id}',      [KendaraanController::class, 'destroy'])->name('destroy');
    });

    // ── Pemesanan ────────────────────────────────────────────────────────────
    Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
        Route::get('/',             [PemesananController::class, 'index'])->name('index');
        Route::get('/buat',         [PemesananController::class, 'create'])->name('create');
        Route::post('/',            [PemesananController::class, 'store'])->name('store');
        Route::get('/{id}',         [PemesananController::class, 'show'])->name('show');
        Route::get('/{id}/ubah',    [PemesananController::class, 'edit'])->name('edit');
        Route::put('/{id}',         [PemesananController::class, 'update'])->name('update');
        Route::delete('/{id}',      [PemesananController::class, 'destroy'])->name('destroy');

        // Aksi cepat
        Route::post('/{id}/batalkan', [PemesananController::class, 'batalkan'])->name('batalkan');
    });

    // ── Pembayaran ───────────────────────────────────────────────────────────
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/',             [PembayaranController::class, 'index'])->name('index');
        Route::get('/buat',         [PembayaranController::class, 'create'])->name('create');
        Route::post('/',            [PembayaranController::class, 'store'])->name('store');
        Route::get('/{id}',         [PembayaranController::class, 'show'])->name('show');
        Route::get('/{id}/ubah',    [PembayaranController::class, 'edit'])->name('edit');
        Route::put('/{id}',         [PembayaranController::class, 'update'])->name('update');
        Route::delete('/{id}',      [PembayaranController::class, 'destroy'])->name('destroy');

        // Konfirmasi pembayaran (admin)
        Route::middleware('can:admin')
             ->post('/{id}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('konfirmasi');
    });

    // ── Log Sensor (admin only) ──────────────────────────────────────────────
    Route::prefix('log-sensor')->name('log-sensor.')->group(function () {
        Route::get('/',             [LogSensorController::class, 'index'])->name('index');
        Route::get('/{id}',         [LogSensorController::class, 'show'])->name('show');
        Route::delete('/{id}',      [LogSensorController::class, 'destroy'])->name('destroy');
    });

    // ── Notifikasi ───────────────────────────────────────────────────────────
    Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
        Route::get('/',             [NotifikasiController::class, 'index'])->name('index');
        Route::get('/{id}',         [NotifikasiController::class, 'show'])->name('show');
        Route::patch('/{id}/baca',  [NotifikasiController::class, 'update'])->name('baca');
        Route::delete('/{id}',      [NotifikasiController::class, 'destroy'])->name('destroy');

        // Tandai semua sudah dibaca
        Route::post('/baca-semua',  [NotifikasiController::class, 'bacaSemua'])->name('baca-semua');
    });
});



require __DIR__.'/auth.php';

