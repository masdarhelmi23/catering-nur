
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#f4f6f8] text-[#1e293b] antialiased">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-[#1a2232] text-white flex flex-col justify-between p-6 shrink-0 shadow-lg">
            <div>
                <div class="mb-10 text-center md:text-left">
                    <h1 class="font-serif text-lg tracking-[0.15em] font-bold text-white">NUR BALUWARTI</h1>
                    <span class="text-[9px] uppercase tracking-[0.2em] text-[#c29b40] block mt-1">Panel Pengelola</span>
                </div>

                <nav class="space-y-2">
                    <a href="{{ url('/admin') }}" class="flex items-center gap-3 px-4 py-3 text-xs uppercase tracking-wider font-semibold bg-[#2d3748] text-white rounded-xl transition duration-200">
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-xs uppercase tracking-wider font-semibold text-gray-400 hover:bg-[#2d3748] hover:text-white rounded-xl transition duration-200">
                        Manajemen Menu
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-xs uppercase tracking-wider font-semibold text-gray-400 hover:bg-[#2d3748] hover:text-white rounded-xl transition duration-200">
                        Pesanan Masuk
                    </a>
                </nav>
            </div>

            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-xs uppercase tracking-widest font-bold text-red-400 bg-red-950/30 hover:bg-red-900/40 border border-red-900/50 rounded-xl transition duration-200 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-grow flex flex-col">
            <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-8 shadow-sm">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Sistem Manajemen Katering v1.0
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <div class="text-xs font-bold text-[#1a2232] uppercase">{{ Auth::user()->name ?? 'Pengelola' }}</div>
                        <div class="text-[10px] text-gray-400 uppercase tracking-wider">{{ Auth::user()->role ?? 'Admin' }}</div>
                    </div>
                    <div class="w-8 h-8 bg-amber-500/10 border border-amber-500/20 text-[#d97706] font-bold text-xs flex items-center justify-center rounded-full uppercase">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="flex-grow p-8">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>