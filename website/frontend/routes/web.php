<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLokasiController;
use App\Http\Controllers\Admin\AdminMonitorController;
use App\Http\Controllers\Admin\AdminPemesananController;
use App\Http\Controllers\Admin\AdminPenggunaController;
use App\Http\Controllers\Admin\AdminSlotParkirController;
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
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserLokasiController;
use App\Http\Controllers\User\UserPengaturanController;
use App\Http\Controllers\User\UserRiwayatController;

/*
|--------------------------------------------------------------------------
| Web Routes - Smart Parking BIA 2026
|--------------------------------------------------------------------------
*/

// ─── Halaman Utama ───────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::get('/tentang-kami', function () {
    return view('pages.tentang-kami');
})->name('tentang');
Route::get('/hubungi-kami', function () {
    return view('pages.hubungi-kami');
})->name('hubungi');


// USER ONLY
Route::middleware('role:user')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/{id}', [UserDashboardController::class, 'updateSudahVerifikasi'])->name('dashboard.verify');

        Route::get('/lokasi', [UserLokasiController::class, 'index'])->name('lokasi');
        Route::get('/lokasi/{lokasi}', [UserLokasiController::class, 'showLokasi'])->name('lokasi.show');
        Route::get('/lokasi/booking/{lokasi}', [UserBookingController::class, 'index'])->name('lokasi.booking.create');
        Route::get('/lokasi/{lokasi}/slots/realtime', [UserBookingController::class, 'realtimeSlots'])
            ->name('lokasi.slots.realtime');
        Route::post('/lokasi/booking', [UserBookingController::class, 'storeBooking'])->name('lokasi.booking.store');

        Route::get('/booking/qr/{pemesanan}', [UserBookingController::class, 'qrShow'])->name('booking.qr');

        // Pembayaran
        Route::get('/pembayaran/{pemesanan}', [UserBookingController::class, 'showPembayaran'])->name('pembayaran.show');
        Route::post('/pembayaran/bca-va', [UserBookingController::class, 'createBcaVA'])->name('pembayaran.bca-va');
        Route::get('/pembayaran/check-status', [UserBookingController::class, 'checkStatus'])->name('pembayaran.check-status');
        Route::post('/pembayaran/callback', [UserBookingController::class, 'frontendCallback'])->name('pembayaran.callback');
        Route::get('/pembayaran-sukses/{pembayaran}', [UserBookingController::class, 'paymentSuccess'])->name('pembayaran.sukses');

        Route::post('/midtrans/notification', [UserBookingController::class, 'midtransCallback'])
            ->name('midtrans.notification');

        Route::get('/kendaraan', [UserPengaturanController::class, 'indexKendaraan'])->name('kendaraan');
        Route::get('/kendaraan/tambah', [UserPengaturanController::class, 'indexKendaraanCreate'])->name('kendaraan.create');
        Route::post('/kendaraan/tambah', [UserPengaturanController::class, 'storeKendaraan'])->name('kendaraan.store');
        Route::put('/kendaraan/update/{kendaraan}', [UserPengaturanController::class, 'updateKendaraan'])->name('kendaraan.update');
        Route::delete('/kendaraan/{kendaraan}', [UserPengaturanController::class, 'deleteKendaraan'])->name('kendaraan.destroy');
        Route::get('/kendaraan/{id}', [UserPengaturanController::class, 'indexKendaraanDetail'])->name('kendaraan.detail');

        Route::get('/riwayat-booking', [UserRiwayatController::class, 'index'])->name('riwayat');

        Route::get('/pengaturan', [UserPengaturanController::class, 'index'])->name('pengaturan');
        Route::get('/pengaturan/user-edit', [UserPengaturanController::class, 'indexUserEdit'])->name('pengaturan.user-edit');
        Route::put('/pengaturan/user-edit', [UserPengaturanController::class, 'updateUserEdit'])->name('pengaturan.user-edit.update');
    });
});

// ADMIN ONLY
Route::middleware('role:admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/monitor-parkir', [AdminMonitorController::class, 'index'])->name('monitor');

    Route::resource('/lokasi', AdminLokasiController::class);

    Route::delete('/slot/bulk-destroy', [AdminSlotParkirController::class, 'bulkDestroy'])
        ->name('slot.bulk-destroy');
    Route::resource('/slot', AdminSlotParkirController::class);

    Route::resource('/pengguna', AdminPenggunaController::class);

    Route::get('pemesanan/export-pdf', [AdminPemesananController::class, 'exportPdf'])
        ->name('pemesanan.exportPdf');
    Route::resource('/pemesanan', AdminPemesananController::class);
    Route::patch('pemesanan/{pemesanan}/status', [AdminPemesananController::class, 'updateStatus'])
        ->name('pemesanan.updateStatus');

    Route::get('/profile',                  [AdminPenggunaController::class, 'indexProfile'])->name('profile.edit');
    Route::put('/profile',                  [AdminPenggunaController::class, 'updateInfo'])->name('profile.update');
    Route::put('/profile/avatar',           [AdminPenggunaController::class, 'updateAvatar'])->name('profile.avatar');
    Route::put('/profile/password',         [AdminPenggunaController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile/logout-other',  [AdminPenggunaController::class, 'logoutOther'])->name('profile.logout-other');
});



require __DIR__ . '/auth.php';
