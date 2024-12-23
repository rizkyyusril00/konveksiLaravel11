<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //crud logic
    // Load all user with search and filter
    public function loadAllUser(Request $request)
    {
        // Get search and filter parameters
        $search = $request->query('search');

        // Query Pakaian with search and filter
        $query = User::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }


        // Paginate the results and append query parameters
        $users = $query->paginate(10);
        // $users->appends('search' => $search);

        // Pass filter options to view (for dropdown)
        // $filterOptions = Pakaian::select('pekerjaan')->distinct()->pluck('pekerjaan');

        return view('Admin.admin', compact('users', 'search'));
    }
    public function loadAllUserForm()
    {
        return view('Admin.addAdmin');
    }
    public function AddUser(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'role' => 'nullable|string',
        ]);
        // add user
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role ?: null;
            $user->save();
            return redirect('/user')->with('success', 'user berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('error', $e->getMessage());
        }
    }

    public function EditUser(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'role' => 'sometimes|string',
        ]);

        // Ambil data user berdasarkan user_id
        $user = User::findOrFail($request->user_id);

        try {
            // Edit data
            $user->update($request->only(['name', 'email', 'role']));

            // Reload data user untuk mendapatkan data yang baru diupdate
            $user->refresh();

            // Redirect dengan pesan sukses
            return redirect('/user')->with('success', "Data pengguna {$user->name} berhasil diperbarui!");
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error duplicate entry
            if ($e->errorInfo[1] == 1062) {
                return back()->with('fail', "Email sudah digunakan oleh pengguna lain.");
            }
            return back()->with('fail', "Terjadi kesalahan pada database.");
        } catch (\Exception $e) {
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }


    public function loadEditForm($id)
    {
        $user = User::find($id);
        return view('Admin.editAdmin', compact('user'));
    }

    public function deleteUser($id)
    {
        try {
            User::where('id', $id)->delete();
            return redirect('/user')->with('success', 'User Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/user')->with('fail', $e->getMessage());
        }
    }
}
