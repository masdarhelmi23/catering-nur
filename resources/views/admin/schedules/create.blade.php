<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plot Jadwal Pengiriman Baru - Catering Nur Baluwarti</title>
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
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Plot Jadwal Pengiriman</h2>
                <p class="text-xs text-slate-400">Hubungkan pesanan aktif dengan lini manajemen produksi dapur.</p>
            </div>
            <a href="{{ url('/admin/schedules') }}" class="px-3 py-2 bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-semibold rounded-xl border border-white/10 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="luxury-glass rounded-2xl p-6 md:p-8 border border-white/5 shadow-2xl">
            
            @if ($errors->any())
                <div class="mb-5 p-3.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-xs font-semibold flex flex-col gap-1">
                    @foreach ($errors->all() as $error)
                        <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ url('/admin/schedules') }}">
                @csrf

                <div class="space-y-2 mb-6">
                    <label for="order_id" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Pilih Pesanan Katering (Order)</label>
                    <select id="order_id" name="order_id" required onchange="autofillOrderData()" class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none accent-slate-900">
                        <option value="" disabled selected class="bg-slate-950 text-slate-500">-- Pilih Pesanan Terdaftar --</option>
                        @foreach(($orders ?? []) as $order)
                            {{-- REVISI ALAMAT BERLAPIS: Jika tempat_antar kosong, otomatis cari ke kolom lokasi atau alamat --}}
                            <option value="{{ $order->id }}" 
                                    data-alamat="{{ $order->tempat_antar ?? $order->lokasi ?? $order->alamat ?? '' }}"
                                    data-waktu="{{ $order->delivery_time ?? '' }}"
                                    class="bg-slate-950 text-slate-200">
                                {{ $order->order_code }} - {{ $order->nama_pemesan ?? $order->customer_name }} ({{ $order->package_name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <label for="delivery_date" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Tanggal Pengiriman</label>
                        <input id="delivery_date" type="date" name="delivery_date" value="{{ old('delivery_date', date('Y-m-d')) }}" required
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label interpreters-grup for="delivery_time" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Jam Pengiriman (WIB)</label>
                        <input id="delivery_time" type="text" name="delivery_time" value="{{ old('delivery_time') }}" placeholder="Pilih pesanan untuk isi otomatis..." required
                               class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2 mb-6">
                    <label for="status" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Status Alur Dapur</label>
                    <select id="status" name="status" class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                        <option value="Antrean Dapur" class="bg-slate-950">Antrean Dapur</option>
                        <option value="Proses Masak" class="bg-slate-950">Proses Masak</option>
                        <option value="Siap Kirim" class="bg-slate-950">Siap Kirim</option>
                        <option value="Selesai" class="bg-slate-950">Selesai Terantar</option>
                    </select>
                </div>

                <div class="space-y-2 mb-6">
                    <label for="location" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Lokasi / Alamat Lengkap Destinasi</label>
                    <input id="location" type="text" name="location" value="{{ old('location') }}" placeholder="Pilih pesanan untuk mengisi alamat otomatis..." required
                           class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none">
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-white/5">
                    <button type="submit" class="px-6 py-3 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-widest rounded-xl shadow-lg transition duration-200">
                        <i class="fa-solid fa-calendar-check mr-1"></i> Daftarkan Agenda
                    </button>
                </div>

            </form>
        </div>
    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

    <script type="text/javascript">
        function autofillOrderData() {
            var selectBox = document.getElementById("order_id");
            var selectedOption = selectBox.options[selectBox.selectedIndex];
            
            var alamatRiil = selectedOption.getAttribute("data-alamat");
            var waktuRiil = selectedOption.getAttribute("data-waktu");
            
            if (alamatRiil) {
                document.getElementById("location").value = alamatRiil;
            } else {
                document.getElementById("location").value = "";
            }

            if (waktuRiil) {
                if(!waktuRiil.includes("WIB")) {
                    waktuRiil = waktuRiil + " WIB";
                }
                document.getElementById("delivery_time").value = waktuRiil;
            } else {
                document.getElementById("delivery_time").value = "";
            }
        }
    </script>
</body>
</html>