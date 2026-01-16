<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JabatanKaryawanController; // TAMBAH INI

// Redirect root ke login
Route::redirect('/', '/login');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
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

  Route::get('print-pdf', [JabatanController::class, 'printPdf'])->name('print.jabatan');
  Route::get('grafik-jabatan', [JabatanController::class, 'grafikJabatan'])->name('grafik.jabatan');
  Route::get('get-grafik', [JabatanController::class, 'getGrafik'])->name('get.grafik.jabatan');
  Route::get('export-excel', [JabatanController::class, 'exportExcel'])->name('export.excel');
  Route::resource('jabatan-karyawan', JabatanKaryawanController::class);
});