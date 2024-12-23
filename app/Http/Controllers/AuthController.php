<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth');
    }

    //versi tanpa intended url
    // public function verify(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     $data = $request->all();

    //     if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'admin'])) {
    //         $request->session()->regenerate();
    //         return redirect('/');
    //     } elseif (Auth::guard('user')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'user'])) {
    //         $request->session()->regenerate();
    //         return redirect('/');
    //     } else {
    //         return redirect()->back()->with('error', 'Email atau Password Salah!');
    //     }
    // }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = $request->all();

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'admin'])) {
            $request->session()->regenerate();

            // Periksa jika ini login pertama kali
            if (!$request->session()->has('has_logged_in')) {
                $request->session()->put('has_logged_in', true); // Tandai sebagai sudah login
                return redirect('/'); // Paksa ke halaman utama
            }

            return redirect()->intended('/'); // Jika sudah login sebelumnya
        } elseif (Auth::guard('user')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'user'])) {
            $request->session()->regenerate();

            // Periksa jika ini login pertama kali
            if (!$request->session()->has('has_logged_in')) {
                $request->session()->put('has_logged_in', true); // Tandai sebagai sudah login
                return redirect('/'); // Paksa ke halaman utama
            }

            return redirect()->intended('/'); // Jika sudah login sebelumnya
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah!');
        }
    }


    public function logout(): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        return redirect('/auth');
    }
}
