<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi - Catering Nur Baluwarti</title>
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
        
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(67%) sepia(43%) saturate(565%) hue-rotate(354deg) brightness(91%) contrast(87%);
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('admin.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 max-w-[850px] w-full mx-auto space-y-6">
        
        <div class="flex items-center justify-between border-b border-white/5 pb-4">
            <div class="space-y-0.5">
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Edit Data Transaksi</h2>
                <p class="text-xs text-slate-400">Ubah rincian informasi pemesanan katering manual pelanggan.</p>
            </div>
            <a href="{{ url('/admin/transactions') }}" class="px-3 py-2 bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-semibold rounded-xl border border-white/10 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="luxury-glass rounded-2xl p-6 md:p-8 border border-white/5 shadow-2xl">
            <form method="POST" action="{{ url('/admin/transactions/'.$transaction->id) }}">
                @csrf
                @method('PUT')

                <div class="space-y-2 mb-6">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Kode Invoice / Order</label>
                    <input type="text" name="order_code" value="{{ $transaction->order_code }}" readonly
                           class="luxury-input w-full px-4 py-2.5 bg-black/50 border border-white/10 rounded-xl text-sm text-[#c29b40] font-mono focus:outline-none cursor-not-allowed">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label for="nama_pemesan" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Nama Lengkap Pelanggan</label>
                        <input id="nama_pemesan" type="text" name="nama_pemesan" value="{{ old('nama_pemesan', $transaction->nama_pemesan ?? $transaction->customer_name) }}" required
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label for="nomor_wa" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Nomor WhatsApp Aktif</label>
                        <input id="nomor_wa" type="tel" name="nomor_wa" value="{{ old('nomor_wa', $transaction->nomor_wa) }}" required
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label for="package_name" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Pilih Paket Menu</label>
                        <select id="package_name" name="package_name" required onchange="hitungTotalManual()" class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                            @foreach(($packages ?? []) as $pkg)
                                <option value="{{ $pkg->package_name }}" data-price="{{ $pkg->price }}" {{ $transaction->package_name == $pkg->package_name ? 'selected' : '' }} class="bg-slate-950 text-slate-200">
                                    {{ $pkg->package_name }} - Rp {{ number_format($pkg->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="jumlah_porsi" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Volume Jumlah Porsi (Pax)</label>
                        <input id="jumlah_porsi" type="number" name="jumlah_porsi" min="1" value="{{ old('jumlah_porsi', $transaction->jumlah_porsi) }}" required oninput="hitungTotalManual()"
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm font-mono text-white focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label for="tanggal_acara" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Tanggal Acara Pelaksanaan</label>
                        <input id="tanggal_acara" type="date" name="tanggal_acara" value="{{ old('tanggal_acara', date('Y-m-d', strtotime($transaction->tanggal_acara))) }}" required
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label for="delivery_time" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Waktu Pengiriman</label>
                        <input id="delivery_time" type="time" name="delivery_time" value="{{ old('delivery_time', date('H:i', strtotime($transaction->delivery_time))) }}" required
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm font-mono text-white focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2 mb-6">
                    <label for="tempat_antar" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Tempat / Alamat Lengkap Lokasi Pengantaran</label>
                    <input id="tempat_antar" type="text" name="tempat_antar" value="{{ old('tempat_antar', $transaction->tempat_antar) }}" required
                           class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label for="status" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Status Invoice Transaksi</label>
                        <select id="status" name="status" class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                            <option value="Sukses" {{ $transaction->status == 'Sukses' ? 'selected' : '' }} class="bg-slate-950">Sukses / Settlement (Lunas)</option>
                            <option value="Pending" {{ $transaction->status == 'Pending' ? 'selected' : '' }} class="bg-slate-950">Pending / Menunggu Pembayaran COD</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Kalkulasi Total Bayar Nominal</label>
                        <div class="w-full px-4 py-2.5 bg-emerald-500/5 border border-emerald-500/20 rounded-xl text-sm font-mono font-bold text-emerald-400 flex items-center h-[45px]">
                            <span id="total_bayar_display">Rp {{ number_format($transaction->total_bayar, 0, ',', '.') }}</span>
                        </div>
                        <input type="hidden" name="total_bayar" id="total_bayar_hidden" value="{{ $transaction->total_bayar }}">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-white/5">
                    <button type="submit" class="px-6 py-3 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-widest rounded-xl shadow-lg transition duration-200">
                        <i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Nota Transaksi
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

    <script type="text/javascript">
        function hitungTotalManual() {
            var selectMenu = document.getElementById("package_name");
            var inputPorsi = document.getElementById("jumlah_porsi");
            
            var hargaPerPorsi = 0;
            if (selectMenu.selectedIndex >= 0) {
                hargaPerPorsi = parseFloat(selectMenu.options[selectMenu.selectedIndex].getAttribute("data-price")) || 0;
            }
            
            var volumePorsi = parseInt(inputPorsi.value) || 0;
            var totalBayar = hargaPerPorsi * volumePorsi;
            
            document.getElementById("total_bayar_hidden").value = totalBayar;
            document.getElementById("total_bayar_display").innerText = "Rp " + totalBayar.toLocaleString('id-ID');
        }
        window.onload = hitungTotalManual;
    </script>
</body>
</html>