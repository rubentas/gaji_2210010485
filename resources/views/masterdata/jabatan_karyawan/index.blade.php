@extends('adminlte::page')

@section('title', 'Data Jabatan Karyawan')

@section('content_header')
  <h1 class="m-0 text-dark">Data Jabatan Karyawan</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h2 class="card-title"><strong>Table Data Jabatan Karyawan</strong></h2>
          <a href="{{ route('jabatan-karyawan.create') }}" class="btn btn-primary btn-md float-right">
            Tambah Jabatan Karyawan
          </a>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>NO.</th>
                <th>KARYAWAN</th>
                <th>JABATAN</th>
                <th>TANGGAL MULAI</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jabatanKaryawan as $jk)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $jk->karyawan->nama_lengkap }}</td>
                  <td>{{ $jk->jabatan->nama_jabatan }}</td>
                  <td>{{ date('d-m-Y', strtotime($jk->tanggal_mulai)) }}</td>
                  <td class="text-center">
                    <a href="{{ route('jabatan-karyawan.edit', $jk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('jabatan-karyawan.destroy', $jk->id) }}" method="POST" style="display:inline">
                      @csrf @method('DELETE')
                      <button type="submit" onclick="return confirm('Anda Yakin?')"
                        class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop
