<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // <-- PASTIKAN BARIS INI ADA!

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('login'); // Mencari file: resources/views/login.blade.php
    }

    /**
     * Memproses permintaan login.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Logic login dengan Auth::attempt
        if (Auth::attempt($request->only('email', 'password'))) {
            // Login berhasil
            $request->session()->regenerate();

            // Diarahkan ke /posts (atau sesuai intended URL)
            return redirect()->intended('/posts'); 
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Memproses permintaan logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}