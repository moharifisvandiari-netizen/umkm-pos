<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;

// LOGIN TIDAK KENA MIDDLEWARE
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN ROUTES
Route::middleware(['admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('metode-pembayaran', MetodePembayaranController::class);
    Route::resource('pembelian', PembelianController::class);
    Route::resource('penjualan', PenjualanController::class);
});
