<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembayaranLandingController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiLandingController;
use App\Http\Controllers\QurbanController;
use App\Http\Controllers\QurbanLandingController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('landing.home');
Route::resource('home', HomeController::class);
Route::resource('daftar_qurban', QurbanLandingController::class);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('qurban', QurbanController::class);
    Route::resource('seller', SellerController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('kelompok', KelompokController::class);
    Route::resource('masjid', MasjidController::class);
    Route::resource('pendaftaran_saya', PembayaranLandingController::class);
    Route::get('/pendaftaran_saya', [PembayaranLandingController::class, 'index'])->name('landing.pembayaran');
    Route::get('/pendaftaran_saya/sukses/{id_transaksi}', [PembayaranLandingController::class, 'sukses'])->name('landing.sukses');
    Route::get('/pendaftaran_saya/pending/{id_transaksi}', [PembayaranLandingController::class, 'pending'])->name('landing.pending');
    Route::get('/pendaftaran_saya/gagal/{id_transaksi}', [PembayaranLandingController::class, 'gagal'])->name('landing.gagal');
    Route::resource('transaksi_saya', TransaksiLandingController::class);
    Route::get('/transaksi_saya', [TransaksiLandingController::class, 'index'])->name('landing.transaksi');
});
