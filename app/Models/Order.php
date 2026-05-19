<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'tanggal_acara', 'jumlah_porsi', 'total_bayar', 'status'])]
class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}