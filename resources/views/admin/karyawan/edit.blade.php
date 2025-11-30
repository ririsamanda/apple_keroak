@extends('layouts.admin')

@section('title', 'Edit Karyawan')

@section('content')
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Karyawan: {{ $karyawan->Nama_karyawan }}</h5>
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

        <form action="{{ route('karyawan.update', $karyawan->Id_karyawan) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="Nama_karyawan" class="form-control" value="{{ old('Nama_karyawan', $karyawan->Nama_karyawan) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="Username" class="form-control" value="{{ old('Username', $karyawan->Username) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password <small class="text-danger">(Isi hanya jika ingin mengganti)</small></label>
                <input type="password" name="Password" class="form-control" placeholder="Kosongkan jika password tetap sama">
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" name="Jabatan" class="form-control" value="{{ old('Jabatan', $karyawan->Jabatan) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hak Akses</label>
                <select name="Id_hakakses" class="form-select" required>
                    @foreach($hakAkses as $akses)
                        <option value="{{ $akses->Id_hakakses }}" {{ $karyawan->Id_hakakses == $akses->Id_hakakses ? 'selected' : '' }}>
                            {{ $akses->Nama_hakakses }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection