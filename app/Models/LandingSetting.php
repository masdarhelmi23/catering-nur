<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingSetting extends Model
{
    use HasFactory;

    protected $table = 'landing_settings';

    protected $fillable = [
        'hero_subtitle',
        'hero_description',
        'slogan_title',
        'slogan_description',
        'instagram_url',    // Tambahkan ini
        'whatsapp_number',  // Tambahkan ini
        'hero_image_1',
        'hero_image_2',
        'hero_image_3',
        'hero_image_4',
        'hero_image_5',
        'hero_image_6',
    ];
}