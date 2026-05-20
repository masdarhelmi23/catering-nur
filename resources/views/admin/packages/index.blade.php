<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Paket Menu - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('admin.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 space-y-6 max-w-[1600px] w-full mx-auto">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/[0.02] p-6 rounded-2xl border border-white/5">
            <div>
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Katalog Paket Menu</h2>
                <p class="text-xs text-slate-400 mt-0.5">Kelola data hidangan, ketersediaan stok, visual foto, dan status operasional katering.</p>
            </div>
            <a href="{{ url('/admin/packages/create') }}" class="px-4 py-2.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold rounded-xl shadow-lg transition duration-200 flex items-center gap-2">
                <i class="fa-solid fa-square-plus text-sm"></i> Tambah Paket Baru
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-check text-sm"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse(($packages ?? []) as $package)
                <div class="luxury-glass rounded-2xl overflow-hidden border border-white/5 flex flex-col justify-between hover:border-[#c29b40]/30 transition duration-300 group">
                    
                    <div>
                        <div class="w-full h-48 bg-slate-950 relative overflow-hidden border-b border-white/5">
                            @if($package->image)
                                <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->package_name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-600 space-y-2 bg-gradient-to-br from-slate-900 to-black">
                                    <i class="fa-solid fa-utensils text-3xl"></i>
                                    <span class="text-[10px] font-mono tracking-wider uppercase">No Photo Provided</span>
                                </div>
                            @endif

                            @if(($package->stock ?? 0) <= 0)
                                <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px] flex items-center justify-center">
                                    <span class="px-3 py-1 bg-red-500/20 border border-red-500/40 text-red-400 text-[10px] font-bold uppercase tracking-widest rounded-lg">Stok Kosong</span>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4">
                                @if($package->is_available && ($package->stock ?? 0) > 0)
                                    <span class="text-[9px] uppercase tracking-wider font-bold text-emerald-400 bg-slate-950/80 backdrop-blur-md px-2.5 py-1 rounded-md border border-emerald-500/30 shadow-lg">Tersedia</span>
                                @else
                                    <span class="text-[9px] uppercase tracking-wider font-bold text-red-400 bg-slate-950/80 backdrop-blur-md px-2.5 py-1 rounded-md border border-red-500/30 shadow-lg">Non-Aktif</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="font-serif text-lg font-bold text-white tracking-wide group-hover:text-[#c29b40] transition duration-200 truncate">{{ $package->package_name }}</h3>
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded-md shrink-0 border {{ ($package->stock ?? 0) > 0 ? 'bg-amber-500/10 border-amber-500/20 text-[#c29b40]' : 'bg-red-500/10 border-red-500/20 text-red-400 font-bold' }}">
                                    Stok: {{ $package->stock ?? 0 }} Porsi
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed whitespace-pre-line line-clamp-3">{{ $package->description }}</p>
                        </div>
                    </div>

                    <div class="p-5 bg-black/30 border-t border-white/5 flex flex-col space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[9px] uppercase tracking-wider text-slate-500 font-bold">Harga Paket</p>
                                <p class="text-base font-mono font-bold text-emerald-400">Rp {{ number_format($package->price, 0, ',', '.') }}<span class="text-[10px] text-slate-400 font-sans font-normal">/pax</span></p>
                            </div>

                            <form method="POST" action="{{ url('/admin/packages/'.$package->id.'/toggle') }}" class="m-0">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 px-3 py-1.5 rounded-xl border transition text-[11px] font-medium {{ $package->is_available ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400 hover:bg-emerald-500/20' : 'bg-red-500/10 border-red-500/20 text-red-400 hover:bg-red-500/20' }}">
                                    <i class="fa-solid {{ $package->is_available ? 'fa-toggle-on' : 'fa-toggle-off' }} text-sm"></i>
                                    {{ $package->is_available ? 'Aktif' : 'Non-Aktif' }}
                                </button>
                            </form>
                        </div>

                        <div class="flex gap-2 pt-2 border-t border-white/5 justify-end">
                            <a href="{{ url('/admin/packages/'.$package->id.'/edit') }}" title="Edit Spesifikasi Paket" 
                               class="flex-1 py-2 bg-blue-500/10 border border-blue-500/20 hover:bg-blue-500 text-blue-400 hover:text-white rounded-xl text-xs font-semibold text-center transition duration-150 flex items-center justify-center gap-1.5">
                                <i class="fa-solid fa-pen-to-square"></i> Edit Data
                            </a>
                            
                            <form action="{{ url('/admin/packages/'.$package->id) }}" method="POST" class="m-0 flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus Paket" 
                                        class="w-full py-2 bg-red-500/10 border border-red-500/20 hover:bg-red-500 text-red-400 hover:text-white rounded-xl text-xs font-semibold transition duration-150 flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 luxury-glass rounded-2xl p-12 text-center text-sm text-slate-500 italic border border-dashed border-white/10">
                    <i class="fa-solid fa-utensils block text-3xl mb-3 text-slate-600"></i>
                    Belum ada katalog paket menu katering asli yang diinput ke dalam database.
                </div>
            @endforelse
        </div>

    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

</body>
</html>