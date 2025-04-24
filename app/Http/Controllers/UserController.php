<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // tampilkan daftar semua user (Admin)
    public function index()
    {
        // ambil semua data user, diurutkan dari yang terbaru
        $users = User::latest()->get();

        // tampilkan ke view users.index
        return view('users.index', compact('users'));
    }

    // form edit user (Admin)
    public function edit(User $user)
    {
        // tampilkan view edit user dengan data user yang dipilih
        return view('users.edit', compact('user'));
    }

    // proses update user (Admin)
    public function update(Request $request, User $user)
    {
        // validasi inputan
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:admin,user', // role hanya boleh admin atau user
        ]);

        // update data user (hanya name, email, role)
        $user->update($request->only('name', 'email', 'role'));

        // redirect kembali ke index user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    // delete user (Admin)
    public function destroy(User $user)
    {
        // cegah user menghapus dirinya sendiri
        if (Auth::id() === $user->id) {
            return back()->withErrors('You cannot delete yourself.');
        }

        // hapus user
        $user->delete();

        // redirect kembali dengan pesan sukses
        return back()->with('success', 'User deleted.');
    }

    // form reset password (Admin)
    public function showResetPasswordForm(User $user)
    {
        // tampilkan form reset password
        return view('users.reset-password', compact('user'));
    }

    // proses reset password (Admin)
    public function resetPassword(Request $request, User $user)
    {
        // validasi password dan konfirmasi
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        // update password yang sudah di-hash
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.index')->with('success', 'Password berhasil direset.');
    }

    // tampilkan profil user yang login
    public function profile()
    {
        // ambil data user yang sedang login
        $user = Auth::user();

        // tampilkan view profil
        return view('users.profile', compact('user'));
    }
}

// request itu bukan sekadar variabel biasa, tapi objek instance dari class Illuminate\Http\Request bawaan Laravel
// $request punya banyak method:
// $request->input('key') → ambil input biasa

// $request->all() → ambil semua input

// $request->has('key') → cek apakah ada input tertentu

// $request->file('file') → ambil file upload

// $request->method() → ambil metode request (GET, POST, dsb)

// $request->isMethod('post') → cek apakah metode request adalah POST
//------------------------

// $user = Objek biasa / Model	Misalnya instance dari App\Models\User, bisa akses data user
// public function edit(User $user)
// {
//     return view('users.edit', compact('user'));
// }
// Di sini, $user adalah objek model User yang otomatis diisi lewat route model binding (Laravel langsung ambil data user dari database berdasarkan ID di URL).

// ---------------------------------------------

// $nama	Tipe data primitif	Bisa string, int, dll — tergantung isi nilai
// $nama = 'Aliza';
// echo "Halo, $nama!";
// Di sini $nama cuma string biasa

// ----------------------------------------------

// 1. $request: Objek yang berisi semua data dari form/input user
// public function simpanData(Request $request)
// {
//     $nama = $request->input('nama'); // Ambil data dari form input name="nama"
// }

// Visualisasinya:
// $request = {
//     nama: "Budi",
//     email: "budi@email.com",
//     password: "rahasia123"
// }
// $request itu ibarat kantong isi semua data yang dikirim user, bisa dari form, query URL, dll
// ---------------------------------------------------

// 2. $nama: Variabel biasa yang menyimpan 1 nilai (tipe primitif)
// $nama = "Budi";

// Visualisasinya:
// $nama = "Budi"
// Ini cuma string biasa. Gak ada fungsi khusus, cuma menyimpan teks "Budi".
// ---------------------------------------------------

// 3. $user: Objek model, biasanya hasil dari query database
// $user = User::find(1);

// Visualisasinya:
// $user = {
//     id: 1,
//     name: "Budi",
//     email: "budi@email.com",
//     role: "admin"
// }
// $user ini ibarat satu baris data dari tabel users, dalam bentuk objek
// ---------------------------------------------------

// Gabungan semuanya
// public function update(Request $request, User $user)
// {
//     $user->name = $request->input('nama');
//     $user->save();
// }

// Alur singkat:

// 1. $request ➜ ambil nama dari form
// 2. $user ➜ adalah user yang mau diupdate
// 3. $nama (sementara diambil dari $request) disimpan ke dalam $user
// 4. Simpan $user ke database