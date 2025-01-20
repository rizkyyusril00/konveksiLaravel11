<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Order;

class KaryawanController extends Controller
{
    //crud logic
    // Load all karyawan with search and filter
    public function loadAllKaryawan(Request $request)
    {
        // Ambil parameter filter dan bulan dari request
        $search = $request->query('search');
        $filter = $request->query('filter');
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        // Validasi bulan dan tahun
        if (($bulan && !$tahun) || (!$bulan && $tahun)) {
            return redirect()->back()->with('error', 'Bulan dan Tahun harus diisi keduanya.');
        }

        // Query karyawan dengan pencarian dan filter pekerjaan
        $query = Karyawan::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        if ($filter) {
            $query->where('pekerjaan', $filter);
        }

        // Ambil karyawan yang sudah difilter dengan pagination
        $karyawans = $query->paginate(10);

        // Hitung total order untuk setiap karyawan dengan filter bulan dan tahun jika ada
        foreach ($karyawans as $karyawan) {
            $karyawan->total_order = $karyawan->totalOrder($bulan, $tahun);
        }

        // Tambahkan parameter ke pagination link
        $karyawans->appends($request->only(['search', 'filter', 'bulan', 'tahun']));

        // Filter pekerjaan dan tahun dari database
        $filterOptions = Karyawan::select('pekerjaan')->distinct()->pluck('pekerjaan');
        $years = Order::selectRaw('YEAR(tanggal_order) as tahun')->distinct()->pluck('tahun');

        // Return ke view
        return view('home', compact('karyawans', 'filterOptions', 'search', 'filter', 'bulan', 'tahun', 'years'));
    }


    public function loadAllKaryawanForm()
    {
        return view('addKaryawan');
    }
    public function AddKaryawan(Request $request)
    {

        $message = [
            'name.required' => 'Nama karyawan harus diisi.',
            'pekerjaan.required' => 'Pekerjaan karyawan harus diisi.',
            'upah.required' => 'Upah karyawan harus diisi.',
        ];

        // form validate
        $request->validate([
            'name' => 'required|string',
            'pekerjaan' => 'required|string',
            'upah' => 'required|string',
        ], $message);
        // add user
        try {
            $karyawan = new Karyawan();
            $karyawan->name = $request->name;
            $karyawan->pekerjaan = $request->pekerjaan;
            $karyawan->upah = $request->upah;
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
            'upah' => 'sometimes|required|string',
        ]);
        // ambil data
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        try {
            // edit data
            $karyawan->update($request->only([
                'name',
                'pekerjaan',
                'upah',
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
