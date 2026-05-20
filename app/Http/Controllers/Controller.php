<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Helper Global untuk Mencatat Jejak Aktivitas Karyawan/Owner ke Database
     */
    public static function logAktivitas($deskripsiAksi)
    {
        DB::table('activity_logs')->insert([
            'user_id'    => Auth::id(),
            'user_name'  => Auth::user()->name ?? 'System Guest',
            'activity'   => $deskripsiAksi,
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}