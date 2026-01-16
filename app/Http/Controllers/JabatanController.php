<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class JabatanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('masterdata.jabatan.index');
  }

  /**
   * Data Jabatan untuk DataTables (AJAX)
   */
  public function getJabatan(Request $request)
  {
    if ($request->ajax()) {
      $jabatan = Jabatan::query();

      return DataTables::of($jabatan)
        ->addIndexColumn()
        ->addColumn('aksi', function ($jabatan) {
          return view('partials._action', [
            'model'    => $jabatan,
            'form_url' => route('jabatan.destroy', $jabatan->id),
            'edit_url' => route('jabatan.edit', $jabatan->id),
          ]);
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('masterdata.jabatan.tambah');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nama_jabatan'       => 'required|string|max:255',
      'gapok_jabatan'      => 'required|numeric',
      'tunjangan_jabatan'  => 'required|numeric',
      'uang_makan_perhari' => 'required|numeric',
    ]);

    Jabatan::create($validated);

    Alert::success('Sukses', 'Berhasil Menambahkan Jabatan Baru');
    return redirect()->route('jabatan.index');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Jabatan $jabatan)
  {
    return view('masterdata.jabatan.edit', compact('jabatan'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Jabatan $jabatan)
  {
    $validated = $request->validate([
      'nama_jabatan'       => 'required|string|max:255',
      'gapok_jabatan'      => 'required|numeric',
      'tunjangan_jabatan'  => 'required|numeric',
      'uang_makan_perhari' => 'required|numeric',
    ]);

    $jabatan->update($validated);

    Alert::success('Sukses', 'Berhasil Mengupdate Jabatan');
    return redirect()->route('jabatan.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Jabatan $jabatan)
  {
    $jabatan->delete();

    Alert::success('Sukses', 'Berhasil Menghapus Jabatan');
    return redirect()->route('jabatan.index');
  }

  /**
   * Cetak data jabatan dalam format PDF
   */
  public function printPdf()
  {
    $jabatan = Jabatan::all();

    $pdf = Pdf::loadView('masterdata.jabatan._pdf', [
      'jabatan' => $jabatan
    ])->setPaper('A4', 'landscape');
    return $pdf->stream('Data_Jabatan.pdf');
  }

  /**
   * Menampilkan halaman grafik jabatan
   */
  public function grafikJabatan()
  {
    return view('masterdata.jabatan.chart');
  }

  /**
   * Mendapatkan data grafik (JSON)
   */
  public function getGrafik()
  {
    $jabatan = Jabatan::select('nama_jabatan', 'gapok_jabatan')->get();

    return response()->json([
      'data' => $jabatan
    ]);
  }

  /**
   * Export data jabatan ke Excel
   */
  public function exportExcel()
  {
    $jabatan = Jabatan::all();

    return view('masterdata.jabatan._excel', compact('jabatan'));
  }
}