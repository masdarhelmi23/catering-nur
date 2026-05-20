<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingSettingController extends Controller
{
    public function index()
    {
        $landing = LandingSetting::find(1) ?? new LandingSetting();
        return view('admin.landing_setting.index', compact('landing'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'slogan_title' => 'nullable|string|max:255',
            'slogan_description' => 'nullable|string',
            'instagram_url' => 'nullable|url', // Validasi format URL
            'whatsapp_number' => 'nullable|string|max:20', // Contoh: 08123456789 atau 628123456789
            // validasi image lainnya...
        ]);

        $landing = LandingSetting::find(1) ?? new LandingSetting();
        $landing->id = 1; // Mengunci agar selalu ID 1

        $landing->hero_subtitle = $request->hero_subtitle;
        $landing->hero_description = $request->hero_description;
        $landing->slogan_title = $request->slogan_title;
        $landing->slogan_description = $request->slogan_description;
        $landing->instagram_url = $request->instagram_url;
        $landing->whatsapp_number = $request->whatsapp_number;

        // Logika upload foto hero_image_1 sampai 6 tetap biarkan seperti kode asli punyamu...
        // ...

        $landing->save();

        return redirect()->back()->with('success', 'Pengaturan Landing Page berhasil diperbarui!');
    }
}