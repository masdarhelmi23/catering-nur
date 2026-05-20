<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliverySchedule;
use App\Models\Order; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryScheduleController extends Controller
{
    // Tampilkan Katalog Jadwal
    public function index()
    {
        $schedules = DeliverySchedule::with('order')->orderBy('delivery_date', 'asc')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    // Ambil form plot jadwal baru beserta data pesanan aktif
    public function create()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.schedules.create', compact('orders'));
    }

    // Eksekusi penyimpanan plot jadwal manual ke database
    public function store(Request $request)
    {
        $request->validate([
            'order_id'      => 'required|exists:orders,id',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'driver_name'   => 'nullable|string|max:255',
            'status'        => 'required|in:Antrean Dapur,Proses Masak,Siap Kirim,Selesai',
        ]);

        DeliverySchedule::create([
            'order_id'      => $request->order_id,
            'delivery_date' => $request->delivery_date,
            'delivery_time' => $request->delivery_time,
            'location'      => $request->location,
            'driver_name'   => $request->driver_name ?? 'Belum Diplot',
            'status'        => $request->status,
        ]);

        return redirect('/admin/schedules')->with('success', 'Agenda jadwal pengiriman manual baru berhasil diplot!');
    }
    /**
     * Tampilkan Halaman Form Edit Status Alur Dapur
     */
    public function edit($id)
    {
        // Cari data jadwal pengiriman berdasarkan ID, atau lempar 404 jika tidak ketemu
        $schedule = DB::table('delivery_schedules')
            ->where('id', $id)
            ->first();

        if (!$schedule) {
            abort(404, 'Data jadwal pengiriman tidak ditemukan.');
        }

        // Ambil data order terkait untuk menampilkan info ringkasan katering di form edit
        $order = DB::table('orders')->where('id', $schedule->order_id)->first();

        return view('admin.schedules.edit', compact('schedule', 'order'));
    }

    /**
     * Proses Simpan Perubahan Status Alur Dapur & Lokasi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status'   => 'required|string',
            'location' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required|string|max:255',
        ]);

        // Eksekusi update langsung ke tabel database
        DB::table('delivery_schedules')
            ->where('id', $id)
            ->update([
                'status'        => $request->status,
                'location'      => $request->location,
                'delivery_date' => $request->delivery_date,
                'delivery_time' => $request->delivery_time,
                'updated_at'    => now(),
            ]);

        return redirect('/admin/schedules')->with('success', 'Status alur produksi dapur katering berhasil diperbarui!');
    }
}