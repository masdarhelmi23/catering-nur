<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan proses migrasi untuk menambahkan kolom snap_token.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kolom snap_token setelah total_bayar untuk menyimpan token Midtrans Snap
            $table->string('snap_token')->nullable()->after('total_bayar');
        });
    }

    /**
     * Batalkan proses migrasi (Rollback).
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('snap_token');
        });
    }
};