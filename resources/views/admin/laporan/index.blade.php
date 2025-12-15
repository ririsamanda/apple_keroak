@extends('layouts.admin')

@section('title', 'Laporan Transaksi')

@section('content')
<style>
    
    .card-table {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        background-color: #fff;
        overflow: hidden;
        margin-bottom: 40px; 
    }

    .section-header {
        padding: 20px 25px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
    }

    .section-title {
        font-weight: 700;
        color: #1e3a56;
        margin: 0;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }

    .table-modern thead th {
        background-color: #f8f9fa;
        color: #7b8ca0;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 15px 20px;
        border-bottom: 2px solid #edf2f7;
    }

    .table-modern tbody td {
        padding: 15px 20px;
        vertical-align: middle;
        color: #555;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    .table-modern tbody tr:hover {
        background-color: #fcfdfe;
    }

    .badge-status {
        background-color: #e0f2fe;
        color: #02c709ff;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .btn-delete {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: none;
        background-color: #ffebee; 
        color: #ef5350;
        transition: 0.3s;
    }

    .btn-delete:hover {
        background-color: #ef5350;
        color: white;
        transform: translateY(-2px);
    }
</style>

<div class="mb-4">
    <h3 class="fw-bold mb-1" style="color: #1e3a56;">Laporan Aktivitas</h3>
    <p class="text-muted mb-0">Rekapitulasi riwayat produksi dan distribusi barang.</p>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" style="background-color: #d4edda; color: #155724;" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card card-table">
    <div class="section-header">
        <div class="section-title">
            <div class="rounded bg-light d-flex align-items-center justify-content-center me-3" 
                 style="width: 40px; height: 40px; color: #1e3a56;">
                <i class="bi bi-box-seam-fill fs-5"></i>
            </div>
            <div>
                Riwayat Produksi
                <div class="text-muted fw-normal" style="font-size: 0.8rem;">Data hasil output barang masuk</div>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>PIC (Karyawan)</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatProduksi as $p)
                    <tr>
                        <td class="text-nowrap">{{ $p->Tanggal_produksi }}</td>
                        
                        <td class="fw-semibold text-dark">{{ $p->produk->Nama_produk }}</td>
                        
                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ $p->Jumlah_selesai }} {{ $p->produk->Satuan }}
                            </span>
                        </td>
                        
                        <td>
                            <i class="bi bi-person me-1 text-muted"></i> {{ $p->karyawan->Nama_karyawan }}
                        </td>
                        
                        <td class="text-muted small">{{ $p->keterangan ?? '-' }}</td>
                        
                        <td class="text-center">
                            <form action="{{ route('laporan.destroyProduksi', $p->Id_produksi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data produksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus Data">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                            Belum ada data produksi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card card-table">
    <div class="section-header">
        <div class="section-title">
            <div class="rounded bg-light d-flex align-items-center justify-content-center me-3" 
                 style="width: 40px; height: 40px; color: #1e3a56;">
                <i class="bi bi-truck fs-5"></i>
            </div>
            <div>
                Riwayat Pengiriman
                <div class="text-muted fw-normal" style="font-size: 0.8rem;">Data distribusi barang ke pelanggan</div>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Alamat Tujuan</th>
                        <th>PIC Pengirim</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatPengiriman as $kirim)
                    <tr>
                        <td class="text-nowrap">{{ $kirim->Tanggal_kirim }}</td>
                        
                        <td class="fw-semibold text-dark">{{ $kirim->pelanggan->Nama_pelanggan }}</td>
                        
                        <td class="text-muted small" style="max-width: 250px;">
                            {{ Str::limit($kirim->pelanggan->Alamat, 40) }}
                        </td>
                        
                        <td>
                            <i class="bi bi-person me-1 text-muted"></i> {{ $kirim->karyawan->Nama_karyawan }}
                        </td>
                        
                        <td>
                            <span class="badge-status">
                                {{ $kirim->Status_pengiriman }}
                            </span>
                        </td>
                        
                        <td class="text-center">
                            <form action="{{ route('laporan.destroyPengiriman', $kirim->Id_pengiriman) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pengiriman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus Data">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-truck fs-1 d-block mb-2 opacity-25"></i>
                            Belum ada data pengiriman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection