<header class="w-full luxury-glass border-b border-white/5 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 z-50 relative">
    <div class="text-center sm:text-left">
        <h1 class="font-serif text-xl font-bold tracking-[0.25em] text-white">NUR BALUWARTI</h1>
        <p class="text-[9px] uppercase tracking-[0.3em] text-[#c29b40] font-semibold mt-0.5">Premium Catering System</p>
    </div>
    
    <nav class="flex flex-wrap justify-center gap-2 bg-black/20 p-1.5 rounded-xl border border-white/5">
        <a href="{{ url('/admin') }}" class="flex items-center gap-2 px-4 py-2 {{ Request::is('admin') ? 'bg-[#c29b40] text-slate-950 font-bold' : 'text-slate-300 hover:text-white hover:bg-white/5 font-semibold' }} rounded-lg text-xs transition">
            <i class="fa-solid fa-chart-pie"></i> Dashboard
        </a>
        <a href="{{ url('/admin/packages') }}" class="flex items-center gap-2 px-4 py-2 {{ Request::is('admin/packages*') ? 'bg-[#c29b40] text-slate-950 font-bold' : 'text-slate-300 hover:text-white hover:bg-white/5 font-semibold' }} rounded-lg text-xs transition">
            <i class="fa-solid fa-utensils"></i> Paket Menu
        </a>
        <a href="{{ url('/admin/schedules') }}" class="flex items-center gap-2 px-4 py-2 {{ Request::is('admin/schedules*') ? 'bg-[#c29b40] text-slate-950 font-bold' : 'text-slate-300 hover:text-white hover:bg-white/5 font-semibold' }} rounded-lg text-xs transition">
            <i class="fa-solid fa-calendar-days"></i> Jadwal
        </a>
        <a href="{{ url('/admin/transactions') }}" class="flex items-center gap-2 px-4 py-2 {{ Request::is('admin/transactions*') ? 'bg-[#c29b40] text-slate-950 font-bold' : 'text-slate-300 hover:text-white hover:bg-white/5 font-semibold' }} rounded-lg text-xs transition">
            <i class="fa-solid fa-file-invoice-dollar {{ Request::is('admin/transactions*') ? 'text-slate-950' : 'text-slate-400' }}"></i> Transaksi
        </a>
        <a href="{{ route('admin.landing.settings') }}" class="flex items-center gap-2 px-4 py-2 {{ Request::is('admin/landing-settings*') ? 'bg-[#c29b40] text-slate-950 font-bold' : 'text-slate-300 hover:text-white hover:bg-white/5 font-semibold' }} rounded-lg text-xs transition">
            <i class="fa-solid fa-window-restore"></i> Landing Page
        </a>
    </nav>

    <div class="relative pl-4 border-l border-white/10">
        <button id="profileDropdownBtn" class="flex items-center gap-3 hover:bg-white/5 p-1.5 rounded-xl transition duration-200 focus:outline-none">
            <div class="text-right hidden md:block">
                <p class="text-xs font-bold text-white">{{ Auth::user()->name ?? 'Admin Catering' }}</p>
                <p class="text-[10px] text-[#c29b40] font-mono">ID: Pengelola <i class="fa-solid fa-chevron-down text-[8px] ml-1"></i></p>
            </div>
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#c29b40] to-[#a8822d] text-slate-950 flex items-center justify-center font-bold text-sm uppercase shadow-md">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
        </button>

        <div id="profileDropdownMenu" class="hidden absolute right-0 mt-3 w-48 rounded-xl bg-[#0f172a] border border-white/10 shadow-2xl overflow-hidden z-50 backdrop-blur-xl bg-opacity-95 animate-fade-in">
            <div class="px-4 py-3 bg-white/[0.02] border-b border-white/5">
                <p class="text-[10px] uppercase font-bold text-slate-500 tracking-wider">Level Akses</p>
                <p class="text-xs font-semibold text-[#c29b40]">Administrator Utama</p>
            </div>
            <div class="p-1.5 space-y-1">
                <a href="{{ url('/admin/settings') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs {{ Request::is('admin/settings*') ? 'bg-white/10 text-[#c29b40] font-medium' : 'text-slate-300 hover:text-white hover:bg-white/5' }} rounded-lg transition">
                    <i class="fa-solid fa-user-gear text-slate-500 w-4"></i> Pengaturan Akun
                </a>
                
                <a href="{{ url('/admin/logs') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs {{ Request::is('admin/logs*') ? 'bg-white/10 text-[#c29b40] font-medium' : 'text-slate-300 hover:text-white hover:bg-white/5' }} rounded-lg transition">
                    <i class="fa-solid fa-shield-halved text-slate-500 w-4"></i> Log Aktivitas
                </a>
                
                <hr class="border-white/5 my-1">
                
                <form method="POST" action="{{ url('/logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs text-red-400 hover:text-white hover:bg-red-500/20 rounded-lg transition text-left font-medium">
                        <i class="fa-solid fa-power-off w-4 text-center"></i> Keluar Sistem
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('profileDropdownBtn');
        const menu = document.getElementById('profileDropdownMenu');

        btn.addEventListener('click', function (event) {
            event.stopPropagation();
            menu.classList.toggle('hidden');
        });

        // Deteksi klik di luar untuk menutup otomatis dropdown profil
        document.addEventListener('click', function (event) {
            if (!btn.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>