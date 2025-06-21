<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Login route tetap terbuka
Route::resource('Login', LoginController::class);

// Route yang membutuhkan login
Route::middleware('auth')->group(function () {
    // Resource routes
    Route::resource('kasir', KasirController::class);
    Route::resource('barang', BarangController::class);

    // Kasir custom routes
    Route::post('/kasir/add-to-cart', [KasirController::class, 'addToCart'])->name('kasir.add');
    Route::post('/kasir/store', [KasirController::class, 'store'])->name('kasir.store');
    Route::get('/kasir/cetak/{id}', [KasirController::class, 'cetak'])->name('kasir.cetak');
    Route::delete('/kasir/hapus/{index}', [KasirController::class, 'hapusItem'])->name('kasir.hapus');

    // Laporan custom route
    Route::get('/laporan/cetak/{id}', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});