@extends('layouts.karyawan')

@section('content')
{{-- CSS Kustom: Tema Professional Gradient Blue-Teal --}}
<style>
    /* Mengubah Background Halaman Utama (Luar Konten) */
    body {
        /* Biarkan body luar tetap putih atau sangat terang jika ada sidebar */
        background-color: #f8fafc !important;
        min-height: 100vh;
    }

    :root {
        --color-primary-dark: #1e293b;
        --color-primary-light: #64748b;
        --color-accent-teal: #0d9488; /* Teal 600 */
        --color-accent-blue: #2563eb;
        
        /* Gradasi Dibuat LEBIH GELAP */
        --bg-gradient-page: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); /* Gradasi Biru-Abu Lebih Tegas */
        
        /* Warna Status Modern */
        --status-success-bg: #dcfce7; --status-success-text: #166534;
        --status-info-bg: #e0f2fe;    --status-info-text: #075985;
        --status-danger-bg: #fee2e2;  --status-danger-text: #991b1b;
    }

    /* Styling Card yang Lebih Premium */
    .card-dashboard {
        background: #ffffff; /* Card tetap putih */
        border: none;
        border-radius: 18px; /* Sudut lebih bulat modern */
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05), 0 1px 6px rgba(0, 0, 0, 0.03); /* Shadow halus */
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
    }
    
    .card-dashboard:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1), 0 5px 10px rgba(0, 0, 0, 0.05);
    }

    /* Aksen garis atas card */
    .card-dashboard::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--color-accent-teal), transparent);
        opacity: 0.1;
    }

    /* Icon Box Premium */
    .icon-box-modern {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        transition: transform 0.3s ease;
        background: #f1f5f9;
    }
    
    .card-dashboard:hover .icon-box-modern {
        transform: scale(1.05);
    }

    /* Gradient Text Utility */
    .text-gradient-teal {
        background: linear-gradient(to right, #0d9488, #115e59);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Button Styling */
    .btn-action {
        border-radius: 50px;
        padding: 8px 18px;
        font-weight: 600;
        letter-spacing: 0.2px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .btn-action-primary {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        color: white;
        border: none;
        box-shadow: 0 4px 10px rgba(13, 148, 136, 0.2);
    }
    .btn-action-primary:hover {
        background: linear-gradient(135deg, #115e59 0%, #134e4a 100%);
        color: white;
        box-shadow: 0 6px 15px rgba(13, 148, 136, 0.3);
        transform: translateY(-1px);
    }

    /* Table Improvements */
    .table-modern thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.08em;
        border-bottom: 2px solid #e2e8f0;
        padding-top: 12px;
        padding-bottom: 12px;
    }
    .table-modern tbody td {
        padding-top: 12px;
        padding-bottom: 12px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
    
    /* Background Khusus Welcome Card */
    .welcome-card-bg {
        background: linear-gradient(120deg, #0f766e 0%, #0d9488 100%);
        color: white;
        position: relative;
    }
    .welcome-card-bg::before {
        /* Pattern Overlay */
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.6;
    }
</style>

{{-- KONTEN UTAMA DENGAN GRADASI BACKGROUND --}}
<div class="p-4" style="background: var(--bg-gradient-page); border-radius: 25px;">
    <div class="row">
        <div class="col-md-12">
            
            {{-- SUCCESS ALERT --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background: white; border-left: 5px solid #10b981; color: #1e293b;">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                        <i class="bi bi-check-lg text-success fs-5"></i>
                    </div>
                    <div>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- WELCOME HEADER (Modern Gradient) --}}
            <div class="card card-dashboard mb-5 border-0 overflow-hidden">
                <div class="card-body welcome-card-bg py-5 px-4">
                    <div class="d-flex flex-column flex-md-row align-items-center position-relative" style="z-index: 2;">
                        <div class="bg-white bg-opacity-25 p-3 rounded-circle shadow-lg me-md-4 mb-3 mb-md-0 d-flex justify-content-center align-items-center text-white" style="width: 70px; height: 70px; backdrop-filter: blur(5px);">
                            <i class="bi bi-person-circle display-5"></i>
                        </div>
                        <div class="text-center text-md-start">
                            <h2 class="fw-bold mb-1">Halo, {{ Auth::user()->Nama_karyawan }}!</h2>
                            <p class="mb-0 opacity-75 fs-6">Selamat bekerja. Berikut adalah ringkasan performa dan aktivitas Anda hari ini.</p>
                        </div>
                        <div class="ms-md-auto mt-3 mt-md-0">
                            <span class="badge bg-white bg-opacity-20 backdrop-blur border border-white border-opacity-25 px-4 py-2 rounded-pill fw-normal">
                                <i class="bi bi-calendar2-week me-2"></i> {{ date('l, d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DASHBOARD WIDGETS --}}
            <div class="d-flex align-items-center justify-content-between mb-4 px-1">
                <h5 class="text-secondary fw-bold mb-0 text-uppercase ls-1" style="font-size: 0.85rem; letter-spacing: 1px;">
                    <i class="bi bi-grid-1x2-fill me-2 text-gradient-teal"></i> Overview Statistik
                </h5>
            </div>
            
            <div class="row mb-5">
                {{-- Widget 1: Total Produksi --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-dashboard h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="icon-box-modern" style="background: linear-gradient(135deg, #ccfbf1 0%, #e0f2fe 100%); color: #0d9488;">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <span class="badge rounded-pill px-3 py-1 fw-bold" style="background-color: #dcfce7; color: #15803d; font-size: 0.75rem;">
                                    <i class="bi bi-arrow-up-short"></i> 5%
                                </span>
                            </div>
                            <div>
                                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Produksi</p>
                                <h3 class="fw-bold text-dark mb-0">1.250 <small class="text-muted fs-6 fw-normal">Unit</small></h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Widget 2: Pengiriman --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-dashboard h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="icon-box-modern" style="background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%); color: #0369a1;">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <span class="badge rounded-pill px-3 py-1 fw-bold" style="background-color: #f1f5f9; color: #64748b; font-size: 0.75rem;">7 Hari</span>
                            </div>
                            <div>
                                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Pengiriman</p>
                                <h3 class="fw-bold text-dark mb-0">35 <small class="text-muted fs-6 fw-normal">Kali</small></h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Widget 3: Stok --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-dashboard h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="icon-box-modern" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); color: #15803d;">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <span class="badge rounded-pill px-3 py-1 fw-bold" style="background-color: #dcfce7; color: #15803d; font-size: 0.75rem;">Aman</span>
                            </div>
                            <div>
                                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Kesehatan Stok</p>
                                <h3 class="fw-bold text-dark mb-0">98%</h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Widget 4: Alert --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-dashboard h-100 border-start border-4 border-danger">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="icon-box-modern" style="background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); color: #b91c1c;">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                                <span class="badge rounded-pill px-3 py-1 fw-bold" style="background-color: #fee2e2; color: #991b1b; font-size: 0.75rem;">Perhatian</span>
                            </div>
                            <div>
                                <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Stok Menipis</p>
                                <h3 class="fw-bold text-dark mb-0">3 <small class="text-muted fs-6 fw-normal">Produk</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION RIWAYAT --}}
            <div class="row">
                {{-- TABEL PRODUKSI --}}
                <div class="col-lg-6 mb-4">
                    <div class="card card-dashboard h-100">
                        <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Produksi Terakhir</h5>
                                <p class="text-muted small mb-0">Aktivitas input produksi terbaru Anda</p>
                            </div>
                            <a href="{{ route('produksi.create') }}" class="btn btn-action btn-action-primary shadow-sm">
                                <i class="bi bi-plus-lg me-1"></i> Input
                            </a>
                        </div>
                        <div class="card-body px-0 pt-3">
                            <div class="table-responsive">
                                <table class="table table-hover table-modern mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Tanggal</th>
                                            <th>Produk</th>
                                            <th class="text-end pe-4">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($riwayatProduksi as $rp)
                                        <tr>
                                            <td class="ps-4 text-muted font-monospace small">{{ \Carbon\Carbon::parse($rp->Tanggal_produksi)->format('d/m/Y') }}</td>
                                            <td class="fw-bold text-dark">{{ $rp->produk->Nama_produk }}</td>
                                            <td class="text-end pe-4">
                                                <span class="badge bg-white text-dark border shadow-sm rounded-pill px-3 py-2 fw-normal">
                                                    {{ $rp->Jumlah_selesai }} {{ $rp->produk->Satuan }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-clipboard-data fs-1 opacity-25 mb-2"></i>
                                                    <p class="mb-0">Belum ada data produksi.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TABEL PENGIRIMAN --}}
                <div class="col-lg-6 mb-4">
                    <div class="card card-dashboard h-100">
                        <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">Pengiriman Terakhir</h5>
                                <p class="text-muted small mb-0">Status pengiriman barang ke pelanggan</p>
                            </div>
                            <a href="{{ route('pengiriman.create') }}" class="btn btn-outline-dark btn-action shadow-sm border-2">
                                <i class="bi bi-plus-lg me-1"></i> Input
                            </a>
                        </div>
                        <div class="card-body px-0 pt-3">
                            <div class="table-responsive">
                                <table class="table table-hover table-modern mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Tanggal</th>
                                            <th>Pelanggan</th>
                                            <th class="text-center pe-4">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($riwayatPengiriman as $rk)
                                        <tr>
                                            <td class="ps-4 text-muted font-monospace small">{{ \Carbon\Carbon::parse($rk->Tanggal_kirim)->format('d/m/Y') }}</td>
                                            <td class="fw-bold text-dark">{{ $rk->pelanggan->Nama_pelanggan }}</td>
                                            <td class="text-center pe-4">
                                                @php
                                                    $statusConfig = [
                                                        'Selesai' => ['bg' => '#dcfce7', 'text' => '#166534', 'icon' => 'bi-check-circle-fill'],
                                                        'Proses'  => ['bg' => '#e0f2fe', 'text' => '#075985', 'icon' => 'bi-arrow-repeat'],
                                                        'Batal'   => ['bg' => '#fee2e2', 'text' => '#991b1b', 'icon' => 'bi-x-circle-fill'],
                                                    ];
                                                    $conf = $statusConfig[$rk->Status_pengiriman] ?? ['bg' => '#f1f5f9', 'text' => '#64748b', 'icon' => 'bi-circle'];
                                                @endphp
                                                <span class="badge rounded-pill border-0 d-inline-flex align-items-center fw-normal" 
                                                    style="background-color: {{ $conf['bg'] }}; color: {{ $conf['text'] }}; padding: 6px 12px; font-size: 0.8rem;">
                                                    <i class="bi {{ $conf['icon'] }} me-1" style="font-size: 0.75rem;"></i>
                                                    {{ $rk->Status_pengiriman }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-truck fs-1 opacity-25 mb-2"></i>
                                                    <p class="mb-0">Belum ada data pengiriman.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection