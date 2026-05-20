<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    // Nama fungsi di bawah ini HARUS 'handleGoogle' agar sesuai rute web.php
    public function handleGoogle(Request $request)
    {
        // KONDISI 1: Jika di URL tidak ada parameter 'code' dari Google, maka ANTAR USER KE GOOGLE
        if (! $request->has('code')) {
            return Socialite::driver('google')->stateless()->redirect();
        }

        // KONDISI 2: Jika user kembali dari Google membawa 'code', LANGSUNG PROSES DI SINI
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Alur Login Akun Lama
                Auth::login($user);
                
                // REVISI ALUR PENGALIHAN PINTAR: Cek role akun dari database
                if (in_array($user->role, ['admin', 'owner'])) {
                    return redirect()->intended('/admin');
                }
                
                // Jika role akun adalah 'user' (customer), lempar ke beranda utama port 8000
                return redirect()->intended('/');
            } else {
                // Alur Daftar Akun Baru (Otomatis Register jika email belum terdaftar)
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()), // Membuat password acak aman
                    'role' => 'user', // Default register baru sebagai 'user' (customer) demi keamanan sistem
                ]);

                Auth::login($newUser);
                
                // REVISI ALUR PENGALIHAN PINTAR: Cek role akun baru
                if (in_array($newUser->role, ['admin', 'owner'])) {
                    return redirect()->intended('/admin');
                }
                
                // Akun baru ber-role 'user' otomatis diarahkan ke beranda utama port 8000
                return redirect()->intended('/');
            }

        } catch (Exception $e) {
            return redirect('/login')->withErrors([
                'email' => 'Gagal masuk menggunakan Google, silakan coba lagi.',
            ]);
        }
    }
}