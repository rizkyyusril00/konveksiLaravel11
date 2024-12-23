<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //crud logic
    // Load all Supplier with search and filter
    public function loadAllSupplier(Request $request)
    {
        // Get search and filter parameters
        $search = $request->query('search');

        // Query Pakaian with search and filter
        $query = Supplier::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }


        // Paginate the results and append query parameters
        $suppliers = $query->paginate(10);

        return view('Supplier.supplier', compact('suppliers', 'search'));
    }

    public function loadAllSupplierForm()
    {
        return view('Supplier.addSupplier');
    }

    public function AddSupplier(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'bahan_utama' => 'required|string',
            'bahan_tambahan' => 'nullable|string',
            'jenis_kancing' => 'required|string',
            'jenis_sleting' => 'required|string',
        ]);
        // add supplier
        try {
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->no_hp = $request->no_hp;
            $supplier->alamat = $request->alamat;
            $supplier->email = $request->email;
            $supplier->bahan_utama = $request->bahan_utama;
            $supplier->bahan_tambahan = $request->bahan_tambahan ?: null;
            $supplier->jenis_kancing = $request->jenis_kancing;
            $supplier->jenis_sleting = $request->jenis_sleting;
            $supplier->save();
            return redirect('/supplier')->with('success', 'Supplier berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/supplier')->with('error', $e->getMessage());
        }
    }

    public function EditSupplier(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'sometimes|string',
            'no_hp' => 'sometimes|string',
            'alamat' => 'sometimes|string',
            'email' => 'sometimes|email',
            'bahan_utama' => 'sometimes|string',
            'bahan_tambahan' => 'sometimes|nullable|string',
            'jenis_kancing' => 'sometimes|string',
            'jenis_sleting' => 'sometimes|string',
        ]);

        // ambil data
        $supplier = Supplier::findOrFail($request->supplier_id);

        try {
            // Ambil data hanya dari field yang dikirimkan
            $data = $request->only([
                'name',
                'no_hp',
                'alamat',
                'email',
                'bahan_utama',
                'bahan_tambahan',
                'jenis_kancing',
                'jenis_sleting'
            ]);

            // Hanya lakukan update untuk field yang diberikan
            $supplier->update(array_filter($data));

            // Reload data supplier untuk mendapatkan data yang baru diupdate
            $supplier->refresh();

            // Redirect dengan pesan sukses dan data terbaru
            return redirect('/supplier')->with('success', "{$supplier->name} berhasil diperbarui!");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }

    public function loadEditForm($id)
    {
        $supplier = Supplier::find($id);
        return view('Supplier.editSupplier', compact('supplier'));
    }

    public function deleteSupplier($id)
    {
        try {
            Supplier::where('id', $id)->delete();
            return redirect('/supplier')->with('success', 'Jenis Pakain Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/supplier')->with('fail', $e->getMessage());
        }
    }
}
