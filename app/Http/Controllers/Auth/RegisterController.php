<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 1. Menampilkan halaman form register manual
    public function showRegister()
    {
        return view('auth.register');
    }

    // 2. Memproses data input pendaftaran manual ke database
    public function register(Request $request)
    {
        // Validasi input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ], [
            'email.unique' => 'Alamat email ini sudah terdaftar!',
            'password.min' => 'Kata sandi minimal harus 6 karakter.',
        ]);

        // Simpan data user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Otomatis diset admin agar kamu bisa langsung tes masuk /admin
        ]);

        // Otomatis loginkan user setelah sukses mendaftar
        Auth::login($user);

        // Arahkan ke dashboard admin utama
        return redirect('/');
    }
}