@extends('layouts.admin')

@section('title', 'Data Pelanggan')

@section('content')
<style>
    /* --- CSS Konsisten dengan Halaman Lain --- */
    
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
        <h3 class="fw-bold mb-1" style="color: #1e3a56;">Data Pelanggan</h3>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Kelola daftar customer dan kontak pelanggan.</p>
    </div>
    
    <a href="{{ route('pelanggan.create') }}" class="btn text-white px-4 py-2 rounded-3 shadow-sm" style="background-color: #1e3a56; transition: 0.3s;">
        <i class="bi bi-plus-lg me-2"></i> Tambah Pelanggan
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
                        <th width="25%">Nama Pelanggan</th>
                        <th width="35%">Alamat</th>
                        <th width="20%">No. Telp</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan as $key => $data)
                    <tr>
                        <td class="text-center fw-bold text-muted">{{ $key + 1 }}</td>
                        
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" 
                                     style="width: 35px; height: 35px; color: #1e3a56; font-weight:bold; font-size: 14px;">
                                    {{ substr($data->Nama_pelanggan, 0, 1) }}
                                </div>
                                <span class="fw-semibold" style="color: #1e3a56;">{{ $data->Nama_pelanggan }}</span>
                            </div>
                        </td>

                        <td class="text-muted">{{ Str::limit($data->Alamat, 50) }}</td>
                        
                        <td>
                            <i class="bi bi-telephone me-2 text-muted" style="font-size: 0.8rem;"></i>
                            {{ $data->No_telp }}
                        </td>

                        <td class="text-center">
                            <a href="{{ route('pelanggan.edit', $data->Id_pelanggan) }}" class="btn-action btn-edit me-1" title="Edit Data">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <form action="{{ route('pelanggan.destroy', $data->Id_pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pelanggan ini?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus Data">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <div class="mb-3">
                                <i class="bi bi-person-x" style="font-size: 3rem; opacity: 0.2;"></i>
                            </div>
                            <p class="mb-0">Belum ada data pelanggan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection