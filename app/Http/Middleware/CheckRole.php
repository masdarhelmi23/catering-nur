<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Tangani permintaan yang masuk.
     * Menerima multi-role dipisahkan dengan koma (...$roles).
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses sistem.');
        }

        $user = Auth::user();

        // 2. Cek apakah role pengguna saat ini terdaftar di dalam hak akses rute
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // 3. REVISI UTAMA: JALUR PENGALIHAN OTOMATIS BERDASARKAN TINGKATAN ROLE
        // Jika yang nakal/menerobos adalah customer, tendang ke halaman depan
        if ($user->role === 'customer') {
            return redirect('/')->with('error', 'Anda tidak memiliki hak akses ke halaman pengelola!');
        }
        
        // Jika Admin mencoba menerobos rute khusus Owner (Laporan/CRUD User)
        if ($user->role === 'admin') {
            return redirect('/admin')->with('error', 'Akses ditolak! Halaman tersebut rahasia dan hanya diizinkan khusus Owner.');
        }

        // Jika Owner mencoba membuka rute yang dikunci murni hanya untuk Admin
        if ($user->role === 'owner') {
            return redirect('/owner/dashboard')->with('error', 'Anda dialihkan otomatis langsung ke ruang kendali utama Pimpinan.');
        }

        // Fallback terakhir jika ada role gaib di luar skenario terdaftar
        abort(403, 'Akses ditolak. Anda tidak memiliki izin resmi untuk membuka halaman ini.');
    }
}