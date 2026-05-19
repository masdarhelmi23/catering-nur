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
    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('nama_paket');
        $table->text('deskripsi')->nullable();
        $table->integer('harga');
        $table->integer('minimal_order'); // Kolom ini yang akan berfungsi sebagai Kuota Stok Porsi
        $table->string('gambar')->nullable();
        $table->string('kategori')->default('Umum');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
