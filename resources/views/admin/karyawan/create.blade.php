@extends('layouts.admin')

@section('title', 'Tambah Karyawan')

@section('content')
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-white">
        <h5 class="mb-0">Form Tambah Karyawan</h5>
    </div>
    <div class="card-body">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('karyawan.store') }}" method="POST">
            @csrf 

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="Nama_karyawan" class="form-control" value="{{ old('Nama_karyawan') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="Username" class="form-control" value="{{ old('Username') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="Password" class="form-control" required>
                <small class="text-muted">Minimal 5 karakter.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" name="Jabatan" class="form-control" value="{{ old('Jabatan') }}" placeholder="Contoh: Staff Gudang" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hak Akses</label>
                <select name="Id_hakakses" class="form-select" required>
                    <option value="">-- Pilih Hak Akses --</option>
                    @foreach($hakAkses as $akses)
                        <option value="{{ $akses->Id_hakakses }}" {{ old('Id_hakakses') == $akses->Id_hakakses ? 'selected' : '' }}>
                            {{ $akses->Nama_hakakses }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection