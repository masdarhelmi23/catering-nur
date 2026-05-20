<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kolom tempat_antar setelah kolom delivery_time
            // Dibuat nullable() agar data transaksi lama atau log sistem tidak crash/eror
            $table->string('tempat_antar', 255)->nullable()->after('delivery_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus kembali kolom jika dilakukan rollback migrasi
            $table->dropColumn('tempat_antar');
        });
    }
};