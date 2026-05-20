<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'category',
        'price',
        'stock',
        'description',
        'image',
        'is_available'
    ];
}