<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliverySchedule; // Import model jadwal

class Order extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'order_code',
        'customer_name',
        'user_id',
        'nama_pemesan',   // REVISI AKTIF: Buka akses simpan data nama pemesan katering
        'nomor_wa',       // REVISI AKTIF: Buka akses simpan data nomor WhatsApp pemesan
        'package_name',
        'delivery_time',
        'tempat_antar',
        'tanggal_acara',
        'jumlah_porsi',
        'total_bayar',
        'catatan',        // REVISI AKTIF: Buka akses simpan data catatan instruksi khusus menu
        'status',
        'snap_token'
    ];

    /**
     * Logika Otomatisasi Sistem Katering Nur Baluwarti
     */
    protected static function booted()
    {
        // Fungsi ini berjalan OTOMATIS setelah data Order berhasil dibuat
        static::created(function ($order) {
            
            // JALUR PENGAMAN LOG: Jika statusnya adalah 'Sistem' (Audit Log), 
            // kita tidak perlu membuat jadwal pengiriman katering otomatis.
            if ($order->status === 'Sistem') {
                return;
            }

            // Jika statusnya pesanan riil, buat jadwal pengiriman otomatis ke antrean dapur
            DeliverySchedule::create([
                'order_id'      => $order->id,
                'delivery_date' => $order->tanggal_acara,
                'delivery_time' => $order->delivery_time,
                'location'      => $order->tempat_antar ?? 'Alamat Belum Ditentukan', 
                'status'        => 'Antrean Dapur',                                   
            ]);
        });
    }
}