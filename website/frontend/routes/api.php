<?php

use App\Http\Controllers\Admin\AdminMonitorController;
use App\Http\Controllers\Api\ApiBookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LokasiParkirController;
use App\Http\Controllers\SlotParkirController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LogSensorController;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| API Routes - Smart Parking
|--------------------------------------------------------------------------
*/

// ─── PUBLIK ─────────────────────────────────────────────
Route::prefix('lokasi')->group(function () {
    Route::get('/',     [LokasiParkirController::class, 'index']);
    Route::get('/{id}', [LokasiParkirController::class, 'show']);
});

Route::get('/booking/selesai', [ApiBookingController::class, 'selesai']);

Route::get('/monitor/slots', [AdminMonitorController::class, 'slotData'])->name('api.monitor.slots');



// ─── PROTECTED (SANCTUM) ────────────────────────────────
// Route::middleware(['auth:sanctum'])->group(function () {

    // ── PENGGUNA ────────────────────────────────────────
    Route::prefix('pengguna')->group(function () {
        Route::get('/',         [PenggunaController::class, 'index']);
        Route::post('/',        [PenggunaController::class, 'store']);
        Route::get('/{id}',     [PenggunaController::class, 'show']);
        Route::put('/{id}',     [PenggunaController::class, 'update']);
        Route::delete('/{id}',  [PenggunaController::class, 'destroy']);
    });

    // ── LOKASI (ADMIN WRITE) ────────────────────────────
    Route::prefix('lokasi')->group(function () {
        Route::post('/',        [LokasiParkirController::class, 'store']);
        Route::put('/{id}',     [LokasiParkirController::class, 'update']);
        Route::delete('/{id}',  [LokasiParkirController::class, 'destroy']);
    });

    // ── SLOT PARKIR ─────────────────────────────────────
    // Route::prefix('slot')->group(function () {
    //     Route::get('/',         [SlotParkirController::class, 'index']);
    //     Route::get('/{id}',     [SlotParkirController::class, 'show']);
    //     Route::post('/',        [SlotParkirController::class, 'store']);
    //     Route::put('/{id}',     [SlotParkirController::class, 'update']);
    //     Route::delete('/{id}',  [SlotParkirController::class, 'destroy']);
    // });

    // ── KENDARAAN ───────────────────────────────────────
    Route::prefix('kendaraan')->group(function () {
        Route::get('/',         [KendaraanController::class, 'index']);
        Route::post('/',        [KendaraanController::class, 'store']);
        Route::get('/{id}',     [KendaraanController::class, 'show']);
        Route::put('/{id}',     [KendaraanController::class, 'update']);
        Route::delete('/{id}',  [KendaraanController::class, 'destroy']);
    });

    // ── PEMESANAN ───────────────────────────────────────
    Route::prefix('pemesanan')->group(function () {
        Route::get('/',         [PemesananController::class, 'index']);
        Route::post('/',        [PemesananController::class, 'store']);
        Route::get('/{id}',     [PemesananController::class, 'show']);
        Route::put('/{id}',     [PemesananController::class, 'update']);
        Route::delete('/{id}',  [PemesananController::class, 'destroy']);


        Route::get('/cek-kode/{kode}', [PemesananController::class, 'cekKodePemesanan']);
        Route::post('/{id}/batalkan', 
            [PemesananController::class, 'batalkan']);
    });

    // ── PEMBAYARAN ──────────────────────────────────────
    Route::prefix('pembayaran')->group(function () {
        Route::get('/',         [PembayaranController::class, 'index']);
        Route::post('/',        [PembayaranController::class, 'store']);
        Route::get('/{id}',     [PembayaranController::class, 'show']);
        Route::put('/{id}',     [PembayaranController::class, 'update']);
        Route::delete('/{id}',  [PembayaranController::class, 'destroy']);

        Route::post('/{id}/konfirmasi', 
            [PembayaranController::class, 'konfirmasi'])
            ->middleware('can:admin');
    });

    // ── LOG SENSOR ──────────────────────────────────────
    Route::prefix('log-sensor')->group(function () {
        Route::get('/',         [LogSensorController::class, 'index']);
        Route::get('/{id}',     [LogSensorController::class, 'show']);
        Route::delete('/{id}',  [LogSensorController::class, 'destroy']);
    });

    // ── NOTIFIKASI ──────────────────────────────────────
    Route::prefix('notifikasi')->group(function () {
        Route::get('/',         [NotifikasiController::class, 'index']);
        Route::get('/{id}',     [NotifikasiController::class, 'show']);
        Route::patch('/{id}',   [NotifikasiController::class, 'update']);
        Route::delete('/{id}',  [NotifikasiController::class, 'destroy']);

        Route::post('/baca-semua', 
            [NotifikasiController::class, 'bacaSemua']);
    });

// });