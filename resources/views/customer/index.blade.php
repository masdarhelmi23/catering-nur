<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Nur Baluwarti - Premium Catering & Cakes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Background Utama Body Tetap Gelap Radial Bawaan */
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        
        /* REVISI BACKGROUND KOTAK HERO ATAS: Menerapkan mkn.jpg dengan lapisan gelap transparan */
        .hero-bg-mkn {
            background: linear-gradient(rgba(15, 23, 42, 0.88), rgba(2, 6, 23, 0.92)), url('{{ asset("mkn.jpg") }}');
            background-size: cover;
            background-position: center;
        }
        
        .luxury-glass { background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .luxury-input:focus { border-color: #c29b40; background-color: rgba(15, 23, 42, 0.8); box-shadow: 0 0 0 3px rgba(194, 155, 64, 0.15); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col scroll-smooth relative">

    @php
        // Ambil data setting landing page secara realtime dari database
        $landing = \App\Models\LandingSetting::find(1) ?? new \App\Models\LandingSetting();
    @endphp

    @include('customer.layouts.navbar')

    <section class="w-full hero-bg-mkn border-b border-white/5 py-12 md:py-20 px-6 relative overflow-hidden">
        <div class="max-w-[1600px] mx-auto grid grid-cols-1 lg:grid-cols-12 items-center gap-12">
            
            <div class="lg:col-span-4 flex justify-center lg:justify-end items-center gap-3 relative order-2 lg:order-1">
                <div class="w-44 h-44 md:w-52 md:h-52 rounded-full border-4 border-white/5 overflow-hidden shadow-2xl relative bg-slate-900">
                    <img src="{{ $landing->hero_image_1 ? asset('storage/' . $landing->hero_image_1) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500' }}" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col gap-3">
                    <div class="w-28 h-28 md:w-36 md:h-36 rounded-full border-4 border-white/5 overflow-hidden shadow-2xl bg-slate-900">
                        <img src="{{ $landing->hero_image_2 ? asset('storage/' . $landing->hero_image_2) : 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=500' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="w-28 h-28 md:w-36 md:h-36 rounded-full border-4 border-white/5 overflow-hidden shadow-2xl bg-slate-900">
                        <img src="{{ $landing->hero_image_3 ? asset('storage/' . $landing->hero_image_3) : 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500' }}" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 text-center space-y-6 order-1 lg:order-2">
                
                <div class="flex justify-center items-center gap-4 flex-wrap">
                    <a href="https://instagram.com/{{ $landing->instagram_url ?? 'nur_baluwarti' }}" target="_blank" class="w-16 h-16 rounded-full bg-pink-500/10 border border-pink-500/20 flex flex-col items-center justify-center p-2 text-center hover:bg-pink-500/20 transition duration-300">
                        <i class="fa-brands fa-instagram text-base text-pink-400"></i>
                        <span class="text-[8px] font-bold uppercase tracking-tighter text-slate-400 mt-1">Instagram</span>
                    </a>

                    @php
                        $cleanPhone = preg_replace('/[^0-9]/', '', $landing->whatsapp_number ?? '628123456789');
                        if (str_starts_with($cleanPhone, '08')) {
                            $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                    @endphp
                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="w-16 h-16 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex flex-col items-center justify-center p-2 text-center hover:bg-emerald-500/20 transition duration-300">
                        <i class="fa-brands fa-whatsapp text-base text-emerald-400"></i>
                        <span class="text-[8px] font-bold uppercase tracking-tighter text-slate-400 mt-1">WhatsApp</span>
                    </a>
                </div>

                <div class="space-y-2">
                    <h2 class="font-serif text-2xl md:text-4xl font-bold tracking-wide text-white">NUR BALUWARTI</h2>
                    <p class="text-xs md:text-sm font-medium text-[#c29b40] uppercase tracking-[0.25em]">{{ $landing->hero_subtitle ?? 'Homemade Premium Catering & Cakes' }}</p>
                </div>
                <div class="w-16 h-0.5 bg-[#c29b40] mx-auto"></div>
                <p class="text-xs text-slate-400 max-w-sm mx-auto leading-relaxed">
                    {{ $landing->hero_description ?? 'Menyajikan kelezatan kuliner bercita rasa tinggi khas Surakarta untuk momen istimewa Anda.' }}
                </p>
            </div>

            <div class="lg:col-span-4 flex justify-center lg:justify-start items-center gap-3 relative order-3">
                <div class="flex flex-col gap-3">
                    <div class="w-28 h-28 md:w-36 md:h-36 rounded-full border-4 border-white/5 overflow-hidden shadow-2xl bg-slate-900">
                        <img src="{{ $landing->hero_image_4 ? asset('storage/' . $landing->hero_image_4) : 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?q=80&w=500' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="w-28 h-28 md:w-36 md:h-36 rounded-full border-4 border-white/5 overflow-hidden shadow-2xl bg-slate-900">
                        <img src="{{ $landing->hero_image_5 ? asset('storage/' . $landing->hero_image_5) : 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500' }}" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="w-44 h-44 md:w-52 md:h-52 rounded-full border-4 border-white/5 overflow-hidden shadow-2xl relative bg-slate-900">
                    <img src="{{ $landing->hero_image_6 ? asset('storage/' . $landing->hero_image_6) : 'https://images.unsplash.com/photo-1560717789-0ac7c58ac90a?q=80&w=500' }}" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </section>

    <section class="max-w-4xl mx-auto px-6 text-center py-12 space-y-3">
        <h3 class="font-serif text-lg md:text-2xl font-bold uppercase tracking-wider text-white">
            {{ $landing->slogan_title ?? 'CITARASA PRIMA, KUALITAS UTAMA' }}
        </h3>
        <p class="text-xs md:text-sm text-slate-400 leading-relaxed max-w-2xl mx-auto">
            {{ $landing->slogan_description ?? 'Nur Baluwarti berkomitmen penuh menghadirkan jasa boga berkualitas prima dengan pengawasan higienitas ketat untuk menjamin kepuasan rasa.' }}
        </p>
    </section>

    <section id="katalog-menu" class="max-w-[1600px] w-full mx-auto px-6 pb-20 space-y-8">
        <div class="border-b border-white/5 pb-3">
            <h4 class="font-serif text-lg font-bold text-white tracking-wide flex items-center gap-2">
                <i class="fa-solid fa-utensils text-xs text-[#c29b40]"></i> Daftar Pilihan Menu Eksklusif Kami
            </h4>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse((\DB::table('food_packages')->get()) as $package)
                <div class="luxury-glass rounded-2xl overflow-hidden border border-white/5 flex flex-col justify-between hover:border-[#c29b40]/30 transition duration-300 group">
                    <div class="w-full h-44 bg-slate-950 relative overflow-hidden">
                        @if(!empty($package->image))
                            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->package_name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-700 bg-black/40 text-[10px] font-mono tracking-wider">NO DISH IMAGE</div>
                        @endif

                        @if(($package->stock ?? 0) <= 0)
                            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center">
                                <span class="px-3 py-1 bg-red-500/20 border border-red-500/40 text-red-400 text-[10px] font-bold uppercase tracking-widest rounded-lg">Stok Habis</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-5 space-y-2">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-[9px] font-mono font-bold text-[#c29b40] uppercase tracking-wider bg-white/5 px-2 py-0.5 rounded border border-white/5">
                                {{ $package->category ?? 'Paket Pilihan' }}
                            </span>
                            <span class="text-[10px] {{ ($package->stock ?? 0) > 0 ? 'text-slate-400' : 'text-red-400 font-semibold' }}">
                                Sisa: {{ $package->stock ?? 0 }} Porsi
                            </span>
                        </div>
                        <h5 class="text-sm font-bold text-white truncate">{{ $package->package_name }}</h5>
                        <p class="text-[11px] text-slate-400 line-clamp-2 leading-relaxed">{{ $package->description }}</p>
                    </div>
                    
                    <div class="px-5 pb-5 pt-2 bg-black/20 border-t border-white/5 flex items-center justify-between">
                        <div>
                            <p class="text-[8px] uppercase tracking-wider text-slate-500 font-bold">Harga Satuan</p>
                            <p class="text-xs font-mono font-bold text-emerald-400">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        </div>
                        
                        @if(($package->stock ?? 0) > 0)
                            @auth
                                <a href="{{ url('/proses-pesanan/' . $package->id) }}" class="px-3 py-1.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-[10px] font-bold rounded-lg transition inline-block text-center">
                                    Ambil Paket
                                </a>
                            @else
                                <button type="button" onclick="openLoginModal()" class="px-3 py-1.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-[10px] font-bold rounded-lg transition inline-block text-center">
                                    Ambil Paket
                                </button>
                            @endauth
                        @else
                            <button disabled class="px-3 py-1.5 bg-red-500/10 border border-red-500/20 text-red-400/40 text-[10px] font-bold rounded-lg cursor-not-allowed">
                                Habis
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full luxury-glass rounded-2xl p-12 text-center text-xs text-slate-500 italic">
                    Belum ada varian paket katering yang dimasukkan ke dalam sistem utama.
                </div>
            @endforelse
        </div>
    </section>

    <div id="loginAlertModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/70 backdrop-blur-md transition-all duration-300">
        <div class="luxury-glass max-w-sm w-full rounded-2xl p-6 border border-white/10 text-center shadow-2xl transform scale-95 transition-transform duration-300" id="modalCard">
            <div class="w-14 h-14 bg-[#c29b40]/10 border border-[#c29b40]/30 rounded-full flex items-center justify-center mx-auto mb-4 text-[#c29b40] text-xl shadow-lg shadow-amber-950/20">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="space-y-2">
                <h3 class="font-serif text-lg font-bold text-white tracking-wide">Autentikasi Diperlukan</h3>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">
                    Silakan masuk atau daftarkan akun Anda terlebih dahulu untuk memproses pemesanan paket menu katering eksklusif di Nur Baluwarti.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-3 mt-6">
                <button type="button" onclick="closeLoginModal()" class="py-2.5 bg-white/5 hover:bg-white/10 border border-white/5 text-slate-300 text-xs font-bold uppercase tracking-wider rounded-xl transition duration-150">
                    Batal
                </button>
                <a href="{{ url('/login') }}" class="py-2.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-wider rounded-xl transition duration-150 block shadow-lg shadow-amber-950/20">
                    Masuk Akun
                </a>
            </div>
        </div>
    </div>

    <footer class="w-full text-center py-6 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-auto">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

    <script>
        const modal = document.getElementById('loginAlertModal');
        const card = document.getElementById('modalCard');

        function openLoginModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                card.classList.remove('scale-95');
                card.classList.add('scale-100');
            }, 10);
        }

        function closeLoginModal() {
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 200);
        }

        modal.addEventListener('click', function(e) {
            if (e.target === modal) { closeLoginModal(); }
        });
    </script>
</body>
</html>