<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanController;

Route::get('/', function () {
  return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
| Laravel 11 / 12 (manual auth)
*/
Route::middleware('guest')->group(function () {
  Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
  Route::post('login', [LoginController::class, 'login']);

  Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
  Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::group([
  'prefix' => 'admin',
  'middleware' => ['auth']
], function () {

  Route::get('/home', function () {
    return view('home');
  })->name('home');

  // pengguna
  Route::resource('pengguna', UserController::class);

  // jabatan
  Route::resource('jabatan', JabatanController::class);
  Route::get('get-jabatan', [JabatanController::class, 'getJabatan'])
    ->name('get.jabatan');
});