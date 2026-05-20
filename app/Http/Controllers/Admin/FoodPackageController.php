<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodPackageController extends Controller
{
    // 1. Tampilkan Katalog Paket Menu Lengkap dengan Gambar & Status
    public function index()
    {
        $packages = FoodPackage::orderBy('created_at', 'desc')->get();
        return view('admin.packages.index', compact('packages'));
    }

    // 2. Form Tambah Paket
    public function create()
    {
        return view('admin.packages.create');
    }

    // 3. Simpan Paket Baru
    public function store(Request $request)
    {
        // REVISI AKTIF: Menambahkan aturan validasi input 'stock' wajib diisi berupa angka minimal 0
        $request->validate([
            'package_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0', // Validasi stok porsi baru
            'description'  => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
        }

        // REVISI AKTIF: Menyertakan inputan data request 'stock' ke fungsi Eloquent create
        FoodPackage::create([
            'package_name' => $request->package_name,
            'category'     => 'Katering Premium',
            'price'        => $request->price,
            'stock'        => $request->stock, // Menyimpan nilai stok baru
            'description'  => $request->description,
            'image'        => $imagePath,
            'is_available' => true, // Default langsung aktif saat dibuat
        ]);

        return redirect('/admin/packages')->with('success', 'Paket menu baru berhasil didaftarkan!');
    }

    // 4. Form Edit Paket Menu (Mengaktifkan Fitur Edit)
    public function edit($id)
    {
        $package = FoodPackage::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    // 5. Update Perubahan Data ke Database Asli
    public function update(Request $request, $id)
    {
        $package = FoodPackage::findOrFail($id);

        // REVISI AKTIF: Menambahkan aturan validasi input 'stock' pada proses simpan pengubahan data
        $request->validate([
            'package_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0', // Validasi stok porsi edit
            'description'  => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada di storage
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $package->image = $request->file('image')->store('packages', 'public');
        }

        $package->package_name = $request->package_name;
        $package->price = $request->price;
        $package->stock = $request->stock; // REVISI AKTIF: Sinkronisasi pembaruan sisa stok porsi menu
        $package->description = $request->description;
        // Tangkap status tombol aktif/tidak aktif dari form edit
        $package->is_available = $request->has('is_available') ? true : false;
        $package->save();

        return redirect('/admin/packages')->with('success', 'Spesifikasi paket menu berhasil diperbarui!');
    }

    // 6. Fitur Hapus Paket Menu Secara Permanen
    public function destroy($id)
    {
        $package = FoodPackage::findOrFail($id);
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }
        $package->delete();

        return redirect('/admin/packages')->with('success', 'Paket menu telah dihapus dari sistem.');
    }

    // 7. Fitur Instant Toggle Status Aktif via Tombol di Katalog
    public function toggleStatus($id)
    {
        $package = FoodPackage::findOrFail($id);
        $package->is_available = !$package->is_available;
        $package->save();

        return back()->with('success', 'Status ketersediaan menu berhasil diubah!');
    }
}