<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);

    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');

    // Hanya admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::get('/users/{user}/reset-password', [UserController::class, 'showResetPasswordForm'])->name('users.resetPasswordForm');
        Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
    });
});


// Route::get('/', function () {
//     return redirect()->route('products.index');
// });

// Route::resource('products', ProductController::class);
