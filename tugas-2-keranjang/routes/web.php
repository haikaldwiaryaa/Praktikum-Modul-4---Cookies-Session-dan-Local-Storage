<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CartController::class, 'index'])->name('produk.index');
Route::get('/tambah/{id}', [CartController::class, 'tambah'])->name('cart.tambah');
Route::get('/keranjang', [CartController::class, 'keranjang'])->name('cart.index');
Route::get('/keranjang/ubah/{id}/{aksi}', [CartController::class, 'ubah'])->name('cart.ubah');
Route::get('/keranjang/hapus/{id}', [CartController::class, 'hapus'])->name('cart.hapus');
Route::get('/keranjang/kosongkan', [CartController::class, 'kosongkan'])->name('cart.kosongkan');
