<header class="w-full luxury-glass border-b border-white/5 sticky top-0 z-50">
    <div class="max-w-[1600px] mx-auto px-6 py-4 flex flex-col lg:flex-row items-center justify-between gap-4">
        
        <a href="{{ url('/') }}" class="text-center lg:text-left shrink-0 block group hover:opacity-90 transition duration-200">
            <h1 class="font-serif text-xl font-bold tracking-[0.2em] text-white group-hover:text-[#c29b40] transition duration-200">NUR BALUWARTI</h1>
            <p class="text-[9px] uppercase tracking-[0.25em] text-[#c29b40] font-semibold mt-0.5">Premium Catering System</p>
        </a>

        @if(request()->is('pesanan'))
            <div class="w-full max-w-xl mx-0 lg:mx-8 hidden lg:block invisible"></div>
        @else
            <div class="w-full max-w-xl relative mx-0 lg:mx-8">
                <input type="text" placeholder="Cari menu katering favoritmu..." 
                       class="luxury-input w-full pl-4 pr-12 py-2.5 bg-black/30 border border-white/10 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none transition">
                <button class="absolute right-3 top-2.5 text-slate-400 hover:text-[#c29b40] transition">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </button>
            </div>
        @endif

        <div class="flex items-center gap-4 shrink-0">
            
            <a href="{{ url('/') }}" class="relative p-2 text-slate-300 hover:text-white transition flex items-center gap-2 group" title="Kembali ke Beranda">
                <i class="fa-solid fa-house text-base text-[#c29b40] group-hover:scale-110 transition duration-200"></i>
                <span class="text-xs font-medium hidden sm:inline">Beranda</span>
            </a>

            <div class="h-4 w-px bg-white/10 hidden sm:block"></div>

            <a href="{{ url('/pesanan') }}" class="relative p-2 text-slate-300 hover:text-white transition flex items-center gap-2 group" title="Pesanan Saya">
                <i class="fa-solid fa-receipt text-base text-[#c29b40] group-hover:scale-110 transition duration-200"></i>
                <span class="text-xs font-medium hidden sm:inline">Pesanan Saya</span>
            </a>
            
            <div class="h-4 w-px bg-white/10 hidden sm:block"></div>
            
            @if(Auth::check())
                @if(in_array(Auth::user()->role, ['admin', 'owner']))
                    <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 border border-amber-500/30 text-xs font-semibold rounded-xl transition flex items-center gap-1.5 shadow-lg shadow-amber-950/10">
                        <i class="fa-solid fa-chart-line text-xs"></i> Panel Admin
                    </a>
                    <div class="hidden sm:block h-6 w-px bg-white/10"></div>
                @endif

                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-[10px] text-slate-500 uppercase tracking-wider font-bold">Selamat Datang</span>
                    <span class="text-xs text-slate-200 font-medium mt-0.5">{{ Auth::user()->name }}</span>
                </div>

                <div class="hidden sm:block h-6 w-px bg-white/10"></div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 hover:text-white rounded-xl text-xs font-bold uppercase tracking-wider border border-red-500/20 transition duration-200 flex items-center gap-2 shadow-lg shadow-red-950/10">
                        <i class="fa-solid fa-power-off text-[11px]"></i> Keluar
                    </button>
                </form>
            @else
                <a href="{{ url('/login') }}" class="text-xs font-semibold text-slate-300 hover:text-white transition flex items-center gap-1.5">
                    <i class="fa-solid fa-right-to-bracket text-xs text-[#c29b40]"></i> Masuk
                </a>
                <a href="{{ url('/register') }}" class="px-3.5 py-2 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold rounded-xl shadow-md transition">
                    Daftar
                </a>
            @endif
        </div>
    </div>
</header>