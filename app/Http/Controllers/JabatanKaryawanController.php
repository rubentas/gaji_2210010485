<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JabatanKaryawan;
use App\Models\Jabatan;
use App\Models\Karyawan;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanKaryawanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $jabatanKaryawan = JabatanKaryawan::with(['jabatan', 'karyawan'])->get();
    return view('masterdata.jabatan_karyawan.index', compact('jabatanKaryawan'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $jabatan = Jabatan::all();
    $karyawan = Karyawan::all();
    return view('masterdata.jabatan_karyawan.tambah', compact('jabatan', 'karyawan'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // memvalidasi inputan
    $request->validate([
      'jabatan_id'    => 'required|exists:jabatan,id',
      'karyawan_id'   => 'required|exists:karyawan,id',
      'tanggal_mulai' => 'required|date',
    ]);

    // insert data ke database
    JabatanKaryawan::create([
      'jabatan_id'    => $request->jabatan_id,
      'karyawan_id'   => $request->karyawan_id,
      'tanggal_mulai' => $request->tanggal_mulai,
    ]);

    Alert::success('Sukses', 'Berhasil Menambahkan Jabatan Karyawan Baru');
    return redirect()->route('jabatan-karyawan.index');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(JabatanKaryawan $jabatanKaryawan)
  {
    $jabatan = Jabatan::all();
    $karyawan = Karyawan::all();
    return view('masterdata.jabatan_karyawan.edit', compact('jabatanKaryawan', 'jabatan', 'karyawan'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, JabatanKaryawan $jabatanKaryawan)
  {
    // memvalidasi inputan
    $request->validate([
      'jabatan_id'    => 'required|exists:jabatan,id',
      'karyawan_id'   => 'required|exists:karyawan,id',
      'tanggal_mulai' => 'required|date',
    ]);

    // update data ke database
    $jabatanKaryawan->update([
      'jabatan_id'    => $request->jabatan_id,
      'karyawan_id'   => $request->karyawan_id,
      'tanggal_mulai' => $request->tanggal_mulai,
    ]);

    Alert::success('Sukses', 'Berhasil Mengupdate Jabatan Karyawan');
    return redirect()->route('jabatan-karyawan.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(JabatanKaryawan $jabatanKaryawan)
  {
    $jabatanKaryawan->delete();
    Alert::success('Sukses', 'Berhasil Menghapus Jabatan Karyawan');
    return redirect()->route('jabatan-karyawan.index');
  }
}