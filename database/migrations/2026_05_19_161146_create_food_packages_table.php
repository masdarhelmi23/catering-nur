<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('food_packages')) {
            Schema::create('food_packages', function (Blueprint $table) {
                $table->id();
                $table->string('package_name'); // Contoh: Prasmanan Sultan Box
                $table->string('category'); // Contoh: Buffet, Nasi Box, Wedding
                $table->bigInteger('price'); // Contoh: 150000
                $table->text('description'); // Detail isi menu katering
                $table->boolean('is_available')->default(true); // Status ketersediaan menu
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('food_packages');
    }
};