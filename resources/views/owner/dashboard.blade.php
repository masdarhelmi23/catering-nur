<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - Catering Nur Baluwarti</title>
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

    @include('owner.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 space-y-6 max-w-[1600px] w-full mx-auto">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/[0.02] p-6 rounded-2xl border border-white/5 shadow-lg">
            <div>
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">
                    Selamat Datang, {{ Auth::user()->name ?? 'Pimpinan Catering' }}!
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">Sistem memuat rekap akuntansi, finansial omzet, dan audit data staf secara otomatis.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <form action="{{ url('/owner/dashboard') }}" method="GET" class="m-0 flex items-center bg-black/30 border border-white/10 rounded-xl overflow-hidden text-xs">
                    <button type="submit" name="filter" value="all" class="px-4 py-2 font-semibold {{ $filter === 'all' ? 'bg-[#c29b40] text-slate-950' : 'text-slate-400 hover:text-white' }}">Semua</button>
                    <button type="submit" name="filter" value="week" class="px-4 py-2 font-semibold border-l border-r border-white/5 {{ $filter === 'week' ? 'bg-[#c29b40] text-slate-950' : 'text-slate-400 hover:text-white' }}">Per Minggu</button>
                    <button type="submit" name="filter" value="month" class="px-4 py-2 font-semibold {{ $filter === 'month' ? 'bg-[#c29b40] text-slate-950' : 'text-slate-400 hover:text-white' }}">Per Bulan</button>
                </form>

                <a href="{{ url('/owner/report/download?filter='.$filter) }}" target="_blank" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition flex items-center gap-1.5 w-full sm:w-auto justify-center">
                    <i class="fa-solid fa-file-arrow-download"></i> Unduh Laporan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="luxury-glass p-5 rounded-2xl relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300 shadow-xl">
                <div class="flex justify-between items-start">
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Uang Masuk (Lunas)</p>
                        <h3 class="text-2xl font-bold text-emerald-400 font-mono">Rp {{ number_format($omzetLunas, 0, ',', '.') }}</h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-4"><i class="fa-solid fa-circle-check text-emerald-400 mr-1"></i> Sinkron laba bersih masuk kas</p>
            </div>

            <div class="luxury-glass p-5 rounded-2xl relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300 shadow-xl">
                <div class="flex justify-between items-start">
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Sisa Piutang (Belum Lunas / COD)</p>
                        <h3 class="text-2xl font-bold text-amber-400 font-mono">Rp {{ number_format($piutangCod, 0, ',', '.') }}</h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-4"><i class="fa-solid fa-circle-exclamation text-amber-400 mr-1"></i> Total dana COD tertahan lapangan</p>
            </div>

            <div class="luxury-glass p-5 rounded-2xl relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300 shadow-xl">
                <div class="flex justify-between items-start">
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Volume Produksi Hidangan</p>
                        <h3 class="text-2xl font-bold text-blue-400 font-mono">{{ $totalPorsiTerjual }} Pax</h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-4"><i class="fa-solid fa-chart-bar text-blue-400 mr-1"></i> Akumulasi porsi terjual</p>
            </div>
        </div>

        <div class="luxury-glass rounded-2xl overflow-hidden shadow-2xl">
            <div class="p-5 border-b border-white/5 bg-white/[0.01] flex justify-between items-center">
                <h3 class="font-serif text-base font-bold text-white tracking-wide">Buku Jurnal Umum Penjualan</h3>
                <span class="px-2.5 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[9px] uppercase font-mono tracking-widest rounded-md">Audit Owner</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-slate-400 text-[10px] uppercase tracking-wider border-b border-white/5">
                            <th class="py-3.5 px-5">Tanggal Masuk</th>
                            <th class="py-3.5 px-5">Kode Invoice</th>
                            <th class="py-3.5 px-5">Nama Pelanggan</th>
                            <th class="py-3.5 px-5">Varian Paket</th>
                            <th class="py-3.5 px-5">Kuantitas</th>
                            <th class="py-3.5 px-5">Total Nominal</th>
                            <th class="py-3.5 px-5 text-center">Status Pembukuan</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-white/5 text-slate-300">
                        @forelse($orders as $order)
                            <tr class="hover:bg-white/[0.01] transition duration-150">
                                <td class="py-4 px-5 font-mono text-slate-400">{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</td>
                                <td class="py-4 px-5 font-mono font-bold text-[#c29b40]">{{ $order->order_code }}</td>
                                <td class="py-4 px-5 font-semibold text-white">{{ $order->nama_pemesan ?? $order->customer_name }}</td>
                                <td class="py-4 px-5 text-slate-400">{{ $order->package_name }}</td>
                                <td class="py-4 px-5 font-mono">{{ $order->jumlah_porsi }} Pax</td>
                                <td class="py-4 px-5 font-mono font-bold text-slate-200">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                                <td class="py-4 px-5 text-center">
                                    @if(in_array($order->status, ['Sukses', 'Lunas', 'Dalam Pengiriman']))
                                        <span class="px-2.5 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[9px] font-bold rounded-lg uppercase tracking-wide inline-block">Kredit Kas</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[9px] font-bold rounded-lg uppercase tracking-wide inline-block">Piutang Dagang</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-xs text-slate-500 italic border border-dashed border-white/10">
                                    <i class="fa-solid fa-receipt block text-2xl mb-2 text-slate-600"></i>
                                    Belum ada aktivitas sirkulasi finansial terdaftar pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti Owner Audit System &bull; All Rights Reserved
    </footer>

</body>
</html>