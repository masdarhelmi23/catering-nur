<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('delivery_schedules')) {
            Schema::create('delivery_schedules', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
                $table->date('delivery_date');
                $table->string('delivery_time');
                $table->string('driver_name')->nullable();
                $table->string('location');
                $table->enum('status', ['Antrean Dapur', 'Proses Masak', 'Siap Kirim', 'Selesai'])->default('Antrean Dapur');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_schedules');
    }
};