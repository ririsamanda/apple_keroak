@extends('layouts.karyawan')

@section('title', 'Dashboard Karyawan')

@section('content')
<style>
    :root {
        --color-navy: #1e3a56;
        --color-navy-light: #2c537a;
        --color-gray-soft: #7b8ca0;
        
        --status-success-bg: #e8f5e9; --status-success-text: #2e7d32;
        --status-info-bg: #e3f2fd;    --status-info-text: #1565c0;
        --status-danger-bg: #ffebee;  --status-danger-text: #c62828;
        --status-neutral-bg: #f1f5f9; --status-neutral-text: #475569;
    }

    .dashboard-header {
        background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-navy-light) 100%);
        color: white;
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(30, 58, 86, 0.15);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .card-modern {
        border: none;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .card-header-clean {
        padding: 20px 25px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        background: transparent;
    }

    .header-icon {
        width: 40px; height: 40px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        margin-right: 15px;
        font-size: 1.2rem;
    }
    
    .bg-icon-navy { background: #e3f2fd; color: var(--color-navy); }
    .bg-icon-green { background: #e8f5e9; color: #2e7d32; }

    .header-title {
        font-weight: 700;
        color: var(--color-navy);
        font-size: 1.05rem;
        margin: 0;
    }

    .table-modern thead th {
        background-color: #f8f9fa;
        color: var(--color-gray-soft);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 15px;
        border-bottom: 2px solid #edf2f7;
    }

    .table-modern tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #334155;
    }
    
    .table-modern tbody tr:last-child td { border-bottom: none; }

    .btn-action-custom {
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.3s;
        border: 1px solid transparent;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-navy {
        background-color: var(--color-navy);
        color: white;
    }
    .btn-navy:hover {
        background-color: var(--color-navy-light);
        color: white;
        box-shadow: 0 4px 15px rgba(30, 58, 86, 0.3);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
    }

    .status-Dikirim { background-color: var(--status-info-bg); color: var(--status-info-text); }
    .status-Selesai { background-color: var(--status-success-bg); color: var(--status-success-text); }
    .status-Batal { background-color: var(--status-danger-bg); color: var(--status-danger-text); }
    .status-default { background-color: var(--status-neutral-bg); color: var(--status-neutral-text); }
</style>

<div class="container-fluid p-0">
    
    {{-- 1. ALERT SUCCESS --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" style="background-color: var(--status-success-bg); color: var(--status-success-text);" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- 2. WELCOME HEADER --}}
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="me-3 d-none d-sm-block">
                <div class="bg-white bg-opacity-25 rounded-circle p-3">
                    <i class="bi bi-person-fill fs-3"></i>
                </div>
            </div>
            <div>
                <h2 class="fw-bold mb-1">Halo, {{ Auth::user()->Nama_karyawan }}!</h2>
                <p class="mb-0 opacity-75">Selamat bekerja. Berikut rekap aktivitas terbaru Anda.</p>
            </div>
        </div>
        <div class="d-none d-md-block text-end">
            <h5 class="fw-bold mb-0">{{ now()->translatedFormat('l, d F Y') }}</h5>
            <small class="opacity-75">Karyawan Dashboard</small>
        </div>
    </div>

    {{-- 3. JUDUL SECTION --}}
    <h5 class="mb-4 text-muted fw-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 1px;">
        <i class="bi bi-clock-history me-2 text-primary"></i> Riwayat Input Saya (Terbaru)
    </h5>

    <div class="row g-4">
        
        {{-- KOLOM 1: RIWAYAT PRODUKSI --}}
        <div class="col-lg-6">
            <div class="card-modern">
                {{-- Header Kartu --}}
                <div class="card-header-clean">
                    <div class="header-icon bg-icon-navy">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <h5 class="header-title">Hasil Produksi</h5>
                        <small class="text-muted">Data output barang terakhir</small>
                    </div>
                </div>

                {{-- Isi Tabel --}}
                <div class="card-body p-0 flex-grow-1">
                    <div class="table-responsive">
                        <table class="table table-stripped mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayatProduksi as $rp)
                                <tr>
                                    <td class="text-nowrap">{{ $rp->Tanggal_produksi }}</td>
                                    <td class="fw-semibold text-dark">{{ $rp->produk->Nama_produk }}</td>
                                    <td>
                                        <span class="badge rounded-pill fw-normal text-dark" style="background-color: #f1f5f9; border: 1px solid #e2e8f0;">
                                            {{ $rp->Jumlah_selesai }} {{ $rp->produk->Satuan }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="bi bi-clipboard-x fs-1 opacity-25 d-block mb-2"></i>
                                        Belum ada data produksi.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Footer Tombol (NAVY SOLID) --}}
                <div class="p-3 border-top">
                    <a href="{{ route('produksi.create') }}" class="btn btn-action-custom btn-navy w-100">
                        <i class="bi bi-plus-lg me-2"></i> Input Produksi Baru
                    </a>
                </div>
            </div>
        </div>

        {{-- KOLOM 2: RIWAYAT PENGIRIMAN --}}
        <div class="col-lg-6">
            <div class="card-modern">
                {{-- Header Kartu --}}
                <div class="card-header-clean">
                    <div class="header-icon bg-icon-green">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div>
                        <h5 class="header-title">Pengiriman Terakhir</h5>
                        <small class="text-muted">Status distribusi barang</small>
                    </div>
                </div>

                {{-- Isi Tabel --}}
                <div class="card-body p-0 flex-grow-1">
                    <div class="table-responsive">
                         <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tujuan</th>
                                    <th>Status & Aksi</th> </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayatPengiriman as $rk)
                                <tr>
                                    <td class="align-middle">{{ $rk->Tanggal_kirim }}</td>
                                    <td class="align-middle">{{ $rk->pelanggan->Nama_pelanggan }}</td>
                                    <td class="align-middle">
                                        
                                        @if($rk->Status_pengiriman == 'Dikirim')
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-warning text-dark">Dikirim</span>
                                                
                                                <form action="{{ route('pengiriman.selesai', $rk->Id_pengiriman) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-xs btn-success py-0 px-2" style="font-size: 0.75rem;" title="Tandai Sudah Sampai">
                                                        <i class="bi bi-check-lg"></i> Selesai?
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Belum ada data pengiriman.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Footer Tombol (NAVY SOLID) --}}
                <div class="p-3 border-top">
                    <a href="{{ route('pengiriman.create') }}" class="btn btn-action-custom btn-navy w-100">
                        <i class="bi bi-plus-lg me-2"></i> Input Pengiriman Baru
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection