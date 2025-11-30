@extends('layouts.admin')

@section('title', 'Data Karyawan')

@section('content')
<style>
    /* --- CSS Tambahan Khusus Halaman Ini --- */
    
    /* Card Container */
    .card-table {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        background-color: #fff;
        overflow: hidden;
    }

    /* Header Tabel Modern */
    .table-modern thead th {
        background-color: #f8f9fa;
        color: #7b8ca0;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 18px 15px;
        border-bottom: 2px solid #edf2f7;
    }

    /* Body Tabel */
    .table-modern tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #555;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    .table-modern tbody tr:hover {
        background-color: #fcfdfe;
    }

    /* Badge Role (Admin/Karyawan) */
    .badge-role {
        padding: 8px 12px;
        border-radius: 30px;
        font-weight: 500;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
    }
    .badge-admin { background-color: #ffebee; color: #c62828; } /* Merah Soft */
    .badge-karyawan { background-color: #e8f5e9; color: #2e7d32; } /* Hijau Soft */

    /* Tombol Aksi (Edit/Hapus) */
    .btn-action {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: none;
        transition: 0.3s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .btn-edit { background-color: #fff8e1; color: #f9a825; }
    .btn-edit:hover { background-color: #f9a825; color: white; transform: translateY(-2px); }

    .btn-delete { background-color: #ffebee; color: #ef5350; }
    .btn-delete:hover { background-color: #ef5350; color: white; transform: translateY(-2px); }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: #1e3a56;">Data Karyawan</h3>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Kelola daftar pegawai dan hak akses sistem.</p>
    </div>
    
    <a href="{{ route('karyawan.create') }}" class="btn text-white px-4 py-2 rounded-3 shadow-sm" style="background-color: #1e3a56; transition: 0.3s;">
        <i class="bi bi-plus-lg me-2"></i> Tambah Karyawan
    </a>
</div>

<div class="card card-table">
    <div class="card-body p-0">
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3 border-0 shadow-sm" style="background-color: #d4edda; color: #155724;" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="25%">Nama Lengkap</th>
                        <th width="20%">Username</th>
                        <th width="20%">Jabatan</th>
                        <th width="15%" class="text-center">Hak Akses</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawan as $key => $data)
                    <tr>
                        <td class="text-center fw-bold text-muted">{{ $key + 1 }}</td>
                        
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" 
                                     style="width: 35px; height: 35px; color: #1e3a56; font-weight:bold; font-size: 14px;">
                                    {{ substr($data->Nama_karyawan, 0, 1) }}
                                </div>
                                <span class="fw-semibold" style="color: #1e3a56;">{{ $data->Nama_karyawan }}</span>
                            </div>
                        </td>

                        <td>{{ $data->Username }}</td>
                        <td>{{ $data->Jabatan }}</td>
                        
                        <td class="text-center">
                            @if($data->hakAkses->Nama_hakakses == 'Admin')
                                <span class="badge badge-role badge-admin">
                                    <i class="bi bi-shield-lock-fill me-1"></i> Admin
                                </span>
                            @else
                                <span class="badge badge-role badge-karyawan">
                                    <i class="bi bi-person-fill me-1"></i> Karyawan
                                </span>
                            @endif
                        </td>
                        
                        <td class="text-center">
                            <a href="{{ route('karyawan.edit', $data->Id_karyawan) }}" class="btn-action btn-edit me-1" title="Edit Data">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            
                            <form action="{{ route('karyawan.destroy', $data->Id_karyawan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus Data">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($karyawan->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <p class="mb-0">Belum ada data karyawan.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection