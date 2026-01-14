<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $users = User::all();
    return view('users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('users.tambah');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // memvalidasi inputan - GANTI $this->validate() dengan $request->validate()
    $request->validate([
      'name'      => 'required',
      'email'     => 'required|email|unique:users',
      'password'  => 'required',
      'level'     => 'required'
    ]);

    // insert data ke database
    User::create([
      'name'      => $request->name,
      'email'     => $request->email,
      'password'  => Hash::make($request->password),
      'level'     => $request->level,
    ]);

    Alert::success('Sukses', 'Berhasil Menambahkan User Baru');
    return redirect()->route('pengguna.index');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $pengguna)
  {
    return view('users.edit', compact('pengguna'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $pengguna)
  {
    // memvalidasi inputan - GANTI $this->validate() dengan $request->validate()
    $request->validate([
      'name'      => 'required',
      'email'     => 'required|email|unique:users,email,' . $pengguna->id,
      'level'     => 'required',
    ]);

    // update data ke database
    $updateData = [
      'name'      => $request->name,
      'email'     => $request->email,
      'level'     => $request->level,
    ];

    // Update password hanya jika diisi
    if ($request->password) {
      $updateData['password'] = Hash::make($request->password);
    }

    $pengguna->update($updateData);

    Alert::success('Sukses', 'Berhasil Mengupdate Pengguna');
    return redirect()->route('pengguna.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $pengguna)
  {
    $pengguna->delete();
    Alert::success('Sukses', 'Berhasil Menghapus Pengguna');
    return redirect()->route('pengguna.index');
  }
}