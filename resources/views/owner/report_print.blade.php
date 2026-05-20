<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan_Pembukuan_Catering_Nur_{{ date('d_m_Y') }}</title>
    <style>
        /* Pengaturan Dasar Halaman Cetak */
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            color: #111; 
            font-size: 11px; 
            line-height: 1.5;
            padding: 10px; 
            margin: 0;
        }
        
        /* Kop Surat/Header Laporan Resmi */
        .header { 
            text-align: center; 
            margin-bottom: 25px; 
            border-bottom: 3px double #111; 
            padding-bottom: 12px; 
        }
        .header h2 { 
            margin: 0; 
            font-size: 20px; 
            text-transform: uppercase; 
            letter-spacing: 2px;
            font-weight: 700;
        }
        .header p { 
            margin: 4px 0 0 0; 
            font-size: 11px; 
            color: #444; 
        }
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 10px;
            color: #333;
            font-weight: 500;
        }

        /* Ringkasan Ringkas Keuangan Atas */
        .summary-box {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .summary-box td {
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fafafa;
            width: 33.33%;
        }
        .summary-title {
            font-size: 9px;
            text-transform: uppercase;
            color: #666;
            font-weight: bold;
            display: block;
            margin-bottom: 3px;
        }
        .summary-value {
            font-size: 14px;
            font-weight: bold;
            font-family: monospace;
        }

        /* Aturan Standar Tabel Akuntansi */
        table.data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        table.data-table th, table.data-table td { 
            border: 1px solid #111; 
            padding: 7px 8px; 
            text-align: left; 
        }
        table.data-table th { 
            background-color: #f2f2f2; 
            text-transform: uppercase; 
            font-size: 9px; 
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        table.data-table tr:nth-child(even) td {
            background-color: #fafafa;
        }
        
        /* Utilitas Perataan Kolom */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-mono { font-family: monospace; font-size: 11px; }
        .total-row { font-weight: bold; background-color: #eaeaea !important; }
        
        /* Status Badges untuk Cetak */
        .badge {
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
        }
        .text-success { color: #047857; }
        .text-amber { color: #b45309; }

        /* Blok Tanda Tangan Kredibilitas Laporan */
        .signature-container {
            margin-top: 40px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .signature-space {
            height: 60px;
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        /* CSS khusus print untuk menghilangkan margin kosong browser */
        @media print {
            @page { margin: 1.5cm; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>Catering Nur Baluwarti Surakarta</h2>
        <p>Laporan Neraca Jurnal Penjualan & Pembukuan Kas Masuk Konten Valid</p>
        <div class="meta-info">
            <span>PERIODE FILTER: {{ strtoupper($filter ?? 'SEMUA DATA') }}</span>
            <span>TANGGAL CETAK: {{ date('d-m-Y H:i') }} WIB</span>
        </div>
    </div>

    @php 
        $totalLunas = 0; 
        $totalPiutang = 0; 
        $totalPorsi = 0;
        
        foreach($orders as $order) {
            $totalPorsi += $order->jumlah_porsi;
            if (in_array($order->status, ['Sukses', 'Lunas', 'Dalam Pengiriman'])) {
                $totalLunas += $order->total_bayar;
            } else {
                $totalPiutang += $order->total_bayar;
            }
        }
    @endphp

    <table class="summary-box">
        <tr>
            <td>
                <span class="summary-title">Dana Masuk (Kas Lunas)</span>
                <span class="summary-value text-success">Rp {{ number_format($totalLunas, 0, ',', '.') }}</span>
            </td>
            <td>
                <span class="summary-title">Dana Piutang (COD / Pending)</span>
                <span class="summary-value text-amber">Rp {{ number_format($totalPiutang, 0, ',', '.') }}</span>
            </td>
            <td>
                <span class="summary-title">Total Volume Penjualan</span>
                <span class="summary-value" style="color: #1e3a8a;">{{ $totalPorsi }} Pax Porsi</span>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%;" class="text-center">No</th>
                <th style="width: 12%;">Tanggal Order</th>
                <th style="width: 13%;">Kode Invoice</th>
                <th style="width: 22%;">Nama Pelanggan</th>
                <th style="width: 20%;">Paket Hidangan</th>
                <th style="width: 9%;" class="text-center">Kuantitas</th>
                <th style="width: 12%;" class="text-center">Status Buku</th>
                <th style="width: 14%;" class="text-right">Nominal Tagihan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $index => $order)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center font-mono">{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    <td class="font-mono font-bold" style="color: #b45309;">{{ $order->order_code }}</td>
                    <td style="font-weight: 500;">{{ $order->nama_pemesan ?? $order->customer_name }}</td>
                    <td>{{ $order->package_name }}</td>
                    <td class="text-center font-mono">{{ $order->jumlah_porsi }} Pax</td>
                    <td class="text-center">
                        @if(in_array($order->status, ['Sukses', 'Lunas', 'Dalam Pengiriman']))
                            <span class="badge text-success">Kredit Kas</span>
                        @else
                            <span class="badge text-amber">Piutang COD</span>
                        @endif
                    </td>
                    <td class="text-right font-mono font-bold">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="font-style: italic; padding: 20px;">
                        Tidak ditemukan rekaman transaksi data keuangan pada periode saringan ini.
                    </td>
                </tr>
            @endforelse
            
            <tr class="total-row">
                <td colspan="5" class="text-right">TOTAL OMZET KESELURUHAN (BRUTO):</td>
                <td class="text-center font-mono">{{ $totalPorsi }} Pax</td>
                <td></td>
                <td class="text-right font-mono" style="font-size: 12px; color: #1e3a8a;">
                    Rp {{ number_format($totalLunas + $totalPiutang, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="signature-container">
        <div class="signature-box">
            <p>Surakarta, {{ date('d F Y') }}</p>
            <p style="margin-top: 5px;">Mengevaluasi, <br><strong>Owner Catering Nur Baluwarti</strong></p>
            <div class="signature-space"></div>
            <p class="signature-name">{{ Auth::user()->name ?? 'Owner Utama' }}</p>
            <p style="margin: 2px 0 0 0; font-size: 9px; color: #666; font-family: monospace;">ID Otoritas: PIMPINAN-CORE</p>
        </div>
    </div>

</body>
</html>