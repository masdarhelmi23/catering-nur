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
    Schema::table('food_packages', function (Blueprint $table) {
        // Menambahkan kolom stok dengan nilai default 0
        $table->integer('stock')->default(0)->after('price');
    });
}

public function down(): void
{
    Schema::table('food_packages', function (Blueprint $table) {
        $table->dropColumn('stock');
    });
}
};
