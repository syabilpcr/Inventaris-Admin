<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriAsetController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\LokasiAsetController;
use App\Http\Controllers\PemeliharaanAsetController;
use App\Http\Controllers\MutasiAsetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/auth', [AuthController::class, 'index']);

    // Proses Logika (POST)
    // Nama route disesuaikan dengan form action di view Anda
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {

    // Halaman setelah berhasil login
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('kategori-aset', KategoriAsetController::class);
    Route::resource('aset', AsetController::class);
    Route::resource('lokasi-aset', LokasiAsetController::class);
    Route::resource('pemeliharaan', PemeliharaanAsetController::class);
    Route::resource('mutasi', MutasiAsetController::class);
    Route::resource('user', UserController::class);
});
