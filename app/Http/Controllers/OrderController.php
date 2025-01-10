<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
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
            // Cari berdasarkan nama customer melalui relasi
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
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
        // ambil data customer
        $customers = Customer::all();
        return view('Order.addOrder', compact('penjahits', 'pemotongs', 'customers'));
    }
    public function AddOrder(Request $request)
    {

        $message = [
            'customer_id.required' => 'Customer Tidak Boleh Kosong',
            'admin.required' => 'Admin Tidak Boleh Kosong',
            'tanggal_order.required' => 'Tanggal Order Tidak Boleh Kosong',
            'tanggal_selesai.required' => 'Tanggal Selesai Tidak Boleh Kosong',
            'jenis_pakaian.required' => 'Jenis Pakaian Tidak Boleh Kosong',
            'bahan_utama.required' => 'Bahan Utama Tidak Boleh Kosong',
            'bahan_tambahan.required' => 'Bahan Tambahan Tidak Boleh Kosong',
            'jenis_kancing.required' => 'Jenis Kancing Tidak Boleh Kosong',
            'penjahit_id.required' => 'Penjahit Tidak Boleh Kosong',
            'pemotong_id.required' => 'Pemotong Tidak Boleh Kosong',
            'items.required' => 'Item Tidak Boleh Kosong',
            'status.required' => 'Status Tidak Boleh Kosong',
            'note.max' => 'Catatan Yang Ditulis Terlalu Banyak',
            'image_order.image' => 'Format Gambar Harus JPEG, PNG, atau JPG',
            'image_order.max' => 'Ukuran Gambar Terlalu Besar Max 1 MB',
        ];

        // Validasi form
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'admin' => 'required|string',
            'tanggal_order' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_order',
            'jenis_pakaian' => 'required|string',
            'bahan_utama' => 'required|string',
            'bahan_tambahan' => 'nullable|string',
            'jenis_kancing' => 'required|string',
            'penjahit_id' => 'required|exists:karyawans,id',
            'pemotong_id' => 'required|exists:karyawans,id',
            'items' => 'required|array',
            'status' => 'required|string',
            'diskon' => 'nullable|numeric',
            'pajak' => 'nullable|numeric',
            'note' => 'nullable|string|max:225',
            'image_order' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
        ], $message);

        try {
            $order = new Order();
            $order->customer_id = $request->customer_id;
            $order->admin = $request->admin;
            $order->tanggal_order = $request->tanggal_order;
            $order->tanggal_selesai = $request->tanggal_selesai;
            $order->jenis_pakaian = $request->jenis_pakaian;
            $order->bahan_utama = $request->bahan_utama;
            $order->bahan_tambahan = $request->bahan_tambahan ?: null;
            $order->jenis_kancing = $request->jenis_kancing;
            $order->penjahit_id = $request->penjahit_id;
            $order->pemotong_id = $request->pemotong_id;
            $order->items = $request->items;
            $order->status = $request->status;
            $order->diskon = $request->diskon ?: null;
            $order->pajak = $request->pajak ?: null;
            $order->note = $request->note ?: null;

            // Proses upload gambar
            if ($request->hasFile('image_order')) {
                $file = $request->file('image_order');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/orders', $filename, 'public'); // Simpan di storage/public/uploads/orders
                $order->image_order = $path; // Simpan path ke database
            }

            // dd(request()->all());
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
            'customer_id' => 'sometimes|required|exists:customers,id',
            'admin' => 'sometimes|required|string',
            'tanggal_order' => 'sometimes|required|date',
            'tanggal_selesai' => 'sometimes|required|date|after_or_equal:tanggal_order',
            'jenis_pakaian' => 'sometimes|required|string',
            'bahan_utama' => 'sometimes|required|string',
            'bahan_tambahan' => 'sometimes|nullable|string',
            'jenis_kancing' => 'sometimes|required|string',
            'penjahit_id' => 'sometimes|required|exists:karyawans,id',
            'pemotong_id' => 'sometimes|required|exists:karyawans,id',
            'items' => 'sometimes|required|array',
            'status' => 'sometimes|required|string',
            'note' => 'sometimes|nullable|string|max:225',
            'diskon' => 'sometimes|nullable|numeric',
            'pajak' => 'sometimes|nullable|numeric',
            'image_order' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:1048',  // Validasi untuk gambar
        ]);

        // Ambil data order berdasarkan ID
        $order = Order::findOrFail($request->order_id); // Pastikan order_id ada di request

        try {
            // Update atribut lainnya kecuali image_order, size, dan jumlah_potong
            $order->update($request->except(['image_order', 'size'])); // Update tanpa size dan jumlah_potong

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
                $order->save();  // Simpan kembali perubahan gambar
            }

            // dd(request()->all());
            // Redirect dengan pesan sukses
            return redirect('/')->with('success', "Order dari {$order->customer->name} berhasil diperbarui!");
        } catch (\Exception $e) {
            // Tangkap error lainnya dan kirimkan pesan kesalahan
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }

    public function loadEditForm($id)
    {
        $order = Order::findOrFail($id);

        // Ambil data penjahit dan pemotong
        $penjahits = Karyawan::where('pekerjaan', 'Penjahit')->get();
        $pemotongs = Karyawan::where('pekerjaan', 'Pemotong')->get();

        // ambil data customer
        $customers = Customer::all();
        // dd($order->size, $order->jumlah_potong); // Cek data size dan jumlah_potong

        return view('Order.editOrder', compact('order', 'penjahits', 'pemotongs', 'customers'));
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);

        // Ambil data penjahit dan pemotong
        $penjahits = Karyawan::where('pekerjaan', 'Penjahit')->get();
        $pemotongs = Karyawan::where('pekerjaan', 'Pemotong')->get();

        // ambil data customer
        $customers = Customer::all();
        // dd($order->size, $order->jumlah_potong); // Cek data size dan jumlah_potong

        return view('Invoice.invoice', compact('order', 'penjahits', 'pemotongs', 'customers'));
    }
    public function po($id)
    {
        $order = Order::findOrFail($id);

        // Ambil data penjahit dan pemotong
        $penjahits = Karyawan::where('pekerjaan', 'Penjahit')->get();
        $pemotongs = Karyawan::where('pekerjaan', 'Pemotong')->get();

        // ambil data customer
        $customers = Customer::all();

        // menghitung jumlah qty
        $totalQuantity = collect($order->items)->sum('quantity');
        // dd($order->size, $order->jumlah_potong); // Cek data size dan jumlah_potong

        return view('Invoice.po', compact('order', 'penjahits', 'pemotongs',  'customers', 'totalQuantity'));
    }

    public function deleteOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            // Hapus gambar dari storage jika ada
            if ($order->image_order) {
                Storage::disk('public')->delete($order->image_order);
            }
            $order->delete();
            return redirect('/')->with('success', 'Order Deleted Successfully');
        } catch (\Exception $e) {
            return redirect('/')->with('fail', 'Failed to delete order: ' . $e->getMessage());
        }
    }
}
