<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    //crud logic
    // Load all karyawan with search and filter
    public function loadAllKaryawan(Request $request)
    {
        // Get search and filter parameters
        $search = $request->query('search');
        $filter = $request->query('filter');

        // Query karyawans with search and filter
        $query = Karyawan::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        if ($filter) {
            $query->where('pekerjaan', $filter);
        }

        // Paginate the results and append query parameters
        $karyawans = $query->paginate(2);
        $karyawans->appends(['search' => $search, 'filter' => $filter]);

        // Pass filter options to view (for dropdown)
        $filterOptions = Karyawan::select('pekerjaan')->distinct()->pluck('pekerjaan');

        return view('home', compact('karyawans', 'filterOptions', 'search', 'filter'));
    }

    public function loadAllKaryawanForm()
    {
        return view('addKaryawan');
    }
    public function AddKaryawan(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);
        // add user
        try {
            $karyawan = new Karyawan();
            $karyawan->name = $request->name;
            $karyawan->pekerjaan = $request->pekerjaan;
            $karyawan->save();
            return redirect('/karyawan')->with('success', 'Karyawan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/karyawan')->with('error', $e->getMessage());
        }
    }

    public function EditKaryawan(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'sometimes|required|string',
            'pekerjaan' => 'sometimes|required|string',
        ]);
        // ambil data
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        try {
            // edit data
            $karyawan->update($request->only([
                'name',
                'pekerjaan'
            ]));

            // Reload data karyawan untuk mendapatkan data yang baru diupdate
            $karyawan->refresh();

            // Redirect dengan pesan sukses dan data terbaru
            return redirect('/karyawan')->with('success', "Data pengguna {$karyawan->name} berhasil diperbarui!");
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error duplicate entry
            if ($e->errorInfo[1] == 1062) {
                return back()->with('fail', "Email sudah digunakan oleh pengguna lain.");
            }
            // Default error handling untuk QueryException
            return back()->with('fail', "Terjadi kesalahan pada database.");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }

    public function loadEditForm($id)
    {
        $karyawan = Karyawan::find($id);
        return view('editKaryawan', compact('karyawan'));
    }

    public function deleteKaryawan($id)
    {
        try {
            Karyawan::where('id', $id)->delete();
            return redirect('/karyawan')->with('success', 'User Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/karyawan')->with('fail', $e->getMessage());
        }
    }
}
