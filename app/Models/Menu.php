<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_paket', 'deskripsi', 'harga', 'minimal_order', 'gambar', 'kategori'])]
class Menu extends Model
{
    // Properti model menu katering
}