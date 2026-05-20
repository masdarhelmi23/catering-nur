<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URL yang dikecualikan dari verifikasi keamanan CSRF Token.
     *
     * @var array<int, string>
     */
    protected $except = [
        // REVISI AKSES: Izinkan JavaScript menembak status secara langsung di localhost tanpa token CSRF
        'proses-pesanan/*/update-status',
    ];
}