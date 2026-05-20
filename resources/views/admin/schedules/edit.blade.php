<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Produksi - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .luxury-input { transition: all 0.2s ease-in-out; }
        .luxury-input:focus { border-color: #c29b40; background-color: rgba(15, 23, 42, 0.8); box-shadow: 0 0 0 3px rgba(194, 155, 64, 0.15); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('admin.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 max-w-[850px] w-full mx-auto space-y-6">
        
        <div class="flex items-center justify-between border-b border-white/5 pb-4">
            <div class="space-y-0.5">
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Update Status & Kendali Dapur</h2>
                <p class="text-xs text-slate-400">Kelola progress kematangan menu hidangan untuk invoice {{ $order->order_code ?? '#CODE' }}.</p>
            </div>
            <a href="{{ url('/admin/schedules') }}" class="px-3 py-2 bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-semibold rounded-xl border border-white/10 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="luxury-glass rounded-2xl p-6 md:p-8 border border-white/5 shadow-2xl">
            <form method="POST" action="{{ url('/admin/schedules/'.$schedule->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-6 p-4 bg-white/[0.02] border border-white/5 rounded-xl grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <p class="text-slate-500 font-bold uppercase tracking-wider text-[9px]">Nama Pemesan</p>
                        <p class="text-white font-semibold text-sm mt-0.5">{{ $order->nama_pemesan ?? $order->customer_name ?? 'Pelanggan Anonim' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500 font-bold uppercase tracking-wider text-[9px]">Paket & Jumlah Porsi</p>
                        <p class="text-amber-400 font-medium text-sm mt-0.5">{{ $order->package_name ?? '-' }} ({{ $order->jumlah_porsi ?? 0 }} Pax)</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label for="delivery_date" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Tanggal Pengiriman</label>
                        <input id="delivery_date" type="date" name="delivery_date" value="{{ old('delivery_date', $schedule->delivery_date) }}" required
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label for="delivery_time" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Jam Pengiriman (WIB)</label>
                        <input id="delivery_time" type="text" name="delivery_time" value="{{ old('delivery_time', $schedule->delivery_time) }}" required
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2 mb-6">
                    <label for="status" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Status Alur Kesiapan Dapur</label>
                    <select id="status" name="status" class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                        <option value="Antrean Dapur" {{ $schedule->status == 'Antrean Dapur' ? 'selected' : '' }} class="bg-slate-950">Antrean Dapur</option>
                        <option value="Proses Masak" {{ $schedule->status == 'Proses Masak' ? 'selected' : '' }} class="bg-slate-950">Proses Masak</option>
                        <option value="Siap Kirim" {{ $schedule->status == 'Siap Kirim' ? 'selected' : '' }} class="bg-slate-950">Siap Kirim / Siap Sajikan</option>
                        <option value="Selesai" {{ $schedule->status == 'Selesai' ? 'selected' : '' }} class="bg-slate-950">Selesai Terantar / Selesai Acara</option>
                    </select>
                </div>

                <div class="space-y-2 mb-6">
                    <label for="location" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Lokasi / Alamat Destinasi Pengiriman</label>
                    <input id="location" type="text" name="location" value="{{ old('location', $schedule->location) }}" required
                           class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-white/5">
                    <button type="submit" class="px-6 py-3 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-widest rounded-xl shadow-lg transition duration-200">
                        <i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Status Dapur
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>
</body>
</html>