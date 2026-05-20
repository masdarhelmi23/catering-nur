<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Catering Nur Baluwarti</title>
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
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/[0.02] p-6 rounded-2xl border border-white/5 shadow-lg">
            <div>
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">
                    Selamat Datang, {{ Auth::user()->name ?? 'Pengelola Catering' }}!
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">Sistem memuat data riil ringkasan operasional dan finansial dapur hari ini.</p>
            </div>
            <div class="px-4 py-2 bg-black/30 border border-white/10 rounded-xl text-xs font-mono text-[#c29b40]">
                <i class="fa-solid fa-clock mr-1"></i> Sesi Akses: Administrator Utama
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <div class="luxury-glass p-5 rounded-2xl relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300">
                <div class="flex justify-between items-start">
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Invoice / Pesanan</p>
                        <h3 class="text-2xl font-bold text-white font-mono">
                            {{ \DB::table('orders')->where('status', '!=', 'Sistem')->count() }}
                        </h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-4"><i class="fa-solid fa-sync fa-spin mr-1 text-blue-400"></i> Sinkron database terupdate</p>
            </div>

            <div class="luxury-glass p-5 rounded-2xl relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300">
                <div class="flex justify-between items-start">
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Varian Paket Hidangan</p>
                        <h3 class="text-2xl font-bold text-white font-mono">
                            {{ \DB::table('food_packages')->count() }}
                        </h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 text-[#c29b40] flex items-center justify-center text-sm">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-4"><i class="fa-solid fa-check-circle mr-1 text-amber-400"></i> Aktif di katalog customer</p>
            </div>

            <div class="luxury-glass p-5 rounded-2xl relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300">
                <div class="flex justify-between items-start">
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Agenda Siap Kirim</p>
                        <h3 class="text-2xl font-bold text-blue-400 font-mono">
                            {{ \DB::table('delivery_schedules')->where('status', 'Siap Kirim')->count() }}
                        </h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-truck-ramp-box"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-4"><i class="fa-solid fa-truck mr-1 text-blue-400 animate-pulse"></i> Paket matang siap disajikan</p>
            </div>

            <div class="luxury-glass p-5 rounded-2xl relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300">
                <div class="flex justify-between items-start">
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Invoice Lunas</p>
                        <h3 class="text-2xl font-bold text-emerald-400 font-mono">
                            {{ \DB::table('orders')->whereIn('status', ['Sukses', 'Lunas', 'Dalam Pengiriman'])->count() }}
                        </h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-vault"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-4.5"><i class="fa-solid fa-shield-halved mr-1 text-purple-400"></i> Total transaksi berstatus lunas</p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 luxury-glass rounded-2xl p-6 space-y-4">
                <div class="flex justify-between items-center border-b border-white/5 pb-2">
                    <h3 class="font-serif text-base font-bold text-white tracking-wide">
                        <i class="fa-solid fa-truck-ramp-box text-emerald-400 mr-2"></i> Jadwal Distribusi Pengiriman Terdekat
                    </h3>
                    <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[9px] uppercase font-mono tracking-wider rounded">Live Log</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-black/20 text-slate-400 text-[10px] uppercase tracking-wider border-b border-white/5">
                                <th class="py-3 px-4">Nama Pelanggan</th>
                                <th class="py-3 px-4">Paket Hidangan</th>
                                <th class="py-3 px-4 text-center">Jam Kirim</th>
                                <th class="py-3 px-4 text-center">Status Lini Dapur</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-white/5 text-slate-300">
                            @php
                                $liveSchedules = \DB::table('orders')
                                    ->leftJoin('delivery_schedules', 'orders.id', '=', 'delivery_schedules.order_id')
                                    ->where('orders.status', '!=', 'Sistem')
                                    ->orderBy('orders.created_at', 'desc')
                                    ->select('orders.*', 'delivery_schedules.status as status_dapur')
                                    ->take(4)
                                    ->get();
                            @endphp

                            @forelse($liveSchedules as $schedule)
                                <tr class="hover:bg-white/[0.01] transition">
                                    <td class="py-3.5 px-4 font-semibold text-white">
                                        {{ $schedule->nama_pemesan ?? $schedule->customer_name }}
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-400">{{ $schedule->package_name }}</td>
                                    <td class="py-3.5 px-4 text-center font-mono text-[#c29b40]">{{ $schedule->delivery_time }}</td>
                                    <td class="py-3.5 px-4 text-center">
                                        @if($schedule->status_dapur == 'Antrean Dapur')
                                            <span class="px-2 py-0.5 bg-purple-500/10 text-purple-400 border border-purple-500/20 text-[9px] font-bold rounded uppercase">Antrean</span>
                                        @elseif($schedule->status_dapur == 'Proses Masak')
                                            <span class="px-2 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[9px] font-bold rounded uppercase">Masak</span>
                                        @elseif($schedule->status_dapur == 'Siap Kirim')
                                            <span class="px-2 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-[9px] font-bold rounded uppercase animate-pulse">Siap Kirim</span>
                                        @elseif($schedule->status_dapur == 'Selesai')
                                            <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[9px] font-bold rounded uppercase">Selesai</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-slate-500/10 text-slate-400 border border-white/10 text-[9px] font-bold rounded uppercase">Belum Diplot</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-xs text-slate-500 italic">
                                        Belum ada antrean jadwal pengiriman katering saat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="luxury-glass rounded-2xl p-6 space-y-4">
                <h3 class="font-serif text-base font-bold text-white tracking-wide border-b border-white/5 pb-2">
                    <i class="fa-solid fa-wallet text-[#c29b40] mr-2"></i> Keuangan Hari Ini
                </h3>
                
                @php
                    $lunasOrders = \DB::table('orders')->whereIn('status', ['Sukses', 'Lunas', 'Dalam Pengiriman'])->get();
                    $totalOmzet = 0;
                    foreach($lunasOrders as $ord) {
                        $totalOmzet += $ord->total_bayar ?? 0;
                    }

                    $pendingOrders = \DB::table('orders')->where('status', 'Pending')->get();
                    $totalPending = 0;
                    foreach($pendingOrders as $pnd) {
                        $totalPending += $pnd->total_bayar ?? 0;
                    }
                @endphp

                <div class="space-y-4">
                    <div class="bg-emerald-500/5 p-4 rounded-xl border border-emerald-500/20 space-y-1">
                        <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider block">Dana Masuk (Lunas)</span>
                        <div class="text-xl font-mono font-bold text-white">
                            Rp {{ number_format($totalOmzet, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="bg-amber-500/5 p-4 rounded-xl border border-amber-500/20 space-y-1">
                        <span class="text-[10px] text-amber-400 font-bold uppercase tracking-wider block">Dana Tertahan (Pending / COD)</span>
                        <div class="text-sm font-mono font-bold text-slate-300">
                            Rp {{ number_format($totalPending, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="p-3 bg-black/30 border border-white/5 rounded-xl flex items-center justify-between text-[10px] text-slate-400 font-mono">
                        <span>Status Finansial:</span>
                        <span class="text-emerald-400 font-bold uppercase"><i class="fa-solid fa-shield-check"></i> Balanced</span>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

</body>
</html>