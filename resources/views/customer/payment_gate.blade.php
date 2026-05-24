<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran - Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-luxury-dark { background: radial-gradient(circle at top left, #1e1b4b 0%, #0f172a 65%, #020617 100%); }
        .luxury-glass { background: rgba(30, 41, 59, 0.75); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col justify-between">

    @include('customer.layouts.navbar')

    <main class="max-w-md w-full mx-auto p-4 flex-grow flex items-center justify-center">
        <div class="luxury-glass rounded-2xl p-6 border border-white/10 w-full shadow-2xl text-center space-y-5">
            
            <div class="w-14 h-14 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-full flex items-center justify-center mx-auto text-xl shadow-lg">
                <i class="fa-solid fa-file-invoice-dollar"></i>
            </div>

            <div class="space-y-1">
                <h3 class="font-serif text-xl font-bold text-white tracking-wide">Invoice Pembayaran</h3>
                <p class="text-xs text-slate-400">Kode Transaksi: <span class="font-mono text-[#c29b40] font-bold">{{ $order->order_code }}</span></p>
            </div>

            <div class="bg-black/30 rounded-xl p-4 border border-white/5 text-left text-xs space-y-2 text-slate-300">
                <div class="flex justify-between"><span class="text-slate-500">Menu Paket:</span><span class="font-semibold text-white">{{ $order->package_name }}</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Jumlah Porsi:</span><span>{{ $order->jumlah_porsi }} Pax</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Tanggal Kirim:</span><span>{{ date('d M Y', strtotime($order->tanggal_acara)) }}</span></div>
                <div class="flex justify-between border-t border-white/5 pt-2 mt-2">
                    <span class="font-bold text-white">Total Tagihan:</span>
                    <span class="font-mono font-bold text-emerald-400 text-sm">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</span>
                </div>
            </div>

            <button id="pay-button" class="w-full py-3.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-widest rounded-xl shadow-xl transition duration-200 flex items-center justify-center gap-2">
                <i class="fa-solid fa-credit-card"></i> Bayar Sekarang via Midtrans
            </button>
        </div>
    </main>

    <form id="local-status-form" action="{{ url('/proses-pesanan/'.$order->id.'/update-status') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="status" value="Sukses">
    </form>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[9px] text-slate-600 uppercase tracking-widest font-semibold">
        &copy; {{ date('Y') }} Nur Baluwarti System &bull; All Rights Reserved
    </footer>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $order->snap_token }}', {
                onSuccess: function (result) { 
                    // Hanya jalankan ini jika pembayaran benar-benar BERHASIL
                    executeSubmitLokal(); 
                },
                onPending: function (result) { 
                    // Jangan panggil executeSubmitLokal di sini
                    alert("Menunggu pembayaran Anda."); 
                },
                onError: function (result) { 
                    alert("Pembayaran gagal!"); 
                },
                onClose: function () { 
                    alert("Anda menutup pembayaran. Silakan selesaikan agar pesanan terkonfirmasi."); 
                }
            });
        });

        function executeSubmitLokal() {
            document.getElementById('local-status-form').submit();
        }
    </script>
</body>
</html>