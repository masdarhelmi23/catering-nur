<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Order;

class TransactionController extends Controller
{
    /**
     * Tampilkan List Riwayat Transaksi di Panel Admin
     */
    public function index()
    {
        $transactions = DB::table('orders')
            ->where('status', '!=', 'Sistem')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Buka Form Input Manual
     */
    public function create()
    {
        $packages = DB::table('food_packages')->get(); 
        return view('admin.transactions.create', compact('packages'));
    }

    /**
     * Simpan Data Transaksi Baru Manual (Memicu Log Asli)
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_code'    => 'required|unique:orders,order_code',
            'customer_name' => 'required|string|max:255',
            'nama_pemesan'  => 'required|string|max:255',
            'nomor_wa'      => 'required|string|max:20',
            'package_name'  => 'required|string|max:255',
            'jumlah_porsi'  => 'required|integer|min:1',
            'tanggal_acara' => 'required|date',
            'delivery_time' => 'required|string|max:255',
            'tempat_antar'  => 'required|string|max:255',
            'total_bayar'   => 'required|numeric',
            'status'        => 'required|string',
        ]);

        Order::create([
            'order_code'    => $request->order_code,
            'customer_name' => $request->customer_name,
            'nama_pemesan'  => $request->nama_pemesan,
            'nomor_wa'      => $request->nomor_wa,
            'package_name'  => $request->package_name,
            'jumlah_porsi'  => $request->jumlah_porsi,
            'tanggal_acara' => $request->tanggal_acara,
            'delivery_time' => $request->delivery_time,
            'tempat_antar'  => $request->tempat_antar,
            'total_bayar'   => $request->total_bayar,
            'status'        => $request->status,
            'user_id'       => Auth::id(),
        ]);

        // Pemicu Rekam Log Audit Otomatis
        parent::logAktivitas("Mencatat nota invoice offline baru untuk pelanggan: " . $request->nama_pemesan . " [" . $request->order_code . "]");

        return redirect('/admin/transactions')->with('success', 'Catatan invoice transaksi manual berhasil disimpan!');
    }

    /**
     * Buka Form Edit Detail Transaksi Manual
     */
    public function edit($id)
    {
        $transaction = DB::table('orders')->where('id', $id)->first();

        if (!$transaction) {
            abort(404, 'Data catatan transaksi tidak ditemukan.');
        }

        $packages = DB::table('food_packages')->get();

        return view('admin.transactions.edit', compact('transaction', 'packages'));
    }

    /**
     * Proses Simpan Perubahan Data Transaksi (Memicu Log Asli)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemesan'  => 'required|string|max:255',
            'nomor_wa'      => 'required|string|max:20',
            'package_name'  => 'required|string|max:255',
            'jumlah_porsi'  => 'required|integer|min:1',
            'tanggal_acara' => 'required|date',
            'delivery_time' => 'required|string|max:255',
            'tempat_antar'  => 'required|string|max:255',
            'total_bayar'   => 'required|numeric',
            'status'        => 'required|string',
        ]);

        DB::table('orders')
            ->where('id', $id)
            ->update([
                'customer_name' => trim($request->nama_pemesan),
                'nama_pemesan'  => $request->nama_pemesan,
                'nomor_wa'      => $request->nomor_wa,
                'package_name'  => $request->package_name,
                'jumlah_porsi'  => $request->jumlah_porsi,
                'tanggal_acara' => $request->tanggal_acara,
                'delivery_time' => $request->delivery_time,
                'tempat_antar'  => $request->tempat_antar,
                'total_bayar'   => $request->total_bayar,
                'status'        => $request->status,
                'updated_at'    => now(),
            ]);

        DB::table('delivery_schedules')
            ->where('order_id', $id)
            ->update([
                'location'      => $request->tempat_antar,
                'delivery_date' => $request->tanggal_acara,
                'delivery_time' => $request->delivery_time,
                'updated_at'    => now(),
            ]);

        // Pemicu Rekam Log Audit Otomatis
        parent::logAktivitas("Mengubah rincian data pesanan katering milik pelanggan: " . $request->nama_pemesan);

        return redirect('/admin/transactions')->with('success', 'Catatan invoice transaksi manual berhasil diperbarui!');
    }

    /**
     * Hapus Log Transaksi Beserta Jadwal Terkait
     */
    public function destroy($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        DB::table('delivery_schedules')->where('order_id', $id)->delete();
        DB::table('orders')->where('id', $id)->delete();

        // Pemicu Rekam Log Audit Otomatis
        if ($order) {
            parent::logAktivitas("Menghapus permanen data riwayat transaksi invoice: " . $order->order_code . " atas nama " . ($order->nama_pemesan ?? $order->customer_name));
        }

        return redirect('/admin/transactions')->with('success', 'Catatan transaksi katering berhasil dihapus dari sistem!');
    }

    /**
     * Dashboard Utama Sisi Owner - Pembukuan Finansial Otomatis
     */
    public function ownerDashboard(Request $request)
    {
        $filter = $request->get('filter', 'all');
        $query = DB::table('orders')->where('status', '!=', 'Sistem');
        
        if ($filter === 'week') {
            $query->where('created_at', '>=', now()->subDays(7));
        } elseif ($filter === 'month') {
            $query->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->get();
        
        $omzetLunas = 0;
        $piutangCod = 0;
        $totalPorsiTerjual = 0;
        
        foreach ($orders as $ord) {
            $totalPorsiTerjual += $ord->jumlah_porsi ?? 0;
            if (in_array($ord->status, ['Sukses', 'Lunas', 'Dalam Pengiriman'])) {
                $omzetLunas += $ord->total_bayar ?? 0;
            } else {
                $piutangCod += $ord->total_bayar ?? 0;
            }
        }
        
        return view('owner.dashboard', compact('orders', 'omzetLunas', 'piutangCod', 'totalPorsiTerjual', 'filter'));
    }

    /**
     * Halaman Cetak Nota Laporan Keuangan Owner
     */
    public function downloadReport(Request $request)
    {
        $filter = $request->get('filter', 'all');
        $query = DB::table('orders')->where('status', '!=', 'Sistem');
        
        if ($filter === 'week') {
            $query->where('created_at', '>=', now()->subDays(7));
        } elseif ($filter === 'month') {
            $query->whereMonth('created_at', now()->month);
        }
        
        $orders = $query->orderBy('created_at', 'asc')->get();
        return view('owner.report_print', compact('orders', 'filter'));
    }
}