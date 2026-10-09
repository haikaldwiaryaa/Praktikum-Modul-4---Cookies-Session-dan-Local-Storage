<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index'])->name('shop.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/tambah-keranjang/{id}', [ShopController::class, 'tambahKeranjang'])->name('cart.tambah');
    Route::get('/keranjang', [ShopController::class, 'keranjang'])->name('cart.index');
    Route::get('/keranjang/ubah/{id}/{aksi}', [ShopController::class, 'ubahQty'])->name('cart.ubah');
    Route::get('/keranjang/hapus/{id}', [ShopController::class, 'hapusKeranjang'])->name('cart.hapus');
    Route::get('/keranjang/kosongkan', [ShopController::class, 'kosongkanKeranjang'])->name('cart.kosongkan');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [OrderController::class, 'prosesCheckout'])->name('order.prosesCheckout');
    Route::get('/riwayat-pesanan', [OrderController::class, 'riwayat'])->name('orders.riwayat');
});
