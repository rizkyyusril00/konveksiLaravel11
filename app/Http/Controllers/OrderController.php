<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
        return view('Order.addOrder');
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
            'penjahit' => 'required|string',
            'pemotong' => 'required|string',
            'size' => 'required|string',
            'jumlah_potong' => 'required|string',
            'harga_satuan' => 'required|string',
            'status' => 'required|string',
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
            $order->penjahit = $request->penjahit;
            $order->pemotong = $request->pemotong;
            $order->size = $request->size;
            $order->jumlah_potong = $request->jumlah_potong;
            $order->harga_satuan = $request->harga_satuan;
            $order->status = $request->status;
            $order->save();
            return redirect('/order')->with('success', 'Order berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/order')->with('error', $e->getMessage());
        }
    }

    public function EditOrder(Request $request)
    {
        // form validate
        $request->validate([
            'customer' => 'sometimes|required|string',
            'admin' => 'sometimes|required|string',
            'tanggal_order' => 'sometimes|required|date',
            'tanggal_selesai' => 'sometimes|required|date|after_or_equal:tanggal_order',
            'jenis_pakaian' => 'sometimes|required|string',
            'bahan_utama' => 'sometimes|required|string',
            'bahan_tambahan' => 'sometimes|nullable|string',
            'jenis_kancing' => 'sometimes|required|string',
            'penjahit' => 'sometimes|required|string',
            'pemotong' => 'sometimes|required|string',
            'size' => 'sometimes|required|string',
            'jumlah_potong' => 'sometimes|required|string',
            'harga_satuan' => 'sometimes|required|string',
            'status' => 'sometimes|required|string',
        ]);
        // ambil data
        $order = Order::findOrFail($request->order_id);

        try {
            // edit data 
            $order->update($request->only([
                'customer',
                'admin',
                'tanggal_order',
                'tanggal_selesai',
                'jenis_pakaian',
                'bahan_utama',
                'bahan_tambahan',
                'jenis_kancing',
                'penjahit',
                'pemotong',
                'size',
                'jumlah_potong',
                'harga_satuan',
                'status'
            ]));

            // Reload data order untuk mendapatkan data yang baru diupdate
            $order->refresh();

            // Redirect dengan pesan sukses dan data terbaru
            return redirect('/order')->with('success', "order dari {$order->customer} berhasil diperbarui!");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }

    public function loadEditForm($id)
    {
        $order = Order::find($id);
        return view('Order.editOrder', compact('order'));
    }

    public function deleteOrder($id)
    {
        try {
            Order::where('id', $id)->delete();
            return redirect('/order')->with('success', 'Order Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/order')->with('fail', $e->getMessage());
        }
    }
}
