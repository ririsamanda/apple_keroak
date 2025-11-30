@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Produk: {{ $produk->Nama_produk }}</h5>
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

        <form action="{{ route('produk.update', $produk->Id_produk) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="Nama_produk" class="form-control" value="{{ old('Nama_produk', $produk->Nama_produk) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="Kategori" class="form-control" value="{{ old('Kategori', $produk->Kategori) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <select name="Satuan" class="form-select" required>
                    <option value="Pcs" {{ $produk->Satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                    <option value="Unit" {{ $produk->Satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                    <option value="Box" {{ $produk->Satuan == 'Box' ? 'selected' : '' }}>Box</option>
                    <option value="Sak" {{ $produk->Satuan == 'Sak' ? 'selected' : '' }}>Sak</option>
                    <option value="Kg" {{ $produk->Satuan == 'Kg' ? 'selected' : '' }}>Kg</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Satuan (Rp)</label>
                <input type="number" name="Harga" class="form-control" value="{{ old('Harga', $produk->Harga) }}" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection