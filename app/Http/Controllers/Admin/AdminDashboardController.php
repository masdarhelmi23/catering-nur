<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\LandingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan Halaman Utama Dashboard Admin Katering
     */
    public function index()
    {
        // Menyaring data pesanan asli agar status 'Sistem' log lama tidak mengacaukan monitoring dapur
        $orders = Order::where('status', '!=', 'Sistem')
                       ->orderBy('created_at', 'desc')
                       ->take(4)
                       ->get();

        return view('admin.dashboard', compact('orders'));
    }

    /**
     * Tampilkan Halaman Pengaturan Akun (Dropdown Profil)
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Proses Update Nama & Password Akun Admin Ber-Enkripsi (Memicu Log Asli)
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Simpan data kredensial baru ke database
        $user->name = $request->name;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // REVISI UTAMA 1: Picu Helper Global Log Aktivitas Asli Baru
        parent::logAktivitas("Mengubah informasi profil & password keamanan administrator utama");

        return redirect()->back()->with('success', 'Profil kredensial Administrator berhasil diperbarui!');
    }

    /**
     * Tampilkan Halaman Log Aktivitas / Audit Jejak Sistem Admin Pribadi
     */
    public function logs()
    {
        // REVISI UTAMA 2: Membaca riwayat log asli dari tabel activity_logs khusus milik admin yang login
        $logs = DB::table('activity_logs')
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.logs', compact('logs'));
    }

    /**
     * Tampilkan Halaman Form Manajemen Landing Page Customer
     */
    public function landingSettings()
    {
        $settings = LandingSetting::firstOrCreate(['id' => 1]);
        return view('admin.landing_settings', compact('settings'));
    }

    /**
     * Proses Simpan/Update Konten Landing Page (Memicu Log Asli)
     */
    public function updateLandingSettings(Request $request)
    {
        $settings = LandingSetting::find(1);

        // Update Informasi Teks Utama & Sosial Media Username
        $settings->update([
            'slogan_title'       => $request->slogan_title,
            'slogan_description' => $request->slogan_description,
            'instagram_url'      => $request->instagram_url,
            'whatsapp_number'    => $request->whatsapp_number,
            'hero_subtitle'      => $request->hero_subtitle,
            'hero_description'   => $request->hero_description,
        ]);

        // Proses Loop validasi penyimpanan berkas 6 Foto Banner
        for ($i = 1; $i <= 6; $i++) {
            $fieldName = 'hero_image_' . $i;
            if ($request->hasFile($fieldName)) {
                if ($settings->$fieldName) {
                    Storage::disk('public')->delete($settings->$fieldName);
                }
                $path = $request->file($fieldName)->store('landing', 'public');
                $settings->$fieldName = $path;
            }
        }

        $settings->save();

        // REVISI UTAMA 3: Picu Helper Global Log Aktivitas Asli Baru
        parent::logAktivitas("Memperbarui tata letak komponen teks dan muatan visual foto pada Hero Banner Landing Page Beranda");

        return redirect()->back()->with('success', 'Tampilan konten Landing Page Customer berhasil diperbarui secara live!');
    }

    /*
    |--------------------------------------------------------------------------
    | PANEL OWNER: MODUL CRUD USER (MANAJEMEN KARYAWAN)
    |--------------------------------------------------------------------------
    */

    /**
     * Tampilkan List Akun Karyawan / Staf
     */
    public function usersIndex()
    {
        $users = DB::table('users')->orderBy('id', 'desc')->get();
        return view('owner.users.index', compact('users'));
    }

    /**
     * Form Tambah Karyawan Baru
     */
    public function usersCreate()
    {
        return view('owner.users.create');
    }

    /**
     * Simpan Akun Karyawan Baru ke Database (Memicu Log Asli)
     */
    public function usersStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|in:admin,owner,customer',
        ]);

        DB::table('users')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'role'       => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // REVISI UTAMA 4: Picu Helper Global Log Aktivitas Asli Baru
        parent::logAktivitas("Mendaftarkan akun staf karyawan baru bernama: " . $request->name . " dengan tingkatan role: " . $request->role);

        return redirect('/owner/users')->with('success', 'Akun staf karyawan baru katering berhasil didaftarkan!');
    }

    /**
     * Form Edit Akun Karyawan
     */
    public function usersEdit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) {
            abort(404, 'User tidak ditemukan.');
        }
        return view('owner.users.edit', compact('user'));
    }

    /**
     * Proses Simpan Perubahan Akun Karyawan (Memicu Log Asli)
     */
    public function usersUpdate(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role'  => 'required|string|in:admin,owner,customer',
        ]);

        $updateData = [
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $updateData['password'] = bcrypt($request->password);
        }

        DB::table('users')->where('id', $id)->update($updateData);

        // REVISI UTAMA 5: Picu Helper Global Log Aktivitas Asli Baru
        parent::logAktivitas("Memperbarui kredensial data akun personal milik staf ID: " . $id . " (" . $request->name . ")");

        return redirect('/owner/users')->with('success', 'Data kredensial akun karyawan berhasil diperbarui!');
    }

    /**
     * Hapus Akun Karyawan (Memicu Log Asli)
     */
    public function usersDestroy($id)
    {
        if ($id == Auth::id()) {
            return redirect('/owner/users')->with('error', 'Anda tidak diperbolehkan menghapus akun Owner utama Anda sendiri!');
        }

        $user = DB::table('users')->where('id', $id)->first();
        
        DB::table('users')->where('id', $id)->delete();

        // REVISI UTAMA 6: Picu Helper Global Log Aktivitas Asli Baru
        if ($user) {
            parent::logAktivitas("Mencabut hak akses sistem dan menghapus akun staf karyawan: " . $user->name);
        }

        return redirect('/owner/users')->with('success', 'Hak akses akun karyawan berhasil dicabut dari sistem!');
    }

    /*
    |--------------------------------------------------------------------------
    | PANEL OWNER: AUDIT LIVE LOG AKTIVITAS SISTEM
    |--------------------------------------------------------------------------
    */
    public function ownerLogs()
    {
        // REVISI UTAMA 7: Menampilkan sirkulasi data audit murni dari tabel log aktivitas baru secara realtime
        $logs = DB::table('activity_logs')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.logs', compact('logs'));
    }
}