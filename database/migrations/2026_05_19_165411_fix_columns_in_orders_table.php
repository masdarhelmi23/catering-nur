<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Cek satu per satu, jika belum ada, langsung buatkan kolomnya
            if (!Schema::hasColumn('orders', 'order_code')) {
                $table->string('order_code')->unique()->after('id');
            }
            if (!Schema::hasColumn('orders', 'customer_name')) {
                $table->string('customer_name')->after('order_code');
            }
            if (!Schema::hasColumn('orders', 'package_name')) {
                $table->string('package_name')->after('customer_name');
            }
            if (!Schema::hasColumn('orders', 'delivery_time')) {
                $table->string('delivery_time')->after('package_name');
            }
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('Antrean Dapur')->after('delivery_time');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['order_code', 'customer_name', 'package_name', 'delivery_time', 'status']);
        });
    }
};