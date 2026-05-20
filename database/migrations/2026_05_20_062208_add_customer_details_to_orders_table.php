<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan field baru dengan penempatan setelah user_id dan total_bayar
            $table->string('nama_pemesan')->after('user_id');
            $table->string('nomor_wa')->after('nama_pemesan');
            $table->text('catatan')->nullable()->after('total_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['nama_pemesan', 'nomor_wa', 'catatan']);
        });
    }
};