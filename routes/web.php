<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

// Halaman login (tidak butuh login untuk mengakses)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Semua halaman di bawah ini WAJIB login dulu
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Barcode buku (letakkan SEBELUM resource biar gak bentrok sama /buku/{buku})
    Route::get('/buku-barcode/cetak-semua', [BukuController::class, 'barcodeSemua'])->name('buku.barcode.semua');
    Route::get('/buku/{buku}/barcode', [BukuController::class, 'barcode'])->name('buku.barcode');

    Route::resource('buku', BukuController::class)->except(['show']);

    Route::resource('anggota', AnggotaController::class)
        ->except(['show'])
        ->parameters(['anggota' => 'anggota']);

    Route::resource('peminjaman', PeminjamanController::class)
        ->except(['show', 'edit', 'update']);

    Route::get('/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'editKembali'])
        ->name('peminjaman.kembali.form');
    Route::put('/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembalikan'])
        ->name('peminjaman.kembali');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});