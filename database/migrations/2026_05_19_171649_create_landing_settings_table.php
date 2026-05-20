<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_settings', function (Blueprint $table) {
            $table->id();
            // Field untuk Teks
            $table->string('slogan_title')->default('CITARASA PRIMA, KUALITAS UTAMA');
            $table->text('slogan_description')->nullable();
            $table->string('hero_subtitle')->default('Homemade Premium Catering & Cakes');
            $table->text('hero_description')->nullable();
            
            // Field untuk 6 Foto Lingkaran di Hero Banner
            $table->string('hero_image_1')->nullable();
            $table->string('hero_image_2')->nullable();
            $table->string('hero_image_3')->nullable();
            $table->string('hero_image_4')->nullable();
            $table->string('hero_image_5')->nullable();
            $table->string('hero_image_6')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_settings');
    }
};