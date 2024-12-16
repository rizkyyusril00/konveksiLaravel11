<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use Illuminate\Http\Request;

class PakaianController extends Controller
{
    //crud logic
    // Load all pakaian with search and filter
    public function loadAllPakaian(Request $request)
    {
        // Get search and filter parameters
        $search = $request->query('search');

        // Query Pakaian with search and filter
        $query = Pakaian::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }


        // Paginate the results and append query parameters
        $pakaians = $query->paginate(2);
        // $pakaians->appends('search' => $search);

        // Pass filter options to view (for dropdown)
        // $filterOptions = Pakaian::select('pekerjaan')->distinct()->pluck('pekerjaan');

        return view('Pakaian.pakaian', compact('pakaians', 'search'));
    }
    public function loadAllPakaianForm()
    {
        return view('Pakaian.addPakaian');
    }
    public function AddPakaian(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'required|string',
        ]);
        // add pakaian
        try {
            $karyawan = new Pakaian();
            $karyawan->name = $request->name;
            $karyawan->save();
            return redirect('/pakaian')->with('success', 'Pakaian berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/pakaian')->with('error', $e->getMessage());
        }
    }

    public function EditPakaian(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'required|string',
        ]);
        // ambil data
        $pakaian = Pakaian::findOrFail($request->pakaian_id);

        try {
            // edit data
            $pakaian->update([
                'name' => $request->name,
            ]);

            // Reload data karyawan untuk mendapatkan data yang baru diupdate
            $pakaian->refresh();

            // Redirect dengan pesan sukses dan data terbaru
            return redirect('/pakaian')->with('success', "{$pakaian->name} berhasil diperbarui!");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }
    public function loadEditForm($id)
    {
        $pakaian = Pakaian::find($id);
        return view('Pakaian.editPakaian', compact('pakaian'));
    }

    public function deletePakaian($id)
    {
        try {
            Pakaian::where('id', $id)->delete();
            return redirect('/pakaian')->with('success', 'Jenis Pakain Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/pakaian')->with('fail', $e->getMessage());
        }
    }
}
