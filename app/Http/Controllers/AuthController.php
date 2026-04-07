<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form register
    public function registerForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            // unique:users artinya email tidak boleh sama dengan yang sudah ada di tabel users
            'password' => 'required|min:6|confirmed',
            // confirmed artinya harus ada field password_confirmation yang sama
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            // bcrypt() untuk enkripsi password
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        return redirect('/todos');
    }

    // Tampilkan form login
    public function loginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek email & password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Kalau berhasil, redirect ke todos
            return redirect('/todos');
        }

        // Kalau gagal, kembali ke login dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}