<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pengiriman - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .modal-glass { background: rgba(10, 15, 30, 0.85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        
        .select-status {
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none'><path stroke='%2394a3b8' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' d='M1 1l4 4 4-4'/></svg>");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 28px;
        }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('admin.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 space-y-6 max-w-[1600px] w-full mx-auto">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/[0.02] p-6 rounded-2xl border border-white/5">
            <div>
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Agenda Jadwal Pengiriman</h2>
                <p class="text-xs text-slate-400 mt-0.5">Pantau kesiapan lini produksi dapur Nur Baluwarti.</p>
            </div>
            <a href="{{ url('/admin/schedules/create') }}" class="px-4 py-2.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold rounded-xl shadow-lg transition duration-200 flex items-center gap-2">
                <i class="fa-solid fa-calendar-plus text-sm"></i> Plot Jadwal Baru
            </a>
        </div>

        <div class="luxury-glass p-4 rounded-2xl border border-white/5 grid grid-cols-1 md:grid-cols-3 gap-4 items-center shadow-md">
            <div class="relative col-span-1 md:col-span-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 text-xs">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input id="search_input" type="text" oninput="jalankanFilterData()" placeholder="Cari kode invoice atau nama pelanggan katering..." 
                       class="w-full pl-10 pr-4 py-2 bg-black/40 border border-white/10 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#c29b40] transition">
            </div>

            <div class="relative">
                <select id="time_filter" onchange="jalankanFilterData()" 
                        class="select-status w-full px-4 py-2 bg-black/40 border border-white/10 rounded-xl text-xs text-slate-300 font-medium cursor-pointer focus:outline-none focus:border-[#c29b40] transition">
                    <option value="all" selected class="bg-slate-950 text-slate-300">Semua Jadwal Agenda</option>
                    <option value="today" class="bg-slate-950 text-slate-300">Hari Ini (Per Hari)</option>
                    <option value="week" class="bg-slate-950 text-slate-300">Minggu Ini (Per Minggu)</option>
                    <option value="month" class="bg-slate-950 text-slate-300">Bulan Ini (Per Bulan)</option>
                </select>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-sm"></i> {{ session('success') }}
            </div>
        @endif

        <div id="schedule_container" class="space-y-4">
            @forelse(($schedules ?? []) as $schedule)
                <div class="schedule-item luxury-glass p-5 rounded-2xl border border-white/5 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 hover:border-[#c29b40]/20 transition duration-200"
                     data-invoice="{{ strtolower($schedule->order->order_code ?? '') }}"
                     data-name="{{ strtolower($schedule->order->nama_pemesan ?? $schedule->order->customer_name ?? '') }}"
                     data-date="{{ $schedule->delivery_date }}">
                    
                    <div class="flex items-center gap-4 shrink-0">
                        <div class="px-4 py-2.5 bg-[#c29b40]/10 border border-[#c29b40]/20 text-center rounded-xl min-w-[90px]">
                            <p class="text-[10px] font-bold text-[#c29b40] uppercase tracking-wider">Tanggal</p>
                            <p class="text-xs font-mono font-bold text-white mt-0.5">{{ \Carbon\Carbon::parse($schedule->delivery_date)->format('d M Y') }}</p>
                        </div>
                        <div class="space-y-0.5">
                            <span class="text-[10px] font-mono text-[#c29b40] font-bold">{{ $schedule->order->order_code ?? '#CODE-ERR' }}</span>
                            <h3 class="text-sm font-bold text-white flex items-center gap-1.5">
                                <i class="fa-solid fa-clock text-slate-500 text-xs"></i> {{ \Carbon\Carbon::parse($schedule->delivery_time)->format('H:i') }} WIB
                            </h3>
                        </div>
                    </div>

                    <div class="flex-grow grid grid-cols-1 sm:grid-cols-3 gap-4 border-l border-r border-white/5 px-0 md:px-6">
                        <div class="space-y-1">
                            <p class="text-[9px] uppercase tracking-wider text-slate-500 font-bold">Pemesan & Paket</p>
                            <p class="text-xs font-bold text-white">{{ $schedule->order->nama_pemesan ?? $schedule->order->customer_name ?? 'Pelanggan Anonim' }}</p>
                            <p class="text-[11px] text-slate-400 truncate">{{ $schedule->order->package_name ?? 'Custom Menu Package' }}</p>
                            <p class="text-[10px] font-mono text-slate-500">Porsi: {{ $schedule->order->jumlah_porsi ?? 0 }} PCS</p>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-[9px] uppercase tracking-wider text-slate-500 font-bold">Destinasi / Alamat</p>
                            <p class="text-xs text-slate-200 font-medium max-w-[220px] truncate" title="{{ $schedule->location ?? $schedule->order->tempat_antar }}">
                                <i class="fa-solid fa-location-dot text-red-400 mr-1 text-[10px]"></i> 
                                @if(empty($schedule->location) || str_contains($schedule->location, 'Alamat Belum Ditentukan'))
                                    {{ $schedule->order->tempat_antar ?? 'Alamat Belum Ditentukan' }}
                                @else
                                    {{ $schedule->location }}
                                @endif
                            </p>
                        </div>

                        <div class="space-y-1">
                            <p class="text-[9px] uppercase tracking-wider text-slate-500 font-bold">Finansial & Tagihan</p>
                            @if($schedule->status === 'Selesai')
                                <p class="text-xs font-mono font-bold text-emerald-400">Rp {{ number_format($schedule->order->total_bayar ?? 0, 0, ',', '.') }}</p>
                                <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/5 px-1.5 py-0.5 rounded border border-emerald-500/10 inline-block mt-0.5">
                                    <i class="fa-solid fa-circle-check mr-0.5"></i> LUNAS
                                </span>
                            @else
                                <p class="text-xs font-mono font-bold text-amber-400">Rp {{ number_format($schedule->order->total_bayar ?? 0, 0, ',', '.') }}</p>
                                <span class="text-[10px] font-bold text-amber-400 bg-amber-500/5 px-1.5 py-0.5 rounded border border-amber-500/10 inline-block mt-0.5">
                                    @if($schedule->status === 'Siap Kirim')
                                        <i class="fa-solid fa-truck-ramp-box mr-0.5 animate-pulse"></i> COD: SIAP KIRIM
                                    @else
                                        <i class="fa-solid fa-clock mr-0.5"></i> COD: BELUM LUNAS
                                    @endif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-3 shrink-0 w-full md:w-auto justify-between md:justify-end border-t md:border-t-0 border-white/5 pt-3 md:pt-0">
                        
                        <button type="button" 
                                onclick="bukaModalDetail('{{ json_encode([
                                    'code' => $schedule->order->order_code ?? '-',
                                    'nama' => $schedule->order->nama_pemesan ?? $schedule->order->customer_name ?? 'Anonim',
                                    'wa' => $schedule->order->nomor_wa ?? '-',
                                    'paket' => $schedule->order->package_name ?? '-',
                                    'porsi' => ($schedule->order->jumlah_porsi ?? 0) . ' PCS',
                                    'tgl' => \Carbon\Carbon::parse($schedule->delivery_date)->format('d F Y'),
                                    'jam' => \Carbon\Carbon::parse($schedule->delivery_time)->format('H:i') . ' WIB',
                                    'alamat' => $schedule->location ?? $schedule->order->tempat_antar ?? 'Belum Ditentukan',
                                    'total' => 'Rp ' . number_format($schedule->order->total_bayar ?? 0, 0, ',', '.'),
                                    'status_bayar' => ($schedule->status === 'Selesai') ? 'LUNAS / SETTLEMENT' : 'COD / BELUM LUNAS',
                                    'status_dapur' => $schedule->status,
                                    'catatan' => $schedule->order->catatan ?? 'Tidak ada catatan khusus.'
                                ]) }}')"
                                class="w-8 h-8 flex items-center justify-center bg-indigo-500/20 border border-indigo-500/40 hover:bg-indigo-600 text-indigo-300 hover:text-white rounded-xl text-xs transition duration-150" 
                                title="Lihat Detail Lengkap">
                            <i class="fa-solid fa-eye text-sm"></i>
                        </button>

                        <form action="{{ url('/admin/schedules/'.$schedule->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="location" value="{{ $schedule->location ?? $schedule->order->tempat_antar }}">
                            <input type="hidden" name="delivery_date" value="{{ $schedule->delivery_date }}">
                            <input type="hidden" name="delivery_time" value="{{ $schedule->delivery_time }}">

                            <select name="status" onchange="this.form.submit()" 
                                    class="select-status px-3 py-1.5 rounded-lg text-[11px] font-bold uppercase tracking-wider cursor-pointer border focus:outline-none transition
                                    {{ $schedule->status == 'Antrean Dapur' ? 'bg-purple-500/10 text-purple-400 border-purple-500/20' : '' }}
                                    {{ $schedule->status == 'Proses Masak' ? 'bg-amber-500/10 text-amber-400 border-amber-500/20' : '' }}
                                    {{ $schedule->status == 'Siap Kirim' ? 'bg-blue-500/10 text-blue-400 border-blue-500/20' : '' }}
                                    {{ $schedule->status == 'Selesai' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : '' }}">
                                <option value="Antrean Dapur" {{ $schedule->status == 'Antrean Dapur' ? 'selected' : '' }} class="bg-slate-950 text-purple-400 font-bold">Antrean Dapur</option>
                                <option value="Proses Masak" {{ $schedule->status == 'Proses Masak' ? 'selected' : '' }} class="bg-slate-950 text-amber-400 font-bold">Proses Masak</option>
                                <option value="Siap Kirim" {{ $schedule->status == 'Siap Kirim' ? 'selected' : '' }} class="bg-slate-950 text-blue-400 font-bold">Siap Kirim</option>
                                <option value="Selesai" {{ $schedule->status == 'Selesai' ? 'selected' : '' }} class="bg-slate-950 text-emerald-400 font-bold">Selesai Terantar</option>
                            </select>
                        </form>
                        
                        <div class="flex gap-1.5">
                            
                        </div>
                    </div>

                </div>
            @empty
                <div id="empty_state" class="luxury-glass rounded-2xl p-16 text-center text-sm text-slate-500 italic border border-dashed border-white/10">
                    <i class="fa-solid fa-calendar-xmark block text-3xl mb-3 text-slate-600"></i>
                    Belum ada agenda jadwal pengiriman katering aktif untuk jangka waktu dekat ini.
                </div>
            @endforelse

            <div id="search_empty_msg" class="hidden luxury-glass rounded-2xl p-16 text-center text-sm text-slate-500 italic border border-dashed border-white/10">
                <i class="fa-solid fa-magnifying-glass block text-3xl mb-3 text-slate-600"></i>
                Tidak ditemukan agenda pengiriman katering yang cocok dengan filter kriteria Anda.
            </div>
        </div>

    </main>

    <div id="modal_detail_pesanan" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
        <div class="modal-glass w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden animate-fade-in text-xs md:text-sm">
            <div class="p-5 border-b border-white/10 bg-white/[0.02] flex justify-between items-center">
                <div class="flex items-center gap-2 text-[#c29b40]">
                    <i class="fa-solid fa-receipt text-base"></i>
                    <h3 class="font-serif text-base font-bold tracking-wide text-white">Lembar Detail Nota Transaksi</h3>
                </div>
                <button onclick="tutupModalDetail()" class="text-slate-400 hover:text-white transition text-base">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <div class="p-6 space-y-5 max-h-[75vh] overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 bg-white/[0.02] border border-white/5 rounded-xl space-y-1">
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold block">Kode Transaksi</span>
                        <span id="md_code" class="font-mono font-bold text-[#c29b40] text-sm">-</span>
                    </div>
                    <div class="p-3 bg-white/[0.02] border border-white/5 rounded-xl space-y-1">
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold block">Nama Pelanggan</span>
                        <span id="md_nama" class="font-semibold text-white block">-</span>
                        <span id="md_wa" class="text-[11px] text-slate-400 font-mono block"></span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 bg-white/[0.02] border border-white/5 rounded-xl space-y-1.5">
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold block">Paket Katering</span>
                        <p id="md_paket" class="text-slate-200 font-semibold">-</p>
                        <span id="md_porsi" class="px-2 py-0.5 bg-white/5 text-slate-300 font-mono text-[10px] border border-white/10 rounded"></span>
                    </div>
                    <div class="p-3 bg-white/[0.02] border border-white/5 rounded-xl space-y-1.5">
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold block">Agenda Distribusi</span>
                        <p id="md_tgl" class="text-slate-200 font-medium"><i class="fa-regular fa-calendar text-[11px] mr-1"></i> -</p>
                        <p id="md_jam" class="text-slate-300 font-mono text-[11px]"><i class="fa-regular fa-clock text-[11px] mr-1"></i> -</p>
                    </div>
                </div>

                <div class="p-3 bg-white/[0.02] border border-white/5 rounded-xl space-y-1">
                    <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold block">Alamat / Lokasi Tujuan</span>
                    <p class="text-slate-200 font-medium leading-relaxed">
                        <i class="fa-solid fa-location-dot text-red-400 mr-1.5 text-xs"></i><span id="md_alamat">-</span>
                    </p>
                </div>

                <div class="p-3 bg-black/40 border border-white/5 rounded-xl space-y-1.5">
                    <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold block"><i class="fa-solid fa-comment-dots mr-1"></i>Catatan Khusus Pesanan</span>
                    <p id="md_catatan" class="text-slate-400 italic font-medium leading-relaxed pl-1">-</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 bg-emerald-500/5 border border-emerald-500/20 rounded-xl space-y-1">
                        <span class="text-[10px] text-emerald-400 uppercase tracking-widest font-bold block">Status Finansial & Tagihan</span>
                        <span id="md_total" class="font-mono font-bold text-emerald-400 text-base block">-</span>
                        <span id="md_status_bayar" class="text-[10px] font-bold text-white tracking-wide uppercase px-2 py-0.5 rounded bg-emerald-500/20 border border-emerald-500/30 inline-block mt-1"></span>
                    </div>
                    <div class="p-3 bg-blue-500/5 border border-blue-500/20 rounded-xl space-y-1">
                        <span class="text-[10px] text-blue-400 uppercase tracking-widest font-bold block">Status Lini Produksi</span>
                        <span id="md_status_dapur" class="font-bold text-white text-sm block mt-1 uppercase tracking-wide">-</span>
                        <span class="text-[10px] text-slate-500 block mt-1"><i class="fa-solid fa-circle-nodes text-blue-400 mr-0.5"></i> Live tracking operasional</span>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-black/40 border-t border-white/10 flex justify-end">
                <button onclick="tutupModalDetail()" class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 text-slate-300 text-xs font-semibold rounded-xl transition">
                    Tutup Detail
                </button>
            </div>
        </div>
    </div>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

    <script type="text/javascript">
        // FUNGSI UTAMA POPUP WINDOW MODAL DETAIL
        function bukaModalDetail(dataJsonString) {
            try {
                const data = JSON.parse(dataJsonString);
                
                document.getElementById('md_code').innerText = data.code;
                document.getElementById('md_nama').innerText = data.nama;
                document.getElementById('md_wa').innerHTML = `<i class="fa-brands fa-whatsapp text-emerald-400 mr-0.5"></i> ` + data.wa;
                document.getElementById('md_paket').innerText = data.paket;
                document.getElementById('md_porsi').innerText = "Volume: " + data.porsi;
                document.getElementById('md_tgl').innerHTML = `<i class="fa-regular fa-calendar text-[11px] mr-1 text-amber-400"></i> ` + data.tgl;
                document.getElementById('md_jam').innerHTML = `<i class="fa-regular fa-clock text-[11px] mr-1 text-amber-400"></i> ` + data.jam;
                document.getElementById('md_alamat').innerText = data.alamat;
                document.getElementById('md_catatan').innerText = data.catatan;
                document.getElementById('md_total').innerText = data.total;
                document.getElementById('md_status_bayar').innerText = data.status_bayar;
                document.getElementById('md_status_dapur').innerText = "⚡ " + data.status_dapur;

                // Tampilkan Modal ke Layar
                document.getElementById('modal_detail_pesanan').classList.remove('hidden');
            } catch (error) {
                console.error("Gagal memuat rincian popup nota:", error);
            }
        }

        function tutupModalDetail() {
            document.getElementById('modal_detail_pesanan').classList.add('hidden');
        }

        // FUNGSI JAVASCRIPT ENGINE REALTIME FILTER DATA
        function jalankanFilterData() {
            const kataKunci = document.getElementById('search_input').value.toLowerCase();
            const tipeWaktu = document.getElementById('time_filter').value;
            const agendaItems = document.querySelectorAll('.schedule-item');
            
            const sekarang = new Date();
            sekarang.setHours(0,0,0,0);

            let adaDataTampil = false;

            agendaItems.forEach(item => {
                const invoice = item.getAttribute('data-invoice');
                const nama = item.getAttribute('data-name');
                const tglString = item.getAttribute('data-date');
                const tglJadwal = new Date(tglString);
                tglJadwal.setHours(0,0,0,0);

                const cocokTeks = invoice.includes(kataKunci) || nama.includes(kataKunci);
                let cocokWaktu = false;

                if (tipeWaktu === 'all') {
                    cocokWaktu = true;
                } else if (tipeWaktu === 'today') {
                    cocokWaktu = tglJadwal.getTime() === sekarang.getTime();
                } else if (tipeWaktu === 'week') {
                    const batasMinggu = new Date(sekarang);
                    batasMinggu.setDate(sekarang.getDate() + 7);
                    cocokWaktu = tglJadwal >= sekarang && tglJadwal <= batasMinggu;
                } else if (tipeWaktu === 'month') {
                    cocokWaktu = tglJadwal.getMonth() === sekarang.getMonth() && tglJadwal.getFullYear() === sekarang.getFullYear();
                }

                if (cocokTeks && cocokWaktu) {
                    item.classList.remove('hidden');
                    item.classList.add('flex');
                    adaDataTampil = true;
                } else {
                    item.classList.remove('flex');
                    item.classList.add('hidden');
                }
            });

            const msgEmpty = document.getElementById('search_empty_msg');
            const originalEmpty = document.getElementById('empty_state');

            if (msgEmpty) {
                if (!adaDataTampil) {
                    msgEmpty.classList.remove('hidden');
                    if(originalEmpty) originalEmpty.classList.add('hidden');
                } else {
                    msgEmpty.classList.add('hidden');
                }
            }
        }
    </script>
</body>
</html>