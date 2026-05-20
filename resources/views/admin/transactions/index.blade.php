<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
        
        .select-status-filter {
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none'><path stroke='%2394a3b8' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' d='M1 1l4 4 4-4'/></svg>");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('admin.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 space-y-6 max-w-[1600px] w-full mx-auto">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/[0.02] p-6 rounded-2xl border border-white/5">
            <div>
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Log Transaksi & Pembayaran</h2>
                <p class="text-xs text-slate-400 mt-0.5">Pantau status pembayaran invoice, pencatatan manual, dan penghapusan data finansial.</p>
            </div>
            <a href="{{ url('/admin/transactions/create') }}" class="px-4 py-2.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold rounded-xl shadow-lg transition duration-200 flex items-center gap-2">
                <i class="fa-solid fa-square-plus text-sm"></i> Tambah Transaksi Manual
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 animate-fade-in">
            <div class="luxury-glass p-5 rounded-2xl border-l-4 border-l-emerald-500 relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300 shadow-md">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Uang Masuk (Lunas)</p>
                        <h3 id="widget_lunas_display" class="text-2xl font-bold text-emerald-400 font-mono">Rp 0</h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-3"><i class="fa-solid fa-circle-check text-emerald-500 mr-1"></i> Data lunas terfilter pada tabel di bawah</p>
            </div>

            <div class="luxury-glass p-5 rounded-2xl border-l-4 border-l-amber-500 relative overflow-hidden group hover:border-[#c29b40]/30 transition duration-300 shadow-md">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Sisa Piutang (Belum Lunas)</p>
                        <h3 id="widget_pending_display" class="text-2xl font-bold text-amber-400 font-mono">Rp 0</h3>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                </div>
                <p class="text-[10px] text-slate-500 mt-3"><i class="fa-solid fa-circle-exclamation text-amber-500 mr-1"></i> Data tagihan COD terfilter pada tabel di bawah</p>
            </div>
        </div>

        <div class="luxury-glass p-4 rounded-2xl border border-white/5 grid grid-cols-1 md:grid-cols-3 gap-4 items-center shadow-md">
            <div class="relative col-span-1 md:col-span-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 text-xs">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input id="search_tx_input" type="text" oninput="jalankanFilterTransaksi()" placeholder="Cari kode invoice, nama pelanggan, atau varian paket katering..." 
                       class="w-full pl-10 pr-4 py-2 bg-black/40 border border-white/10 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[#c29b40] transition">
            </div>

            <div class="relative">
                <select id="time_tx_filter" onchange="jalankanFilterTransaksi()" 
                        class="select-status-filter w-full px-4 py-2 bg-black/40 border border-white/10 rounded-xl text-xs text-slate-300 font-medium cursor-pointer focus:outline-none focus:border-[#c29b40] transition">
                    <option value="all" class="bg-slate-950 text-slate-300">Semua Riwayat Transaksi</option>
                    <option value="today" class="bg-slate-950 text-slate-300">Hari Ini (Per Hari)</option>
                    <option value="week" selected class="bg-slate-950 text-slate-300">Minggu Ini (Per Minggu)</option>
                    <option value="month" class="bg-slate-950 text-slate-300">Bulan Ini (Per Bulan)</option>
                </select>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-check text-sm"></i> {{ session('success') }}
            </div>
        @endif

        <div class="luxury-glass rounded-2xl overflow-hidden shadow-2xl">
            <div class="p-5 border-b border-white/5 bg-white/[0.01] flex justify-between items-center">
                <h3 class="font-serif text-base font-bold text-white tracking-wide">Arus Invoice Masuk</h3>
                <span class="px-2.5 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[9px] uppercase font-mono tracking-widest rounded-md">Audit Internal</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-slate-400 text-[10px] uppercase tracking-wider border-b border-white/5">
                            <th class="py-3.5 px-5">Kode Invoice</th>
                            <th class="py-3.5 px-5">Nama Pelanggan</th>
                            <th class="py-3.5 px-5">Detail Menu & Porsi</th>
                            <th class="py-3.5 px-5">Lokasi Pengantaran</th>
                            <th class="py-3.5 px-5">Total Bayar</th>
                            <th class="py-3.5 px-5 text-center">Status</th>
                            <th class="py-3.5 px-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tx_table_body" class="text-xs divide-y divide-white/5 text-slate-300">
                        @forelse(($transactions ?? []) as $tx)
                            <tr class="tx-row hover:bg-white/[0.01] transition duration-150"
                                data-code="{{ strtolower($tx->order_code ?? '') }}"
                                data-customer="{{ strtolower($tx->nama_pemesan ?? $tx->customer_name ?? '') }}"
                                data-package="{{ strtolower($tx->package_name ?? '') }}"
                                data-nominal="{{ $tx->total_bayar ?? 0 }}"
                                data-status-pembayaran="{{ ($tx->status == 'Sukses' || $tx->status == 'Lunas' || $tx->status == 'Dalam Pengiriman') ? 'lunas' : 'pending' }}"
                                data-date="{{ !empty($tx->created_at) ? date('Y-m-d', strtotime($tx->created_at)) : date('Y-m-d') }}">
                                
                                <td class="py-4 px-5 font-mono font-bold text-[#c29b40]">{{ $tx->order_code }}</td>
                                
                                <td class="py-4 px-5 space-y-0.5">
                                    <p class="font-semibold text-white">{{ $tx->nama_pemesan ?? $tx->customer_name }}</p>
                                    @if(!empty($tx->nomor_wa))
                                        <span class="text-[10px] text-slate-500 font-mono block"><i class="fa-brands fa-whatsapp text-emerald-500 mr-0.5"></i> {{ $tx->nomor_wa }}</span>
                                    @endif
                                </td>
                                
                                <td class="py-4 px-5 space-y-0.5">
                                    <p class="text-slate-300 font-medium">{{ $tx->package_name }}</p>
                                    <span class="text-[10px] bg-white/5 px-2 py-0.5 rounded border border-white/5 text-slate-400 font-mono inline-block">{{ $tx->jumlah_porsi ?? 0 }} Porsi</span>
                                </td>
                                
                                <td class="py-4 px-5 text-slate-400 max-w-[200px] truncate" title="{{ $tx->tempat_antar ?? '-' }}">
                                    <span class="text-xs text-slate-300"><i class="fa-solid fa-location-dot text-red-400 mr-1"></i>{{ $tx->tempat_antar ?? '-' }}</span>
                                </td>

                                <td class="py-4 px-5 font-mono font-bold text-slate-200">
                                    Rp {{ number_format($tx->total_bayar ?? 0, 0, ',', '.') }}
                                </td>
                                
                                <td class="py-4 px-5 text-center">
                                    @if($tx->status == 'Sukses' || $tx->status == 'Lunas' || $tx->status == 'Dalam Pengiriman')
                                        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] font-bold rounded-lg uppercase tracking-wider block w-fit mx-auto">Settlement / Lunas</span>
                                    @elseif($tx->status == 'Pending' || $tx->status == 'Menunggu Konfirmasi DP')
                                        <span class="px-3 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[10px] font-bold rounded-lg uppercase tracking-wider block w-fit mx-auto">Pending / COD</span>
                                    @else
                                        <span class="px-3 py-1 bg-slate-500/20 text-slate-400 border border-white/10 text-[10px] font-bold rounded-lg uppercase tracking-wider block w-fit mx-auto">{{ $tx->status }}</span>
                                    @endif
                                </td>
                                
                                <td class="py-4 px-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/transactions/'.$tx->id.'/edit') }}" 
                                           class="w-7 h-7 flex items-center justify-center bg-blue-500/10 border border-blue-500/20 hover:bg-blue-500 text-blue-400 hover:text-white rounded-lg text-xs transition duration-150" 
                                           title="Edit Detail Transaksi">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ url('/admin/transactions/'.$tx->id) }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan transaksi ini? Jadwal pengiriman terkait juga akan ikut terhapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-7 h-7 flex items-center justify-center bg-red-500/10 border border-red-500/20 hover:bg-red-500 text-red-400 hover:text-white rounded-lg text-xs transition duration-150" title="Hapus Transaksi">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="empty_row_state">
                                <td colspan="7" class="py-12 text-center text-xs text-slate-500 italic">
                                    <i class="fa-solid fa-receipt block text-2xl mb-2 text-slate-600"></i>
                                    Belum ada log rekaman riwayat transaksi katering di sistem database.
                                </td>
                            </tr>
                        @endforelse

                        <tr id="search_tx_empty_msg" class="hidden">
                            <td colspan="7" class="py-12 text-center text-xs text-slate-500 italic">
                                <i class="fa-solid fa-magnifying-glass block text-2xl mb-2 text-slate-600"></i>
                                Tidak ditemukan rekaman log transaksi katering yang sesuai dengan filter kriteria Anda.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

    <script type="text/javascript">
        function jalankanFilterTransaksi() {
            const keyword = document.getElementById('search_tx_input').value.toLowerCase();
            const timeFilter = document.getElementById('time_tx_filter').value;
            const rows = document.querySelectorAll('.tx-row');
            
            const hariIni = new Date();
            hariIni.setHours(0,0,0,0);

            let adaDataTampil = false;
            let totalLunas = 0;
            let totalPending = 0;

            rows.forEach(row => {
                const code = row.getAttribute('data-code');
                const customer = row.getAttribute('data-customer');
                const packet = row.getAttribute('data-package');
                const nominal = parseFloat(row.getAttribute('data-nominal')) || 0;
                const statusPembayaran = row.getAttribute('data-status-pembayaran');
                const dateStr = row.getAttribute('data-date');
                const rowDate = new Date(dateStr);
                rowDate.setHours(0,0,0,0);

                // 1. Cek validitas filter input teks
                const cocokTeks = code.includes(keyword) || customer.includes(keyword) || packet.includes(keyword);

                // 2. Cek validitas penanggalan
                let cocokWaktu = false;

                if (timeFilter === 'all') {
                    cocokWaktu = true;
                } else if (timeFilter === 'today') {
                    cocokWaktu = rowDate.getTime() === hariIni.getTime();
                } else if (timeFilter === 'week') {
                    // Jangkauan filter seminggu ke depan/belakang terdekat (7 hari)
                    const batasMinggu = new Date(hariIni);
                    batasMinggu.setDate(hariIni.getDate() - 7);
                    cocokWaktu = rowDate <= hariIni && rowDate >= batasMinggu;
                } else if (timeFilter === 'month') {
                    cocokWaktu = rowDate.getMonth() === hariIni.getMonth() && rowDate.getFullYear() === hariIni.getFullYear();
                }

                // Penggabungan kondisi filter logis
                if (cocokTeks && cocokWaktu) {
                    row.style.display = '';
                    adaDataTampil = true;
                    
                    // REVISI UTAMA 3: Menghitung nominal live yang tampil di layar
                    if (statusPembayaran === 'lunas') {
                        totalLunas += nominal;
                    } else {
                        totalPending += nominal;
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            // REVISI UTAMA 4: Render nominal terfilter ke widget atas secara realtime
            document.getElementById('widget_lunas_display').innerText = "Rp " + totalLunas.toLocaleString('id-ID');
            document.getElementById('widget_pending_display').innerText = "Rp " + totalPending.toLocaleString('id-ID');

            // Tampilkan pesan kegagalan pencarian jika pencarian kosong gress
            const emptyMsg = document.getElementById('search_tx_empty_msg');
            const originalEmptyRow = document.getElementById('empty_row_state');

            if (emptyMsg) {
                if (!adaDataTampil) {
                    emptyMsg.classList.remove('hidden');
                    if (originalEmptyRow) originalEmptyRow.classList.add('hidden');
                } else {
                    emptyMsg.classList.add('hidden');
                }
            }
        }

        // Jalankan filter otomatis saat pertama kali halaman di-load browser (Pemicu Default Minggu Ini)
        window.onload = function() {
            jalankanFilterTransaksi();
        };
    </script>
</body>
</html>