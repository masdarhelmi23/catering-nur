<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Siapa yang melakukan aksi
            $table->string('user_name')->nullable();           // Backup nama operator
            $table->text('activity');                         // Deskripsi aktivitas riel
            $table->string('ip_address')->nullable();         // IP Komputer operator
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};