<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan - Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at top left, #1e1b4b 0%, #0f172a 65%, #020617 100%); }
        .luxury-glass-premium { background: rgba(30, 41, 59, 0.75); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .luxury-input-light { background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.2s ease-in-out; }
        .luxury-input-light:focus { border-color: #c29b40; background-color: rgba(15, 23, 42, 0.9); box-shadow: 0 0 0 3px rgba(194, 155, 64, 0.3); }
        
        /* Memaksa ikon picker bawaan browser agar berwarna Gold */
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(67%) sepia(43%) saturate(565%) hue-rotate(354deg) brightness(91%) contrast(87%);
            cursor: pointer;
            padding: 2px;
        }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col justify-between">

    <div class="[&_input]:hidden [&_button.absolute]:hidden [&_.max-w-xl]:w-0 [&_.max-w-xl]:mx-0">
        @include('customer.layouts.navbar')
    </div>

    <main class="max-w-[1200px] w-full mx-auto p-4 md:p-8 flex-grow flex items-center">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 w-full">
            
            <div class="lg:col-span-5 flex flex-col justify-between luxury-glass-premium rounded-2xl p-6 border border-white/10 shadow-xl">
                <div class="space-y-4">
                    <div class="w-full h-64 bg-slate-950 rounded-xl overflow-hidden border border-white/10 shadow-inner relative">
                        @if(!empty($package->image))
                            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->package_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-500 space-y-2">
                                <i class="fa-solid fa-utensils text-4xl"></i>
                                <span class="text-xs font-mono tracking-wider uppercase">No Dish Image Available</span>
                            </div>
                        @endif
                        
                        <span class="absolute top-3 left-3 text-[9px] font-mono font-bold text-[#c29b40] uppercase tracking-wider bg-slate-900/90 backdrop-blur-md px-2.5 py-1 rounded border border-white/10">
                            {{ $package->category ?? 'Katering Premium' }}
                        </span>
                    </div>

                    <div class="space-y-2">
                        <h2 class="font-serif text-2xl font-bold text-white tracking-wide border-b border-white/5 pb-2">{{ $package->package_name }}</h2>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Komposisi & Deskripsi Menu:</p>
                        <div class="bg-black/20 p-4 rounded-xl border border-white/5 min-h-[100px]">
                            <p class="text-xs text-slate-300 leading-relaxed whitespace-pre-line">{{ $package->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between bg-black/10 -mx-6 -mb-6 p-6 rounded-b-2xl">
                    <div>
                        <p class="text-[9px] uppercase tracking-wider text-slate-400 font-bold">Harga Base Per Pax</p>
                        <p class="text-xl font-mono font-bold text-emerald-400">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] uppercase tracking-wider text-slate-400 font-bold">Ketersediaan</p>
                        <span class="inline-block text-xs font-semibold text-amber-400 bg-amber-500/10 px-2.5 py-1 rounded-md border border-amber-500/20 mt-1">
                            {{ $package->stock }} Porsi Siap Diorder
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 luxury-glass-premium rounded-2xl p-6 md:p-8 border border-white/10 shadow-2xl flex flex-col justify-center">
                <div class="border-b border-white/10 pb-3 mb-4">
                    <h3 class="font-serif text-xl font-bold text-white tracking-wide">Konfigurasi Rencana Pemesanan</h3>
                    <p class="text-xs text-slate-400 mt-1">Silakan lengkapi parameter pelaksanaan agenda katering di bawah ini.</p>
                </div>

                <form method="POST" action="{{ url('/proses-pesanan/'.$package->id) }}" class="space-y-4">
                    @csrf

                    @if ($errors->any())
                        <div class="p-3.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-xs font-semibold flex flex-col gap-1">
                            @foreach ($errors->all() as $error)
                                <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="space-y-1.5">
                        <label for="nama_pemesan" class="block text-[10px] font-bold uppercase tracking-widest text-slate-300">Nama Lengkap Pemesan <span class="text-red-400">*</span></label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-slate-500"><i class="fa-solid fa-user text-xs"></i></span>
                            <input id="nama_pemesan" type="text" name="nama_pemesan" value="{{ old('nama_pemesan', Auth::user()->name) }}" required 
                                   placeholder="Ketik nama lengkap penanggung jawab"
                                   class="luxury-input-light w-full pl-10 pr-4 py-2.5 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="nomor_wa" class="block text-[10px] font-bold uppercase tracking-widest text-slate-300">Nomor WhatsApp Aktif <span class="text-red-400">*</span></label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-slate-500"><i class="fa-brands fa-whatsapp text-sm"></i></span>
                            <input id="nomor_wa" type="tel" name="nomor_wa" value="{{ old('nomor_wa') }}" required 
                                   placeholder="Contoh: 081234567890"
                                   class="luxury-input-light w-full pl-10 pr-4 py-2.5 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="tanggal_acara" class="block text-[10px] font-bold uppercase tracking-widest text-slate-300">Tanggal Acara <span class="text-red-400">*</span></label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-500 pointer-events-none"><i class="fa-solid fa-calendar-day text-xs"></i></span>
                                <input id="tanggal_acara" type="date" name="tanggal_acara" required 
                                       class="luxury-input-light w-full pl-10 pr-4 py-2.5 rounded-xl text-sm text-white focus:outline-none">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label for="delivery_time" class="block text-[10px] font-bold uppercase tracking-widest text-slate-300">Jam Siap Kirim <span class="text-red-400">*</span></label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-500 pointer-events-none"><i class="fa-solid fa-clock text-xs"></i></span>
                                <input id="delivery_time" type="time" name="delivery_time" required 
                                       class="luxury-input-light w-full pl-10 pr-4 py-2.5 rounded-xl text-sm text-white focus:outline-none cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="tempat_antar" class="block text-[10px] font-bold uppercase tracking-widest text-slate-300">Tempat / Lokasi Pengantaran <span class="text-red-400">*</span></label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-slate-500"><i class="fa-solid fa-map-location-dot text-xs text-[#c29b40]"></i></span>
                            <input id="tempat_antar" type="text" name="tempat_antar" value="{{ old('tempat_antar') }}" required 
                                   placeholder="Contoh: Gedung Aula Pemkot Surakarta atau Alamat Rumah Lengkap"
                                   class="luxury-input-light w-full pl-10 pr-4 py-2.5 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center">
                            <label for="jumlah_porsi" class="block text-[10px] font-bold uppercase tracking-widest text-slate-300">Jumlah Porsi (Pax) <span class="text-red-400">*</span></label>
                            <span class="text-[10px] font-mono text-slate-400 bg-slate-900/50 px-2 py-0.5 rounded border border-white/5">Maks: {{ $package->stock }}</span>
                        </div>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-slate-500 pointer-events-none"><i class="fa-solid fa-cubes text-xs"></i></span>
                            <input id="jumlah_porsi" type="number" name="jumlah_porsi" min="1" max="{{ $package->stock }}" placeholder="Ketik kuantitas (pax)..." required 
                                   oninput="calculateTotal(this.value, {{ $package->price }})" 
                                   class="luxury-input-light w-full pl-10 pr-4 py-2.5 rounded-xl text-sm font-mono text-white placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="catatan" class="block text-[10px] font-bold uppercase tracking-widest text-slate-300">Catatan Khusus <span class="text-slate-500">(Opsional)</span></label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 top-3 text-slate-500"><i class="fa-solid fa-comment-dots text-xs"></i></span>
                            <textarea id="catatan" name="catatan" rows="2" placeholder="Contoh: Request sambal dipisah, tanpa seledri, atau tambahan sendok..." 
                                      class="luxury-input-light w-full pl-10 pr-4 py-2 rounded-xl text-xs text-white placeholder-slate-600 focus:outline-none leading-relaxed">{{ old('catatan') }}</textarea>
                        </div>
                    </div>

                    <div class="bg-slate-950/60 border border-white/10 rounded-xl p-4 flex justify-between items-center shadow-inner">
                        <div>
                            <p class="text-[9px] uppercase tracking-wider text-slate-500 font-bold">Nilai Total Pembayaran</p>
                            <p id="total-display" class="text-xl font-mono font-bold text-emerald-400">Rp 0</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-[#c29b40]/10 border border-[#c29b40]/20 flex items-center justify-center text-[#c29b40]">
                            <i class="fa-solid fa-calculator text-sm"></i>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-widest rounded-xl shadow-xl transition duration-200 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-circle-check text-sm"></i> Konfirmasi & Kirim Pesanan Sekarang
                    </button>
                </form>
            </div>

        </div>
    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[9px] text-slate-600 uppercase tracking-widest font-semibold mt-8">
        &copy; {{ date('Y') }} Nur Baluwarti System &bull; All Rights Reserved
    </footer>

    <script>
        function calculateTotal(value, price) {
            const display = document.getElementById('total-display');
            if (value && value >= 1) {
                const total = value * price;
                display.innerText = 'Rp ' + total.toLocaleString('id-ID');
            } else {
                display.innerText = 'Rp 0';
            }
        }
    </script>
</body>
</html>