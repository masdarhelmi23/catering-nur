<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (FacadesAuth::check()) {
            return FacadesAuth::user()->role === 'admin' ? redirect('/admin') : redirect('/');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (FacadesAuth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            if (FacadesAuth::user()->role === 'admin') {
                return redirect()->intended('/admin');
            }

            FacadesAuth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda tidak memiliki hak akses sebagai pengelola sistem.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Alamat email atau kata sandi yang Anda masukkan salah.',
        ]);
    }

    public function logout(Request $request)
    {
        FacadesAuth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}