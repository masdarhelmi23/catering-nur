<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Panggil Controller Autentikasi
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleController; 
use App\Http\Controllers\Auth\RegisterController;

// Panggil Controller Panel Admin/Owner
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\FoodPackageController;
use App\Http\Controllers\Admin\DeliveryScheduleController;
use App\Http\Controllers\Admin\TransactionController;

// Panggil Controller Sisi Customer
use App\Http\Controllers\Customer\BookingController;

/*
|--------------------------------------------------------------------------
| 1. Rute Publik & Pengalihan Utama
|--------------------------------------------------------------------------
| Halaman utama yang pertama kali diakses oleh customer umum.
*/
Route::get('/', function () {
    // Jalur Pintar Pengelola: Jika Pengguna dalam posisi login, langsung lempar ke dashboard masing-masing role
    if (Auth::check()) {
        if (Auth::user()->role === 'owner') {
            return redirect('/owner/dashboard');
        }
        if (Auth::user()->role === 'admin') {
            return redirect('/admin');
        }
    }
    return view('customer.index');
});

/*
|--------------------------------------------------------------------------
| 2. Rute Autentikasi Manual & Google OAuth (Terbuka / Guest)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Google OAuth Sign-In
Route::get('/auth/google', [GoogleController::class, 'handleGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogle']); 

/*
|--------------------------------------------------------------------------
| 3. Grup Akses Khusus Customer (Wajib Login / Auth Middleware)
|--------------------------------------------------------------------------
| Mengamankan alur transaksi booking katering dan gerbang pembayaran Midtrans.
*/
Route::middleware(['auth', 'role:customer'])->group(function () {
    
    // Alur Proses Pengisian Form Pemesanan Menu
    Route::get('/proses-pesanan/{id}', [BookingController::class, 'showForm'])->name('pesanan.form');
    Route::post('/proses-pesanan/{id}', [BookingController::class, 'submitOrder'])->name('pesanan.submit');
    
    // REVISI FIX 404: Rute POST khusus untuk memperbarui status pembayaran di localhost tanpa callback internet
    Route::post('/proses-pesanan/{id}/update-status', [BookingController::class, 'updateStatusLocal'])->name('pesanan.update.local');
    
    // INTEGRASI MIDTRANS: Halaman khusus invoice & pemicu pop-up Snap payment gateway
    Route::get('/proses-pesanan/{id}/payment', [BookingController::class, 'showPayment'])->name('pesanan.payment');
    
    // Halaman Riwayat Transaksi Pesanan Saya
    Route::get('/pesanan', [BookingController::class, 'index'])->name('pesanan.index');
    
});

/*
|--------------------------------------------------------------------------
| 4. Grup Panel Pengelola - KHUSUS ROLE 'admin' SAJA
|--------------------------------------------------------------------------
| Dikunci ketat agar hanya user dengan role 'admin' yang bisa mengoperasikan menu ini.
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // Halaman Utama Dashboard Admin (Live Monitoring Ringkasan Pesanan)
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Modul CRUD Manajemen Paket Menu Premium + Fitur Kontrol Stok Porsi
    Route::get('/admin/packages', [FoodPackageController::class, 'index'])->name('admin.packages');
    Route::get('/admin/packages/create', [FoodPackageController::class, 'create'])->name('admin.packages.create');
    Route::post('/admin/packages', [FoodPackageController::class, 'store'])->name('admin.packages.store');
    Route::get('/admin/packages/{id}/edit', [FoodPackageController::class, 'edit'])->name('admin.packages.edit');
    Route::put('/admin/packages/{id}', [FoodPackageController::class, 'update'])->name('admin.packages.update');
    Route::delete('/admin/packages/{id}', [FoodPackageController::class, 'destroy'])->name('admin.packages.destroy');
    Route::post('/admin/packages/{id}/toggle', [FoodPackageController::class, 'toggleStatus']);
    
    // Modul Agenda Jadwal Pengiriman Katering Otomatis
    Route::get('/admin/schedules', [DeliveryScheduleController::class, 'index'])->name('admin.schedules');
    Route::get('/admin/schedules/create', [DeliveryScheduleController::class, 'create'])->name('admin.schedules.create');
    Route::post('/admin/schedules', [DeliveryScheduleController::class, 'store'])->name('admin.schedules.store');
    Route::get('/admin/schedules/{id}/edit', [DeliveryScheduleController::class, 'edit'])->name('admin.schedules.edit');
    Route::put('/admin/schedules/{id}', [DeliveryScheduleController::class, 'update'])->name('admin.schedules.update');
    
    // Modul CRUD Transaksi Masuk (Akses Tambah, Edit & Update Manual)
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions');
    Route::get('/admin/transactions/create', [TransactionController::class, 'create'])->name('admin.transactions.create');
    Route::post('/admin/transactions', [TransactionController::class, 'store'])->name('admin.transactions.store');
    Route::get('/admin/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('admin.transactions.edit');
    Route::put('/admin/transactions/{id}', [TransactionController::class, 'update'])->name('admin.transactions.update');
    Route::delete('/admin/transactions/{id}', [TransactionController::class, 'destroy'])->name('admin.transactions.destroy');
    
    // Modul Dropdown Pengaturan Profil Kredensial & Audit Sistem Log Admin Pribadi
    Route::get('/admin/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');
    Route::put('/admin/settings', [AdminDashboardController::class, 'updateSettings'])->name('admin.settings.update');
    Route::get('/admin/logs', [AdminDashboardController::class, 'logs'])->name('admin.logs');
    
    // Modul Manajemen Tampilan Landing Page Beranda (6 Gambar Lingkaran)
    Route::get('/admin/landing-settings', [AdminDashboardController::class, 'landingSettings'])->name('admin.landing.settings');
    Route::put('/admin/landing-settings', [AdminDashboardController::class, 'updateLandingSettings'])->name('admin.landing.settings.update');
    
});

/*
|--------------------------------------------------------------------------
| 5. Grup Panel Khusus Owner - KHUSUS ROLE 'owner' SAJA
|--------------------------------------------------------------------------
| Memisahkan gerbang finansial pembukuan dan CRUD manajemen karyawan mutlak milik Owner.
*/
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    
    // Halaman Beranda Pembukuan Keuangan Otomatis Owner
    Route::get('/dashboard', [TransactionController::class, 'ownerDashboard'])->name('owner.dashboard');
    
    // Fitur Download Cetak Laporan Keuangan (PDF / Excel Bawaan Browser)
    Route::get('/report/download', [TransactionController::class, 'downloadReport'])->name('owner.report.download');
    
    // Modul CRUD User Manajemen Karyawan (Staf Admin, Kurir, Kontrol Akun)
    Route::get('/users', [AdminDashboardController::class, 'usersIndex'])->name('owner.users.index');
    Route::get('/users/create', [AdminDashboardController::class, 'usersCreate'])->name('owner.users.create');
    Route::post('/users', [AdminDashboardController::class, 'usersStore'])->name('owner.users.store');
    Route::get('/users/{id}/edit', [AdminDashboardController::class, 'usersEdit'])->name('owner.users.edit');
    Route::put('/users/{id}', [AdminDashboardController::class, 'usersUpdate'])->name('owner.users.update');
    Route::delete('/users/{id}', [AdminDashboardController::class, 'usersDestroy'])->name('owner.users.destroy');
    
    // Modul Audit Live Log Aktivitas Katering Kerja Nyata
    Route::get('/logs', [AdminDashboardController::class, 'ownerLogs'])->name('owner.logs');
});