<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan Halaman Form Login Mewah
     */
    public function showLogin()
    {
        // Jika user telanjur login dan dia pengelola, lempar ke dalam panel
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'owner'])) {
            return redirect('/admin');
        }
        
        return view('auth.login'); // Sesuaikan dengan nama file blade login kamu
    }

    /**
     * Proses Validasi Akses Masuk Sistem (Login)
     */
    public function login(Request $request)
    {
        // 1. Validasi input form
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // 2. Cek kecocokan data dengan database
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // 3. JALUR PENGALIHAN PINTAR BERDASARKAN ROLE (REVISI AKTIF)
            return $this->authenticated($request, Auth::user());
        }

        // Jika gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Alamat email atau kata sandi yang Anda masukkan salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Logika Pembagian Hak Akses Rute Pasca Autentikasi Sukses
     */
    protected function authenticated(Request $request, $user)
    {
        // Jika role akun adalah admin atau owner, lempar ke dashboard admin
        if (in_array($user->role, ['admin', 'owner'])) {
            return redirect()->intended('/admin');
        }

        // Jika role akun adalah user biasa (customer), lempar ke halaman depan (port 8000)
        return redirect()->intended('/');
    }

    /**
     * Proses Keluar dari Sesi Sistem (Logout)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout, tendang balik ke halaman beranda customer utama
        return redirect('/');
    }
}