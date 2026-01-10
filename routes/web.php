<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes (TAMBAHKAN Auth::routes() jika Laravel 11)
// Untuk Laravel 11:
Auth::routes();

// Untuk Laravel 12 (hapus Auth::routes() dan ganti dengan):
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes SESUAI MODUL DOSEN
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    
    Route::resource('pengguna', UserController::class);
});