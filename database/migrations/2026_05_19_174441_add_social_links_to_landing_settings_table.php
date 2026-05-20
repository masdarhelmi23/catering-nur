<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('landing_settings', function (Blueprint $col) {
            $col->string('instagram_url')->nullable()->after('slogan_description');
            $col->string('whatsapp_number')->nullable()->after('instagram_url');
        });
    }

    public function down(): void
    {
        Schema::table('landing_settings', function (Blueprint $col) {
            $col->dropColumn(['instagram_url', 'whatsapp_number']);
        });
    }
};