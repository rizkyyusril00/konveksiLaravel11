<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    //crud logic
    // Load all pemeblian with search and filter
    public function loadAllPembelian(Request $request)
    {
        // Get search and filter parameters
        $search = $request->query('search');

        // Query Pakaian with search and filter
        $query = Pembelian::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }


        // Paginate the results and append query parameters
        $pembelians = $query->paginate(10);

        return view('Pembelian.pembelian', compact('pembelians', 'search'));
    }

    public function loadAllPembelianForm()
    {
        return view('Pembelian.addPembelian');
    }

    public function AddPembelian(Request $request)
    {

        $message = [
            'invoice.required' => 'Invoice harus diisi',
            'name_supplier.required' => 'Nama supplier harus diisi',
            'name.required' => 'Nama barang harus diisi',
            'name.unique' => 'Nama barang sudah terdaftar',
            'tanggal_pembelian.required' => 'Tanggal pembelian harus diisi',
            'tanggal_tempo.required' => 'Tanggal tempo harus diisi',
            'jumlah.required' => 'Jumlah barang harus diisi',
            'bayar.required' => 'Bayar harus diisi',
            'status.required' => 'Status harus diisi',
        ];

        // form validate
        $request->validate([
            'invoice' => 'required|string',
            'name_supplier' => 'required|string',
            'name' => 'required|string|unique:pembelians,name',
            'tanggal_pembelian' => 'required|date',
            'tanggal_tempo' => 'required|date|after_or_equal:tanggal_pembelian',
            'jumlah' => 'required|string',
            'bayar' => 'required|string',
            'hutang' => 'nullable|string',
            'status' => 'required|string',
        ], $message);
        // add pembelian
        try {
            $pembelian = new Pembelian();
            $pembelian->invoice = $request->invoice;
            $pembelian->name_supplier = $request->name_supplier;
            $pembelian->name = $request->name;
            $pembelian->tanggal_pembelian = $request->tanggal_pembelian;
            $pembelian->tanggal_tempo = $request->tanggal_tempo;
            $pembelian->jumlah = $request->jumlah;
            $pembelian->bayar = $request->bayar;
            $pembelian->hutang = $request->hutang;
            $pembelian->status = $request->status;
            $pembelian->save();
            return redirect('/pembelian')->with('success', 'Pembelian berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/pembelian')->with('error', $e->getMessage());
        }
    }

    public function EditPembelian(Request $request)
    {
        $message = [
            'name.unique' => 'Nama barang sudah terdaftar',
        ];
        // form validate
        $request->validate([
            'invoice' => 'sometimes|string',
            'name_supplier' => 'sometimes|string',
            'name' => 'sometimes|string|unique:pembelians,name,' . $request->pembelian_id,
            'tanggal_pembelian' => 'sometimes|date',
            'tanggal_tempo' => 'sometimes|date|after_or_equal:tanggal_pembelian',
            'jumlah' => 'sometimes|string',
            'bayar' => 'sometimes|string',
            'hutang' => 'nullable|sometimes|string',
            'status' => 'sometimes|string',
        ], $message);

        // ambil data
        $pembelian = Pembelian::findOrFail($request->pembelian_id);

        try {
            // Ambil data hanya dari field yang dikirimkan
            $data = $request->only([
                'invoice',
                'name_supplier',
                'name',
                'tanggal_pembelian',
                'tanggal_tempo',
                'jumlah',
                'bayar',
                'hutang',
                'status',
            ]);

            // Hanya lakukan update untuk field yang diberikan
            $pembelian->update(array_filter($data));

            // Reload data pembelian untuk mendapatkan data yang baru diupdate
            $pembelian->refresh();

            // Redirect dengan pesan sukses dan data terbaru
            return redirect('/pembelian')->with('success', "{$pembelian->name} berhasil diperbarui!");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }

    public function loadEditForm($id)
    {
        $pembelian = Pembelian::find($id);
        return view('Pembelian.editPembelian', compact('pembelian'));
    }

    public function deletePembelian($id)
    {
        try {
            Pembelian::where('id', $id)->delete();
            return redirect('/pembelian')->with('success', 'Pembelian Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/pembelian')->with('fail', $e->getMessage());
        }
    }
}
