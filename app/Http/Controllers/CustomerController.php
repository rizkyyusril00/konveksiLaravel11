<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //crud logic
    // Load all Customer with search and filter
    public function loadAllCustomer(Request $request)
    {
        // Get search and filter parameters
        $search = $request->query('search');

        // Query Customer with search and filter
        $query = Customer::query();

        // Apply search filter
        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Get customers with order count and paginate the results
        $customers = $query->withCount('orders')->paginate(10);

        // Return view with customers data and search query
        return view('Customer.customer', compact('customers', 'search'));
    }


    public function loadAllCustomerForm()
    {
        return view('Customer.addCustomer');
    }

    public function AddCustomer(Request $request)
    {

        $message = [
            'name.required' => 'Nama harus diisi',
            'no_hp.required' => 'Nomor HP harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
        ];

        // Form validation with unique email
        $request->validate([
            'name' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|email|unique:customers,email', // Add the unique validation for email
        ]);

        // Add customer
        try {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->no_hp = $request->no_hp;
            $customer->email = $request->email;
            $customer->save();

            return redirect('/customer')->with('success', 'Customer berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/add/customer')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function EditCustomer(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'sometimes|string',
            'no_hp' => 'sometimes|string',
            'email' => 'sometimes|email|unique:customers,email,' . $request->customer_id, // Add exception for the current customer
        ]);

        // ambil data
        $customer = Customer::findOrFail($request->customer_id);

        try {
            // Ambil data hanya dari field yang dikirimkan
            $data = $request->only([
                'name',
                'no_hp',
                'email',
            ]);

            // Hanya lakukan update untuk field yang diberikan
            $customer->update(array_filter($data));

            // Reload data customer untuk mendapatkan data yang baru diupdate
            $customer->refresh();

            // Redirect dengan pesan sukses dan data terbaru
            return redirect('/customer')->with('success', "{$customer->name} berhasil diperbarui!");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }


    public function loadEditForm($id)
    {
        $customer = Customer::find($id);
        return view('Customer.editCustomer', compact('customer'));
    }

    public function deleteCustomer($id)
    {
        try {
            Customer::where('id', $id)->delete();
            return redirect('/customer')->with('success', 'Customer Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/customer')->with('fail', $e->getMessage());
        }
    }
}
