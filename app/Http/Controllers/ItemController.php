<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    ///crud logic
    // Load all Supplier with search and filter
    public function loadAllItem(Request $request)
    {
        // Get search and filter parameters
        $search = $request->query('search');
        $filter = $request->query('filter');


        // Query Pakaian with search and filter
        $query = Item::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        if ($filter) {
            $query->where('tipe', $filter);
        }
        $filterOptions = Item::select('tipe')->distinct()->pluck('tipe');


        // Paginate the results and append query parameters
        $items = $query->paginate(10);

        return view('Item.item', compact('items', 'search', 'filter', 'filterOptions'));
    }

    public function loadAllItemForm()
    {
        return view('Item.addItem');
    }

    public function AddItem(Request $request)
    {

        $message = [
            'tipe.required' => 'Tipe harus diisi',
            'name.required' => 'Nama Item harus diisi',
            'sisa.required' => 'Sisa harus diisi',
        ];

        // form validate
        $request->validate([
            'tipe' => 'required|string',
            'name' => 'required|string',
            'sisa' => 'required|string',
        ], $message);
        // add supplier
        try {
            $supplier = new Item();
            $supplier->tipe = $request->tipe;
            $supplier->name = $request->name;
            $supplier->sisa = $request->sisa;
            // dd(request()->all());

            $supplier->save();
            return redirect('/item')->with('success', 'Item berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/item')->with('error', $e->getMessage());
        }
    }

    public function EditItem(Request $request)
    {
        // form validate
        $request->validate([
            'tipe' => 'sometimes|string',
            'name' => 'sometimes|string',
            'sisa' => 'sometimes|string',
        ]);

        // ambil data
        $item = Item::findOrFail($request->item_id);

        try {
            // Ambil data hanya dari field yang dikirimkan
            $data = $request->only([
                'tipe',
                'name',
                'sisa',
            ]);

            // Hanya lakukan update untuk field yang diberikan
            $item->update(array_filter($data));

            // Reload data item untuk mendapatkan data yang baru diupdate
            $item->refresh();

            // Redirect dengan pesan sukses dan data terbaru
            return redirect('/item')->with('success', "{$item->name} berhasil diperbarui!");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }

    public function loadEditForm($id)
    {
        $item = Item::find($id);
        return view('Item.editItem', compact('item'));
    }

    public function deleteItem($id)
    {
        try {
            Item::where('id', $id)->delete();
            return redirect('/item')->with('success', 'Item Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/item')->with('fail', $e->getMessage());
        }
    }
}
