@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<style>
    .card-form {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        background-color: #fff;
    }

    .form-label {
        color: #1e3a56;
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }

    .form-control:focus, .form-select:focus {
        border-color: #1e3a56;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(30, 58, 86, 0.1);
    }

    .input-group-text {
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        color: #64748b;
        font-weight: 500;
    }

    .btn-save {
        background-color: #f9a825; 
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 500;
        border: none;
        transition: 0.3s;
    }

    .btn-save:hover {
        background-color: #f57f17;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(249, 168, 37, 0.3);
    }

    .btn-back {
        background-color: #fff;
        border: 1px solid #ddd;
        color: #666;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-back:hover {
        background-color: #f1f1f1;
        color: #333;
    }
</style>

<div class="container-fluid p-0">

    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="color: #1e3a56;">Edit Data Produk</h3>
        <p class="text-muted mb-0">Perbarui informasi barang: <b class="text-dark">{{ $produk->Nama_produk }}</b></p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card card-form">
                <div class="card-body p-4 p-md-5">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                            <ul class="mb-0 small ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produk.update', $produk->Id_produk) }}" method="POST">
                        @csrf
                        @method('PUT') <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">Detail Barang</h6>

                        <div class="mb-4">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="Nama_produk" class="form-control" value="{{ old('Nama_produk', $produk->Nama_produk) }}" required autofocus>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="Kategori" class="form-control" value="{{ old('Kategori', $produk->Kategori) }}" placeholder="Contoh: Laptop" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Satuan</label>
                                <select name="Satuan" class="form-select" required>
                                    <option value="Pcs" {{ $produk->Satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                    <option value="Unit" {{ $produk->Satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px dashed #ddd;">

                        <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">Penetapan Harga</h6>

                        <div class="mb-4">
                            <label class="form-label">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3" style="border-right: 0;">Rp</span>
                                <input type="number" name="Harga" class="form-control" value="{{ old('Harga', $produk->Harga) }}" required style="border-left: 0;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                            <a href="{{ route('produk.index') }}" class="btn btn-back">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-save">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection