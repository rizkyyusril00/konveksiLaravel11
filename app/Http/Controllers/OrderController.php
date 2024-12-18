<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    //crud logic
    // Load all order with search and filter
    public function loadAllOrder(Request $request)
    {
        // Get search and filter parameters
        $search = $request->query('search');
        $filter = $request->query('filter');
        $orderBy = $request->query('orderBy', 'created_at'); // Default ke 'customer'
        $direction = $request->query('direction', 'desc'); // Default ke 'asc'


        // Query Pakaian with search and filter
        $query = Order::query();

        if ($search) {
            $query->where('customer', 'LIKE', "%{$search}%");
        }
        if ($filter) {
            $query->where('status', $filter);
        }
        $filterOptions = Order::select('status')->distinct()->pluck('status');


        // Custom sorting for 'tanggal_selesai' to prioritize closest to today
        if ($orderBy === 'tanggal_selesai') {
            $query->orderByRaw("ABS(DATEDIFF(tanggal_selesai, CURDATE())) $direction");
        } else {
            // Default sorting
            $query->orderBy($orderBy, $direction);
        }

        // Paginate the results and append query parameters
        $orders = $query->paginate(10)->appends(request()->query());
        // $pakaians->appends('search' => $search);

        // Pass filter options to view (for dropdown)
        // $filterOptions = Pakaian::select('pekerjaan')->distinct()->pluck('pekerjaan');

        return view('Order.order', compact('orders', 'search', 'filter', 'filterOptions'));
    }

    public function loadAllOrderForm()
    {
        // Ambil data penjahit dan pemotong
        $penjahits = Karyawan::where('pekerjaan', 'Penjahit')->get();
        $pemotongs = Karyawan::where('pekerjaan', 'Pemotong')->get();
        return view('Order.addOrder', compact('penjahits', 'pemotongs'));
    }
    public function AddOrder(Request $request)
    {
        // form validate
        $request->validate([
            'customer' => 'required|string',
            'admin' => 'required|string',
            'tanggal_order' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_order',
            'jenis_pakaian' => 'required|string',
            'bahan_utama' => 'required|string',
            'bahan_tambahan' => 'nullable|string',
            'jenis_kancing' => 'required|string',
            'penjahit_id' => 'required|exists:karyawans,id',
            'pemotong_id' => 'required|exists:karyawans,id',
            'size' => 'required|string',
            'jumlah_potong' => 'required|string',
            'harga_satuan' => 'required|string',
            'status' => 'required|string',
            'image_order' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
        ]);
        // add pakaian
        try {
            $order = new Order();
            $order->customer = $request->customer;
            $order->admin = $request->admin;
            $order->tanggal_order = $request->tanggal_order;
            $order->tanggal_selesai = $request->tanggal_selesai;
            $order->jenis_pakaian = $request->jenis_pakaian;
            $order->bahan_utama = $request->bahan_utama;
            $order->bahan_tambahan = $request->bahan_tambahan ?: null;
            $order->jenis_kancing = $request->jenis_kancing;
            $order->penjahit_id = $request->penjahit_id;
            $order->pemotong_id = $request->pemotong_id;
            $order->size = $request->size;
            $order->jumlah_potong = $request->jumlah_potong;
            $order->harga_satuan = $request->harga_satuan;
            $order->status = $request->status;

            // Proses upload gambar
            if ($request->hasFile('image_order')) {
                $file = $request->file('image_order');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/orders', $filename, 'public'); // Simpan di storage/public/uploads/orders
                $order->image_order = $path; // Simpan path ke database
            }

            $order->save();
            return redirect('/')->with('success', 'Order berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/order')->with('error', $e->getMessage());
        }
    }

    public function EditOrder(Request $request)
    {
        // Validasi form
        $request->validate([
            'customer' => 'sometimes|required|string',
            'admin' => 'sometimes|required|string',
            'tanggal_order' => 'sometimes|required|date',
            'tanggal_selesai' => 'sometimes|required|date|after_or_equal:tanggal_order',
            'jenis_pakaian' => 'sometimes|required|string',
            'bahan_utama' => 'sometimes|required|string',
            'bahan_tambahan' => 'sometimes|nullable|string',
            'jenis_kancing' => 'sometimes|required|string',
            'penjahit_id' => 'sometimes|required|exists:karyawans,id',
            'pemotong_id' => 'sometimes|required|exists:karyawans,id',
            'size' => 'sometimes|required|string',
            'jumlah_potong' => 'sometimes|required|string',
            'harga_satuan' => 'sometimes|required|string',
            'status' => 'sometimes|required|string',
            'image_order' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        // Ambil data order berdasarkan ID
        $order = Order::findOrFail($request->order_id);

        try {
            // Update atribut lainnya kecuali gambar
            $order->update($request->except(['image_order']));

            // Proses file gambar jika ada file yang diunggah
            if ($request->hasFile('image_order')) {
                // Hapus gambar lama dari storage jika ada
                if ($order->image_order) {
                    Storage::disk('public')->delete($order->image_order);
                }

                // Simpan gambar baru
                $file = $request->file('image_order');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/orders', $filename, 'public');

                // Update path gambar di database
                $order->image_order = $path;
                $order->save();
            }

            // Redirect dengan pesan sukses
            return redirect('/')->with('success', "Order dari {$order->customer} berhasil diperbarui!");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }


    public function loadEditForm($id)
    {
        $order = Order::find($id);
        // Ambil data penjahit dan pemotong
        $penjahits = Karyawan::where('pekerjaan', 'Penjahit')->get();
        $pemotongs = Karyawan::where('pekerjaan', 'Pemotong')->get();
        return view('Order.editOrder', compact('order', 'penjahits', 'pemotongs'));
    }

    public function deleteOrder($id)
    {
        try {
            $order = Order::findOrFail($id);

            // Hapus file gambar dari storage jika ada
            if ($order->image_order) {
                Storage::disk('public')->delete($order->image_order);
            }

            // Hapus data order
            $order->delete();

            return redirect('/')->with('success', 'Order Deleted Successfully');
        } catch (\Exception $e) {
            return redirect('/')->with('fail', 'Failed to delete order: ' . $e->getMessage());
        }
    }
}
