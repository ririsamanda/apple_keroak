@extends('layouts.karyawan')

@section('title', 'Input Produksi')

@section('content')
<style>
    /* --- TEMA NAVY & CLEAN (Konsisten) --- */
    
    .card-form {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        background-color: #fff;
    }

    .form-label {
        color: #1e3a56;
        font-weight: 600;
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

    /* Button Styles */
    .btn-save {
        background-color: #1e3a56; /* Warna Navy Solid */
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }
    .btn-save:hover {
        background-color: #162d45;
        box-shadow: 0 4px 15px rgba(30, 58, 86, 0.3);
        color: white;
    }

    .btn-back {
        background-color: #fff;
        border: 1px solid #ddd;
        color: #64748b;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-back:hover {
        background-color: #f1f5f9;
        color: #1e3a56;
    }
</style>

<div class="container-fluid p-0">

    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="color: #1e3a56;">Input Hasil Produksi</h3>
        <p class="text-muted mb-0">Catat hasil barang jadi yang masuk ke gudang hari ini.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="card card-form">
                <div class="card-body p-4 p-md-5">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Perhatian!</strong> Mohon lengkapi data inputan.
                            </div>
                            <ul class="mb-0 mt-2 small ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produksi.store') }}" method="POST">
                        @csrf

                        <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">Detail Produksi</h6>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="Tanggal_produksi" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Produk</label>
                                <select name="Id_produk" class="form-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produk as $p)
                                        <option value="{{ $p->Id_produk }}">
                                            {{ $p->Nama_produk }} ({{ $p->Satuan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Jumlah Selesai</label>
                            <div class="input-group">
                                <input type="number" name="Jumlah_selesai" class="form-control" placeholder="0" min="1" required style="border-right: 0;">
                                <span class="input-group-text bg-light text-muted border-start-0" style="border: 1px solid #e2e8f0; border-radius: 0 10px 10px 0;">Unit</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Keterangan <span class="fw-normal text-muted">(Opsional)</span></label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Catatan tambahan..."></textarea>
                        </div>

                        <hr class="my-4" style="border-top: 1px dashed #e2e8f0;">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ url()->previous() }}" class="btn btn-back">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-save">
                                <i class="bi bi-save me-2"></i> Simpan Data Produksi
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection