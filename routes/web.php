<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute Publik (Bisa diakses tanpa login)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', function () {
    return view('about-us');
})->name('about.us');

// Resource Login (Sebaiknya gunakan huruf kecil untuk URL: 'login')
Route::resource('Login', LoginController::class);

// 2. Rute Private (Harus Login terlebih dahulu)
Route::middleware('auth')->group(function () {

    // Resource routes untuk fitur utama
    // Route::resource('kasir', KasirController::class);
    // Route::resource('barang', BarangController::class);

    // // Kasir custom routes
    // Route::post('/kasir/add-to-cart', [KasirController::class, 'addToCart'])->name('kasir.add');
    // Route::post('/kasir/store', [KasirController::class, 'store'])->name('kasir.store');
    // Route::get('/kasir/cetak/{id}', [KasirController::class, 'cetak'])->name('kasir.cetak');
    // Route::delete('/kasir/hapus/{index}', [KasirController::class, 'hapusItem'])->name('kasir.hapus');

    // Resource routes untuk fitur utama
    Route::resource('kasir', KasirController::class);
    Route::resource('barang', BarangController::class);

    // Kasir custom routes
    Route::post('/kasir/add-to-cart', [KasirController::class, 'addToCart'])->name('kasir.add');
    Route::get('/kasir/cetak/{id}', [KasirController::class, 'cetak'])->name('kasir.cetak');
    Route::delete('/kasir/hapus/{index}', [KasirController::class, 'hapusItem'])->name('kasir.hapus');

    // Laporan custom route
    Route::get('/laporan/cetak/{id}', [LaporanController::class, 'cetak'])->name('laporan.cetak');

    // Route Riwayat Transaksi
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
});
