<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Konten Beranda - Admin Panel Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at top right, #1e1b4b 0%, #0f172a 60%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .luxury-card { background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.03); transition: all 0.3s ease; }
        .luxury-card:hover { border-color: rgba(194, 155, 64, 0.2); box-shadow: 0 10px 30px -10px rgba(2, 6, 23, 0.7); }
        .luxury-input { background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.25s ease-in-out; }
        .luxury-input:focus { border-color: #c29b40; background-color: rgba(15, 23, 42, 0.8); box-shadow: 0 0 0 4px rgba(194, 155, 64, 0.1); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('admin.layouts.navbar')

    <main class="max-w-[1400px] w-full mx-auto px-6 py-8 flex-grow space-y-8">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-white/5 pb-5">
            <div>
                <h2 class="font-serif text-2xl font-bold tracking-wide text-white">Manajemen Tampilan Beranda</h2>
                <p class="text-xs text-slate-400 mt-1">Sesuaikan informasi teks utama, slogan boga, and 6 tata letak gambar lingkaran pada halaman depan customer.</p>
            </div>
            <div class="flex items-center gap-2 text-xs bg-amber-500/10 border border-amber-500/20 text-[#c29b40] px-4 py-2 rounded-xl font-medium">
                <i class="fa-solid fa-circle-info"></i> Mode Sinkronisasi Live
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-xs font-semibold flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.landing.settings.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            @csrf
            @method('PUT')

            <div class="lg:col-span-7 space-y-6">
                
                <div class="luxury-card rounded-2xl p-6 md:p-8 space-y-5">
                    <div class="flex items-center gap-3 border-b border-white/5 pb-3">
                        <div class="w-8 h-8 rounded-lg bg-[#c29b40]/10 border border-[#c29b40]/20 flex items-center justify-center text-[#c29b40]">
                            <i class="fa-solid fa-font text-xs"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white tracking-wide">Konpresi Teks & Judul Utama</h3>
                            <p class="text-[11px] text-slate-400">Teks sambutan yang pertama kali dibaca oleh calon pembeli.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="hero_subtitle" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Hero Subtitle / Tagline Menu</label>
                            <input type="text" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $settings->hero_subtitle) }}" placeholder="Contoh: Homemade Premium Catering & Cakes" required
                                   class="luxury-input w-full px-4 py-3 rounded-xl text-xs text-white placeholder-slate-600 focus:outline-none">
                        </div>

                        <div>
                            <label for="hero_description" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Deskripsi Singkat Beranda</label>
                            <textarea id="hero_description" name="hero_description" rows="3" placeholder="Tulis deskripsi filosofi katering di sini..." required
                                      class="luxury-input w-full px-4 py-3 rounded-xl text-xs text-white placeholder-slate-600 focus:outline-none resize-none leading-relaxed">{{ old('hero_description', $settings->hero_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="luxury-card rounded-2xl p-6 md:p-8 space-y-5">
                    <div class="flex items-center gap-3 border-b border-white/5 pb-3">
                        <div class="w-8 h-8 rounded-lg bg-[#c29b40]/10 border border-[#c29b40]/20 flex items-center justify-center text-[#c29b40]">
                            <i class="fa-solid fa-quote-left text-xs"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white tracking-wide">Pernyataan Komitmen & Slogan</h3>
                            <p class="text-[11px] text-slate-400">Bagian penegasan kualitas rasa di bawah banner utama.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="slogan_title" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Judul Slogan Besar</label>
                            <input type="text" id="slogan_title" name="slogan_title" value="{{ old('slogan_title', $settings->slogan_title) }}" placeholder="Contoh: CITARASA PRIMA, KUALITAS UTAMA" required
                                   class="luxury-input w-full px-4 py-3 rounded-xl text-xs text-white placeholder-slate-600 focus:outline-none">
                        </div>

                        <div>
                            <label for="slogan_description" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Deskripsi Lengkap Slogan</label>
                            <textarea id="slogan_description" name="slogan_description" rows="3" placeholder="Tulis rincian komitmen higienitas atau jaminan rasa..." required
                                      class="luxury-input w-full px-4 py-3 rounded-xl text-xs text-white placeholder-slate-600 focus:outline-none resize-none leading-relaxed">{{ old('slogan_description', $settings->slogan_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="luxury-card rounded-2xl p-6 md:p-8 space-y-5">
                    <div class="flex items-center gap-3 border-b border-white/5 pb-3">
                        <div class="w-8 h-8 rounded-lg bg-[#c29b40]/10 border border-[#c29b40]/20 flex items-center justify-center text-[#c29b40]">
                            <i class="fa-solid fa-share-nodes text-xs"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white tracking-wide">Kontak Sosial Media</h3>
                            <p class="text-[11px] text-slate-400">Masukkan nama pengguna Instagram dan nomor WhatsApp operasional katering.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="instagram_url" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Username Instagram</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-xs font-semibold text-slate-500">@</span>
                                <input type="text" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="nur_baluwarti"
                                       class="luxury-input w-full pl-8 pr-4 py-3 rounded-xl text-xs text-white placeholder-slate-600 focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label for="whatsapp_number" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Nomor WhatsApp CS</label>
                            <input type="text" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" placeholder="Contoh: 08123456789 atau 628123456789"
                                   class="luxury-input w-full px-4 py-3 rounded-xl text-xs text-white placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    
                    <button type="submit" class="px-7 py-3 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-wider rounded-xl transition duration-200 shadow-lg shadow-amber-950/20">
                        <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Perubahan
                    </button>
                </div>

            </div>

            <div class="lg:col-span-5 space-y-6">
                <div class="luxury-card rounded-2xl p-6 md:p-8 space-y-6">
                    <div class="flex items-center gap-3 border-b border-white/5 pb-3">
                        <div class="w-8 h-8 rounded-lg bg-[#c29b40]/10 border border-[#c29b40]/20 flex items-center justify-center text-[#c29b40]">
                            <i class="fa-solid fa-images text-xs"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white tracking-wide">Koleksi Foto Komposisi Banner</h3>
                            <p class="text-[11px] text-slate-400">Unggah 6 foto makanan/kue terbaik untuk tata letak lingkaran.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @for($i = 1; $i <= 6; $i++)
                            @php $imgField = 'hero_image_' . $i; @endphp
                            <div class="p-4 bg-black/20 rounded-xl border border-white/5 space-y-3 flex flex-col items-center text-center">
                                <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Posisi Lingkaran {{ $i }}</span>
                                
                                <div class="w-20 h-20 rounded-full overflow-hidden bg-slate-900 border-2 border-white/10 shadow-inner relative group">
                                    @if($settings->$imgField)
                                        <img src="{{ asset('storage/' . $settings->$imgField) }}" alt="Foto {{ $i }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-950 text-slate-700 text-[8px] font-mono">DEFAULT</div>
                                    @endif
                                </div>

                                <label class="w-full">
                                    <span class="block text-[10px] bg-white/5 hover:bg-white/10 text-slate-300 font-medium py-1.5 px-3 rounded-lg border border-white/5 cursor-pointer text-center transition duration-150">
                                        Pilih Gambar
                                    </span>
                                    <input type="file" name="hero_image_{{ $i }}" accept="image/*" class="hidden">
                                </label>
                            </div>
                        @endfor
                    </div>

                    <div class="p-3 bg-slate-950/40 border border-white/5 rounded-xl flex items-start gap-2 text-[10px] text-slate-400 leading-relaxed">
                        <i class="fa-solid fa-circle-exclamation text-[#c29b40] mt-0.5"></i>
                        <span>Disarankan menggunakan file berekstensi <strong>.jpg / .png / .webp</strong> dengan rasio persegi (1:1) agar lingkaran terpotong simetris sempurna di layar customer.</span>
                    </div>

                </div>
            </div>

        </form>

    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[9px] text-slate-600 uppercase tracking-widest font-semibold">
        &copy; {{ date('Y') }} Nur Baluwarti Console &bull; Central Control Unit
    </footer>

    <script>
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const spanLabel = this.previousElementSibling;
                    spanLabel.textContent = "Terpilih ✓";
                    spanLabel.classList.remove('bg-white/5', 'text-slate-300');
                    spanLabel.classList.add('bg-amber-500/10', 'text-[#c29b40]', 'border-amber-500/20');
                }
            });
        });
    </script>

</body>
</html>