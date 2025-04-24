<?php

namespace App\Http\Controllers; // Mendaftarkan namespace controller ini

use Illuminate\Http\Request; // untuk menangani dari form
use Illuminate\Support\Facades\Auth; // untuk proses authentikasi
use App\Models\User; // model untuk akses data pengguna
use Illuminate\Support\Facades\Hash; // untuk mengenkripsi password

// membuat class AuthController yang mewarisi dari Controller
class AuthController extends Controller
{
    // menampilkan halaman form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // fungsi untuk menangani pendaftaran pengguna baru
    public function register(Request $request)
    {
        // validasi data inputan user
        $request->validate([
            'name' => 'required|string|max:255', // harus diisi, berupa string
            'email' => 'required|string|email|max:255|unique:users', // harus format email agar unik
            'password' => 'required|string|confirmed|min:6', // harus minimal 5 karakter dan = password_confirmation
        ]);

        // menyimpan user ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password di-hash agar aman
            'role' => 'user', // Default role
        ]);

        // redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    // menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Fungsi untuk proses login pengguna
    public function login(Request $request)
    {
        // validasi input email dan password.
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // jika authentikasi berhasil, coba login dengan kredensial
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // session baru dibuat
            return redirect()->route('users.profile'); // Redirect ke route profile
        }

        // jika gagal login, kembali ke halaman login, tampilkan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // logout  user
    public function logout(Request $request)
    {
        Auth::logout(); // logout user

        // invalidate dan regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect ke halaman login
        return redirect()->route('login');
    }
}
