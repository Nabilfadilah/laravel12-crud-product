<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// menampilkan form register
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
// menangani proses submit form register
Route::post('register', [AuthController::class, 'register']);

// menampilkan form login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
// menangani proses submit form login
Route::post('login', [AuthController::class, 'login']);

// logout user yang sedang login
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// ==========================
// PROTECTED ROUTES (login required)
Route::middleware('auth')->group(function () {
    // resource route untuk products (index, create, store, edit, update, destroy, dll)
    Route::resource('products', ProductController::class);

    // menampilkan halaman profil user yang sedang login
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');

    // ==========================
    // ADMIN-ONLY ROUTES
    Route::middleware('role:admin')->group(function () {
        // resource route untuk users (tanpa method 'show')
        Route::resource('users', UserController::class)->except(['show']);

        // menampilkan form reset password untuk user tertentu
        Route::get('/users/{user}/reset-password', [UserController::class, 'showResetPasswordForm'])
            ->name('users.resetPasswordForm');

        // menangani submit form reset password
        Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])
            ->name('users.resetPassword');
    });
});


// Route::get('/', function () {
//     return redirect()->route('products.index');
// });

// Route::resource('products', ProductController::class);
