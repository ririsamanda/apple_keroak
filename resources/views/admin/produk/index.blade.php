@extends('layouts.admin')

@section('title', 'Data Produk')

@section('content')
<style>
    
    .card-table {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        background-color: #fff;
        overflow: hidden;
    }

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

    .badge-satuan {
        background-color: #e3f2fd;
        color: #1565c0;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
    }

    .badge-stok-aman {
        background-color: #e8f5e9;
        color: #2e7d32;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .badge-stok-nipis {
        background-color: #ffebee;
        color: #c62828;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }

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
    
    .price-tag {
        font-weight: 600;
        color: #1e3a56;
        letter-spacing: 0.5px;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: #1e3a56;">Data Produk</h3>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Kelola daftar barang, harga, dan stok inventory.</p>
    </div>
    
    <a href="{{ route('produk.create') }}" class="btn text-white px-4 py-2 rounded-3 shadow-sm" style="background-color: #1e3a56; transition: 0.3s;">
        <i class="bi bi-plus-lg me-2"></i> Tambah Produk
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
                        <th width="25%">Nama Produk</th>
                        <th width="15%">Kategori</th>
                        <th width="10%" class="text-center">Satuan</th>
                        <th width="15%">Harga (Rp)</th>
                        <th width="10%" class="text-center">Stok</th> <!-- Kolom Stok Ditambahkan -->
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $key => $data)
                    <tr>
                        <td class="text-center fw-bold text-muted">{{ $key + 1 }}</td>
                        
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded bg-light d-flex align-items-center justify-content-center me-3" 
                                     style="width: 35px; height: 35px; color: #1e3a56;">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <span class="fw-semibold" style="color: #1e3a56;">{{ $data->Nama_produk }}</span>
                            </div>
                        </td>

                        <td>{{ $data->Kategori ?? '-' }}</td>
                        
                        <td class="text-center">
                            <span class="badge-satuan">{{ $data->Satuan }}</span>
                        </td>

                        <td>
                            <span class="price-tag">Rp {{ number_format($data->Harga, 0, ',', '.') }}</span>
                        </td>

                        <td class="text-center">
                            @if($data->Stok <= 5)
                                <span class="badge-stok-nipis">{{ $data->Stok }}</span>
                            @else
                                <span class="badge-stok-aman">{{ $data->Stok }}</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('produk.edit', $data->Id_produk) }}" class="btn-action btn-edit me-1" title="Edit Produk">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <form action="{{ route('produk.destroy', $data->Id_produk) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus Produk">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <div class="mb-3">
                                <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.2;"></i>
                            </div>
                            <p class="mb-0">Belum ada data produk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection