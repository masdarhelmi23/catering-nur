<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .terminal-log { background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(30, 41, 59, 0.4) 100%); border: 1px solid rgba(129, 140, 248, 0.1); }
        .terminal-log:hover { border-color: rgba(194, 155, 64, 0.3); background: rgba(15, 23, 42, 0.9); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('owner.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 space-y-6 max-w-[1600px] w-full mx-auto">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/[0.02] p-6 rounded-2xl border border-white/5 shadow-lg">
            <div>
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Sistem Log Keamanan & Audit Pelacakan</h2>
                <p class="text-xs text-slate-400 mt-0.5">Catatan jejak aktivitas enkripsi internal yang di-generate otomatis oleh core engine katering.</p>
            </div>
            <div class="px-4 py-2 bg-red-500/10 border border-red-500/20 rounded-xl text-xs font-mono text-red-400 flex items-center gap-1.5 shadow-inner">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span> SECURE GATEWAY ACTIVE
            </div>
        </div>

        <div class="luxury-glass rounded-2xl p-6 space-y-4 shadow-2xl">
            <div class="flex justify-between items-center border-b border-white/5 pb-3">
                <h3 class="font-serif text-base font-bold text-white tracking-wide flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-[#c29b40]"></i> Live System Audit Trail
                </h3>
                <span class="px-2.5 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-[9px] uppercase font-mono tracking-widest rounded-md">Kernel Level</span>
            </div>

            <div class="space-y-3">
                @forelse($logs as $log)
                    <div class="terminal-log p-4 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-3 transition duration-200 shadow-md">
                        <div class="flex items-start gap-3.5">
                            <span class="w-9 h-9 shrink-0 flex items-center justify-center bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 rounded-xl text-xs">
                                <i class="fa-solid fa-terminal animate-pulse"></i>
                            </span>
                            <div class="space-y-0.5">
                                <p class="text-xs md:text-sm font-mono font-bold text-slate-200 leading-tight">
                                    {{ $log->activity }}
                                </p>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[10px] text-slate-500 font-mono">
                                    <span class="text-amber-400/90 font-bold">
                                        <i class="fa-solid fa-user-shield mr-1"></i>Aktor: {{ $log->user_name ?? 'System Engine' }}
                                    </span>
                                    <span><i class="fa-solid fa-server mr-1"></i>IP Node: {{ $log->ip_address ?? '127.0.0.1' }}</span>
                                    <span class="text-indigo-400/80"><i class="fa-solid fa-microchip mr-1"></i>Event: Audit Record</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-left sm:text-right shrink-0 pl-12 sm:pl-0 border-l border-white/5 sm:border-l-0 sm:pl-4">
                            <span class="text-[11px] font-mono text-[#c29b40] font-bold bg-[#c29b40]/5 border border-[#c29b40]/10 px-2.5 py-1 rounded-lg">
                                <i class="fa-regular fa-clock mr-1 text-[10px]"></i>{{ date('d M Y - H:i:s', strtotime($log->created_at)) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl p-20 text-center border border-dashed border-white/10 bg-black/10">
                        <div class="w-14 h-14 bg-white/5 text-slate-600 rounded-full flex items-center justify-center mx-auto text-xl mb-3 shadow-inner">
                            <i class="fa-solid fa-shield-slash"></i>
                        </div>
                        <p class="text-sm font-medium text-slate-400 italic">Belum ada rekaman audit log aktivitas sistem hari ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti Owner Audit System &bull; All Rights Reserved
    </footer>

</body>
</html>