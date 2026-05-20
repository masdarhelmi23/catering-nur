<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\FoodPackage;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans secara otomatis dari file .env
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // 1. Tampilkan Form Pemesanan
    public function showForm($id)
    {
        $package = FoodPackage::findOrFail($id);

        if ($package->stock <= 0) {
            return redirect('/')->with('error', 'Maaf, stok paket hidangan ini sedang habis.');
        }

        return view('customer.booking_form', compact('package'));
    }

    // 2. Simpan Data Pesanan & POTONG STOK INSTAN DI AWAL (Status Kembali 'Pending' Secara Alami)
    public function submitOrder(Request $request, $id)
    {
        $package = FoodPackage::findOrFail($id);

        // Validasi parameter rencana pemesanan katering
        $request->validate([
            'nama_pemesan'  => 'required|string|max:255',
            'nomor_wa'      => 'required|string|min:8|max:20',
            'tanggal_acara' => 'required|date|after_or_equal:today',
            'delivery_time' => 'required|string',
            'tempat_antar'  => 'required|string|max:255', 
            'jumlah_porsi'  => 'required|integer|min:1|max:' . $package->stock,
            'catatan'       => 'nullable|string|max:1000',
        ]);

        // ========================================================
        // EKSEKUSI POTONG STOK DI AWAL AGAR AMAN DI LOCALHOST
        // ========================================================
        $package->decrement('stock', $request->jumlah_porsi);

        $totalBayar = $package->price * $request->jumlah_porsi;
        $orderCode = 'NUR-' . strtoupper(Str::random(5));

        // REVISI PAS: Status awal diset 'Pending' karena baru membuat invoice dan belum dibayar
        $order = Order::create([
            'order_code'    => $orderCode,
            'customer_name' => Auth::user()->name, 
            'user_id'       => Auth::id(),
            'nama_pemesan'  => $request->nama_pemesan,
            'nomor_wa'      => $request->nomor_wa,
            'package_name'  => $package->package_name,
            'delivery_time' => $request->delivery_time,
            'tempat_antar'  => $request->tempat_antar, 
            'tanggal_acara' => $request->tanggal_acara,
            'jumlah_porsi'  => $request->jumlah_porsi,
            'total_bayar'   => $totalBayar,
            'catatan'       => $request->catatan,
            'status'        => 'Pending' // <-- DIUBAH KEMBALI JADI PENDING
        ]);

        // Payload Transaksi untuk dikirimkan ke server Midtrans
        $transactionPayload = [
            'transaction_details' => [
                'order_id'     => $orderCode,
                'gross_amount' => (int) $totalBayar,
            ],
            'customer_details' => [
                'first_name' => $request->nama_pemesan,
                'phone'      => $request->nomor_wa,
                'email'      => Auth::user()->email ?? 'customer@nurbaluwarti.com',
            ],
            'item_details' => [
                [
                    'id'       => $package->id,
                    'price'    => (int) $package->price,
                    'quantity' => (int) $request->jumlah_porsi,
                    'name'     => $package->package_name,
                ]
            ]
        ];

        try {
            // Request Token unik Snap ke Midtrans
            $snapToken = Snap::getSnapToken($transactionPayload);
            
            // Simpan token tersebut ke record order katering tadi
            $order->update(['snap_token' => $snapToken]);

            // Alihkan customer langsung ke halaman pembayaran invoice khusus
            return redirect()->route('pesanan.payment', $order->id);

        } catch (\Exception $e) {
            // JALUR PENYELAMAT DATA: Jika koneksi Midtrans down, kembalikan stok paketnya
            $package->increment('stock', $request->jumlah_porsi);
            return back()->withErrors(['midtrans_error' => 'Gagal terhubung ke gateway pembayaran: ' . $e->getMessage()]);
        }
    }

    // 3. Halaman Gerbang Pembayaran Snap Invoice
    public function showPayment($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return view('customer.payment_gate', compact('order'));
    }

    // 4. Tampilkan Riwayat Pesanan Customer
    public function index()
    {
        // Mengambil ID user yang sedang login
        $userId = \Auth::id();

        // REVISI UTAMA: Lakukan leftJoin ke tabel delivery_schedules agar status dapur terbaca riel
        $orders = DB::table('orders')
            ->leftJoin('delivery_schedules', 'orders.id', '=', 'delivery_schedules.order_id')
            ->where('orders.user_id', $userId)
            ->where('orders.status', '!=', 'Sistem') // Sembunyikan log sistem audit
            ->orderBy('orders.created_at', 'desc')
            ->select(
                'orders.*', 
                'delivery_schedules.status as status_dapur' // Ikat nama kolomnya menjadi status_dapur
            )
            ->get();

        // Lempar variabel data ke file orders_index.blade.php
        return view('customer.orders_index', compact('orders'));
    }

    // 5. REVISI AKTIF: Memproses perubahan status dari form tersembunyi setelah snap ditutup/selesai
    public function updateStatusLocal(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $statusBaru = $request->input('status');

        if ($statusBaru === 'Sukses') {
            // Perbarui status record order menjadi lunas / Sukses
            $order->update(['status' => 'Sukses']);
            return redirect('/pesanan')->with('success', 'Pembayaran sukses diverifikasi!');
        }

        return redirect('/pesanan');
    }
}