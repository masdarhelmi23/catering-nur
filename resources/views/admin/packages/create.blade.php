<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Menu Baru - Catering Nur Baluwarti</title>
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
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Pendaftaran Hidangan</h2>
                <p class="text-xs text-slate-400">Form penginputan spesifikasi, sisa stok, dan foto visual paket menu baru.</p>
            </div>
            <a href="{{ url('/admin/packages') }}" class="px-3 py-2 bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-semibold rounded-xl border border-white/10 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="luxury-glass rounded-2xl p-6 md:p-8 border border-white/5 shadow-2xl">
            
            @if ($errors->any())
                <div class="mb-5 p-3.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-xs font-semibold flex flex-col gap-1">
                    @foreach ($errors->all() as $error)
                        <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ url('/admin/packages') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="space-y-2 md:col-span-1">
                        <label for="package_name" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Nama Paket Menu</label>
                        <input id="package_name" type="text" name="package_name" value="{{ old('package_name') }}" placeholder="Contoh: Prasmanan Sultan" required autofocus
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label for="price" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Harga Satuan (IDR / Pax)</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 font-mono text-xs font-bold text-[#c29b40]">Rp</span>
                            <input id="price" type="number" name="price" value="{{ old('price') }}" placeholder="150000" required min="0"
                                  class="luxury-input w-full pl-11 pr-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm font-mono text-emerald-400 placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="stock" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Kapasitas Stok (Porsi)</label>
                        <div class="relative flex items-center">
                            <input id="stock" type="number" name="stock" value="{{ old('stock', 0) }}" placeholder="50" required min="0"
                                  class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm font-mono text-amber-400 placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="space-y-2 mb-6">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Foto Dokumentasi Hidangan Menu</label>
                    <div class="relative group border-2 border-dashed border-white/10 hover:border-[#c29b40]/40 rounded-2xl bg-black/20 p-6 text-center transition cursor-pointer flex flex-col items-center justify-center min-h-[140px]">
                        <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewFile()">
                        
                        <div id="upload-placeholder" class="space-y-2 flex flex-col items-center">
                            <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-slate-400 group-hover:text-[#c29b40] group-hover:bg-[#c29b40]/10 transition duration-200">
                                <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                            </div>
                            <p class="text-xs text-slate-300 font-medium">Klik atau drop file gambar di sini</p>
                            <p class="text-[10px] text-slate-500">Mendukung format PNG, JPG, JPEG atau WEBP (Maks. 2MB)</p>
                        </div>
                        
                        <div id="image-preview-container" class="hidden flex flex-col items-center space-y-2">
                            <img id="image-preview" src="#" alt="Preview" class="max-h-28 rounded-xl border border-white/10 shadow-lg object-cover">
                            <p class="text-[10px] text-emerald-400 font-medium"><i class="fa-solid fa-circle-check"></i> Gambar siap diunggah, klik untuk mengganti</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2 mb-6">
                    <label for="description" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Daftar Hidangan & Deskripsi Paket</label>
                    <textarea id="description" name="description" rows="5" placeholder="Tuliskan komponen menu katering lengkap di sini..." required
                              class="luxury-input w-full px-4 py-3 bg-black/30 border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 leading-relaxed focus:outline-none">{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-white/5">
                    <button type="submit" class="px-6 py-3 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-widest rounded-xl shadow-lg transition duration-200">
                        <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Paket Menu
                    </button>
                </div>

            </form>
        </div>

    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

    <script>
        function previewFile() {
            const preview = document.getElementById('image-preview');
            const file = document.getElementById('image').files[0];
            const placeholder = document.getElementById('upload-placeholder');
            const previewContainer = document.getElementById('image-preview-container');
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>