<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'delivery_date',
        'delivery_time',
        'driver_name',
        'location',
        'status'
    ];

    // Relasi balik ke model Order untuk mengambil nama pelanggan dan paket menu
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}