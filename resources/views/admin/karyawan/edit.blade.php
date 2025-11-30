@extends('layouts.admin')

@section('title', 'Edit Karyawan')

@section('content')
<style>
    /* Menggunakan Style yang sama dengan Create agar Konsisten */
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

    .btn-save {
        background-color: #f9a825; /* Warna Kuning/Orange khusus Edit */
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
        <h3 class="fw-bold mb-1" style="color: #1e3a56;">Edit Data Karyawan</h3>
        <p class="text-muted mb-0">Perbarui informasi untuk: <b class="text-dark">{{ $karyawan->Nama_karyawan }}</b></p>
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

                    <form action="{{ route('karyawan.update', $karyawan->Id_karyawan) }}" method="POST">
                        @csrf
                        @method('PUT') <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">Informasi Dasar</h6>

                        <div class="mb-4">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="Nama_karyawan" class="form-control" value="{{ old('Nama_karyawan', $karyawan->Nama_karyawan) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light rounded-start-3" style="border: 1px solid #e2e8f0 !important; border-right: none !important;">@</span>
                                    <input type="text" name="Username" class="form-control" value="{{ old('Username', $karyawan->Username) }}" required style="border-left: none;">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Password <span class="text-muted fw-normal" style="font-size: 0.75rem;">(Opsional)</span></label>
                                <input type="password" name="Password" class="form-control" placeholder="••••••••">
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">
                                    <i class="bi bi-info-circle me-1"></i> Isi hanya jika ingin mengganti password lama.
                                </small>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px dashed #ddd;">

                        <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">Jabatan & Akses</h6>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="Jabatan" class="form-control" value="{{ old('Jabatan', $karyawan->Jabatan) }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Hak Akses</label>
                                <select name="Id_hakakses" class="form-select" required>
                                    @foreach($hakAkses as $akses)
                                        <option value="{{ $akses->Id_hakakses }}" 
                                            {{ (old('Id_hakakses', $karyawan->Id_hakakses) == $akses->Id_hakakses) ? 'selected' : '' }}>
                                            {{ $akses->Nama_hakakses }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                            <a href="{{ route('karyawan.index') }}" class="btn btn-back">
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