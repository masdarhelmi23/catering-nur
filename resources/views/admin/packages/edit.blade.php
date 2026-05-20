<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket Menu - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .luxury-input { transition: all 0.2s ease-in-out; }
        .luxury-input:focus { border-color: #c29b40; background-color: rgba(15, 23, 42, 0.8); box-shadow: 0 0 0 3px rgba(194, 155, 64, 0.15); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('admin.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 max-w-[850px] w-full mx-auto space-y-6">
        
        <div class="flex items-center justify-between border-b border-white/5 pb-4">
            <div class="space-y-0.5">
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Edit Spesifikasi Hidangan</h2>
                <p class="text-xs text-slate-400">Modifikasi informasi komponen hidangan, jumlah stok, dan foto paket menu.</p>
            </div>
            <a href="{{ url('/admin/packages') }}" class="px-3 py-2 bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-semibold rounded-xl border border-white/10 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Batal
            </a>
        </div>

        <div class="luxury-glass rounded-2xl p-6 md:p-8 border border-white/5 shadow-2xl">
            
            <form method="POST" action="{{ url('/admin/packages/'.$package->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="space-y-2 md:col-span-1">
                        <label for="package_name" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Nama Paket Menu</label>
                        <input id="package_name" type="text" name="package_name" value="{{ old('package_name', $package->package_name) }}" required class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label for="price" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Harga Satuan (IDR / Pax)</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 font-mono text-xs font-bold text-[#c29b40]">Rp</span>
                            <input id="price" type="number" name="price" value="{{ old('price', $package->price) }}" required min="0" class="luxury-input w-full pl-11 pr-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm font-mono text-emerald-400 focus:outline-none">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="stock" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Kapasitas Stok (Porsi)</label>
                        <input id="stock" type="number" name="stock" value="{{ old('stock', $package->stock ?? 0) }}" required min="0" class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm font-mono text-amber-400 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2 mb-6">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Foto Hidangan Saat Ini & Pembaruan</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center bg-black/20 p-4 rounded-2xl border border-white/5">
                        <div class="h-24 rounded-xl bg-slate-950 overflow-hidden border border-white/10 flex items-center justify-center">
                            @if($package->image)
                                <img id="current-image" src="{{ asset('storage/' . $package->image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-[10px] font-mono text-slate-600 uppercase">Belum ada foto</span>
                            @endif
                        </div>
                        <div class="sm:col-span-2 relative border border-dashed border-white/10 hover:border-[#c29b40]/30 rounded-xl p-4 text-center cursor-pointer min-h-[96px] flex flex-col items-center justify-center">
                            <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewFile()">
                            <p class="text-xs text-slate-300 font-medium" id="upload-txt"><i class="fa-cloud-arrow-up fa-solid text-[#c29b40] mr-1"></i> Klik untuk mengganti foto</p>
                            <p class="text-[9px] text-slate-500 mt-0.5">Format JPG/PNG (Maks 2MB)</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2 mb-6">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Status Operasional</label>
                    <div class="flex items-center gap-3 bg-black/20 p-3 rounded-xl border border-white/5">
                        <input id="is_available" type="checkbox" name="is_available" value="1" {{ $package->is_available ? 'checked' : '' }} class="w-4 h-4 rounded border-white/10 text-[#c29b40] focus:ring-0 accent-[#c29b40] cursor-pointer">
                        <label for="is_available" class="text-xs text-slate-300 cursor-pointer select-none font-medium">Centang untuk memastikan menu ini aktif dan dapat dipesan pelanggan</label>
                    </div>
                </div>

                <div class="space-y-2 mb-6">
                    <label for="description" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Daftar Hidangan & Deskripsi</label>
                    <textarea id="description" name="description" rows="5" required class="luxury-input w-full px-4 py-3 bg-black/30 border border-white/10 rounded-xl text-sm text-white leading-relaxed focus:outline-none">{{ old('description', $package->description) }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-white/5">
                    <button type="submit" class="px-6 py-3 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-widest rounded-xl shadow-lg transition duration-200">
                        <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewFile() {
            const currentImg = document.getElementById('current-image');
            const file = document.getElementById('image').files[0];
            const txt = document.getElementById('upload-txt');
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                if(currentImg) {
                    currentImg.src = reader.result;
                }
                txt.innerHTML = "<i class='fa-solid fa-circle-check text-emerald-400 mr-1'></i> Gambar baru siap ditambahkan";
            }, false);

            if (file) { reader.readAsDataURL(file); }
        }
    </script>
</body>
</html>