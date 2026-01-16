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
          <h3 class="card-title"><strong>Edit Data Jabatan Karyawan</strong></h3>
        </div>
        <div class="card-body">
          @include('partials._error')

          <form action="{{ route('jabatan-karyawan.update', $jabatanKaryawan->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group row">
              <label class="form-label col-sm-2">Jabatan</label>
              <div class="col-sm-10">
                <select name="jabatan_id" class="form-control" required>
                  <option value="">-- Pilih Jabatan --</option>
                  @foreach ($jabatan as $jab)
                    <option value="{{ $jab->id }}"
                      {{ (isset($jabatanKaryawan) && $jabatanKaryawan->jabatan_id == $jab->id) || old('jabatan_id') == $jab->id ? 'selected' : '' }}>
                      {{ $jab->nama_jabatan }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="form-label col-sm-2">Karyawan</label>
              <div class="col-sm-10">
                <select name="karyawan_id" class="form-control" required>
                  <option value="">-- Pilih Karyawan --</option>
                  @foreach ($karyawan as $kar)
                    <option value="{{ $kar->id }}"
                      {{ (isset($jabatanKaryawan) && $jabatanKaryawan->karyawan_id == $kar->id) || old('karyawan_id') == $kar->id ? 'selected' : '' }}>
                      {{ $kar->nama_lengkap }} ({{ $kar->nik }})
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="form-label col-sm-2">Tanggal Mulai</label>
              <div class="col-sm-4">
                <input type="date" name="tanggal_mulai" class="form-control"
                  value="{{ isset($jabatanKaryawan) ? $jabatanKaryawan->tanggal_mulai : old('tanggal_mulai') }}" required>
              </div>
            </div>
            <div class="card-footer text-center">
              <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
              <a href="{{ route('jabatan-karyawan.index') }}" class="btn btn-danger">BATAL</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
