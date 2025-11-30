@extends('layouts.admin')
@section('title', 'Edit Pelanggan')
@section('content')

<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-white"><h5 class="mb-0">Edit Pelanggan</h5></div>
    <div class="card-body">
        <form action="{{ route('pelanggan.update', $pelanggan->Id_pelanggan) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Nama Pelanggan</label>
                <input type="text" name="Nama_pelanggan" class="form-control" value="{{ $pelanggan->Nama_pelanggan }}" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="Alamat" class="form-control" rows="3" required>{{ $pelanggan->Alamat }}</textarea>
            </div>
            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="text" name="No_telp" class="form-control" value="{{ $pelanggan->No_telp }}" required>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection