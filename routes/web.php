<?php

use App\Http\Controllers\AuthController;
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
        return view('pages.dashboard'); // Pastikan Anda memiliki resources/views/dashboard.blade.php
    })->name('dashboard');

    // Proses Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});