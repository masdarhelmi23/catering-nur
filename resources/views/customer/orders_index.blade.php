<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-luxury-dark { background: radial-gradient(circle at top left, #1e1b4b 0%, #0f172a 65%, #020617 100%); }
        .luxury-glass { background: rgba(30, 41, 59, 0.70); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col justify-between">

    @include('customer.layouts.navbar')

    <main class="max-w-4xl w-full mx-auto p-4 md:p-6 flex-grow space-y-6">
        
        <div class="flex items-center gap-3 border-b border-white/10 pb-4">
            <div class="w-10 h-10 bg-[#c29b40]/10 border border-[#c29b40]/20 text-[#c29b40] rounded-xl flex items-center justify-center text-lg">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
                <h1 class="font-serif text-2xl font-bold tracking-wide text-white">Riwayat Pesanan Anda</h1>
                <p class="text-xs text-slate-400">Pantau status pembayaran dan pengiriman katering Nur Baluwarti</p>
            </div>
        </div>

        @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        <div class="space-y-4">
            @forelse ($orders as $order)
                <div class="luxury-glass rounded-2xl p-5 shadow-xl transition duration-300 hover:border-white/20 space-y-4">
                    
                    <div class="flex flex-wrap justify-between items-center gap-2 border-b border-white/5 pb-3">
                        <div class="space-y-0.5">
                            <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Kode Transaksi</span>
                            <p class="font-mono text-sm font-bold text-[#c29b40]">{{ $order->order_code }}</p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            @if(($order->delivery_status ?? $order->status_dapur) == 'Antrean Dapur')
                                <span class="px-2.5 py-1 bg-purple-500/10 border border-purple-500/20 text-purple-400 text-[10px] font-bold uppercase tracking-wide rounded-lg">Antrean Dapur</span>
                            @elseif(($order->delivery_status ?? $order->status_dapur) == 'Proses Masak')
                                <span class="px-2.5 py-1 bg-amber-500/10 border border-amber-500/20 text-amber-400 text-[10px] font-bold uppercase tracking-wide rounded-lg">Proses Masak</span>
                            @elseif(($order->delivery_status ?? $order->status_dapur) == 'Siap Kirim')
                                <span class="px-2.5 py-1 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-bold uppercase tracking-wide rounded-lg animate-pulse">Siap Kirim</span>
                            @elseif(($order->delivery_status ?? $order->status_dapur) == 'Selesai')
                                <span class="px-2.5 py-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold uppercase tracking-wide rounded-lg">Selesai Terantar</span>
                            @endif

                            @if($order->status === 'Sukses' || $order->status === 'Disetujui' || $order->status === 'Lunas')
                                <span class="px-3 py-1 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold uppercase tracking-wider rounded-full flex items-center gap-1.5 shadow-sm">
                                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span> Lunas
                                </span>
                            @else
                                <span class="px-3 py-1 bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold uppercase tracking-wider rounded-full flex items-center gap-1.5 shadow-sm">
                                    <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span> Belum Lunas
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                        <div>
                            <span class="text-slate-500 block mb-0.5">Paket Hidangan</span>
                            <span class="font-semibold text-white text-sm">{{ $order->package_name }}</span>
                        </div>
                        <div>
                            <span class="text-slate-500 block mb-0.5">Jumlah Porsi</span>
                            <span class="text-slate-200 font-medium">{{ $order->jumlah_porsi }} Pax</span>
                        </div>
                        <div>
                            <span class="text-slate-500 block mb-0.5">Tanggal Acara</span>
                            <span class="text-slate-200 font-medium">{{ date('d M Y', strtotime($order->tanggal_acara)) }}</span>
                        </div>
                        <div>
                            <span class="text-slate-500 block mb-0.5">Jam Pengiriman</span>
                            <span class="text-slate-200 font-medium"><i class="fa-regular fa-clock text-[#c29b40] mr-1"></i>{{ $order->delivery_time }} WIB</span>
                        </div>
                    </div>

                    @if($order->catatan)
                    <div class="bg-black/20 rounded-xl p-3 border border-white/5 text-xs text-slate-400">
                        <span class="font-semibold text-slate-300 block mb-1"><i class="fa-solid fa-comment-dots mr-1 text-slate-500"></i>Catatan Khusus:</span>
                        {{ $order->catatan }}
                    </div>
                    @endif

                    <div class="flex flex-wrap justify-between items-center gap-3 pt-3 border-t border-white/5">
                        <div>
                            @if($order->status === 'Sukses' || $order->status === 'Disetujui' || $order->status === 'Lunas')
                                <span class="text-slate-500 text-[11px] block">Total Telah Dibayar</span>
                                <span class="font-mono font-bold text-emerald-400 text-base">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</span>
                            @else
                                <span class="text-amber-400/80 font-medium text-[11px] block"><i class="fa-solid fa-circle-exclamation mr-1 text-amber-400 animate-bounce"></i>Total Belum Dibayar</span>
                                <span class="font-mono font-bold text-amber-400 text-base">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        
                        <div>
                            @if($order->status !== 'Sukses' && $order->status !== 'Disetujui' && $order->status !== 'Lunas')
                                <a href="{{ route('pesanan.payment', $order->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg transition duration-200">
                                    <i class="fa-solid fa-wallet"></i> Bayar Sekarang
                                </a>
                            @else
                                <button disabled class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 text-slate-500 text-xs font-semibold uppercase tracking-wider rounded-xl border border-white/5 cursor-not-allowed">
                                    <i class="fa-solid fa-circle-check"></i> Selesai
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            @empty
                <div class="luxury-glass rounded-2xl p-12 text-center space-y-3">
                    <div class="w-16 h-16 bg-white/5 text-slate-600 rounded-full flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-400">Belum ada riwayat pesanan</p>
                        <p class="text-xs text-slate-600">Silakan lakukan pemesanan menu hidangan terbaik kami terlebih dahulu.</p>
                    </div>
                    <a href="{{ url('/') }}" class="inline-block mt-2 px-4 py-2 bg-white/5 border border-white/10 hover:bg-white/10 text-xs text-white rounded-xl transition font-medium">
                        View Menu Paket
                    </a>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[9px] text-slate-600 uppercase tracking-widest font-semibold">
        &copy; {{ date('Y') }} Nur Baluwarti System &bull; All Rights Reserved
    </footer>

</body>
</html>