<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Rute Autentikasi Sistem Manual
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Halaman Depan Publik (Sementara mengarah langsung ke view login sebelum kamu mengisi welcome.blade)
Route::get('/', function () {
    return redirect('/login');
});

// Grup Pengamanan Rute Panel Admin (Wajib Login Terlebih Dahulu)
Route::middleware(['auth'])->group(function () {
    
    Route::get('/admin', function() {
        return "Selamat datang di Panel Admin Utama!";
    })->name('admin.dashboard');

});