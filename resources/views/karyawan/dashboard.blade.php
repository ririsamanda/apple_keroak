@extends('layouts.karyawan')

{{-- CSS Kustom: Tema Modern & Elegan --}}
<style>
    /* PENTING: Definisi Warna dan Gradasi */
    :root {
        --color-primary-teal: #0d9488; /* Warna Aksen: Teal */
        --color-secondary-blue: #2563eb; /* Warna Pengiriman: Biru */
        --color-dark: #1e293b;
        
        /* Gradasi Konten Utama (Slate 100 ke Slate 200) - Lebih gelap */
        --bg-gradient-page: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); 
        
        /* Warna Status Modern */
        --status-success-bg: #dcfce7; --status-success-text: #15803d;
        --status-info-bg: #e0f2fe;    --status-info-text: #075985;
        --status-danger-bg: #fee2e2;  --status-danger-text: #991b1b;
        --status-secondary-bg: #f3f4f6;
    }

    /* 1. Kontainer Utama Gradasi */
    .dashboard-container {
        background: var(--bg-gradient-page);
        border-radius: 20px; /* Sudut membulat */
        padding: 2.5rem;
    }

    /* 2. Kartu Umum (Produksi & Pengiriman) */
    .card-dashboard {
        border: none;
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05), 0 1px 6px rgba(0, 0, 0, 0.03); 
        transition: all 0.3s ease;
    }
    
    .card-dashboard:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1), 0 3px 8px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    /* 3. Welcome Card (Mengganti Alert Primary) */
    .welcome-card-bg {
        background: linear-gradient(120deg, #10b981 0%, #0d9488 100%); /* Gradasi Hijau-Biru Tegas */
        color: white;
        border-radius: 18px;
        box-shadow: 0 10px 20px rgba(13, 148, 136, 0.3);
    }
    
    .welcome-card-bg .alert-heading {
        color: white !important;
        font-weight: 700;
    }

    /* 4. Table Styling */
    .table-modern thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #e2e8f0;
    }
    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    /* 5. Button Styling */
    .btn-action {
        border-radius: 12px;
        padding: 8px 16px;
        font-weight: 600;
        border-width: 2px !important;
        transition: all 0.3s ease;
    }
    .btn-action-primary {
        color: var(--color-primary-teal);
        border-color: var(--color-primary-teal);
    }
    .btn-action-primary:hover {
        background-color: var(--color-primary-teal);
        color: white;
    }
    .btn-action-success {
        color: var(--color-secondary-blue);
        border-color: var(--color-secondary-blue);
    }
    .btn-action-success:hover {
        background-color: var(--color-secondary-blue);
        color: white;
    }

</style>

@section('content')
<div class="row">
    <div class="col-md-12">
        {{-- Pembungkus Konten Utama dengan Gradasi --}}
        <div class="dashboard-container">
            
            {{-- SUCCESS ALERT --}}
            @if(session('success'))
            <div class="alert alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background: var(--status-success-bg); border: 1px solid #a7f3d0; color: var(--color-dark); border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3" style="color: var(--status-success-text);">
                        <i class="bi bi-check-lg fs-5"></i>
                    </div>
                    <div>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- WELCOME CARD (Menggantikan Alert Primary) --}}
            <div class="card mb-5 border-0 welcome-card-bg p-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle me-3 display-4 opacity-75"></i> 
                        <div>
                            <h4 class="alert-heading mb-1">Halo, {{ Auth::user()->Nama_karyawan }}!</h4>
                            <p class="mb-0 fs-6 opacity-90">Selamat bekerja. Di bawah ini adalah rekapitulasi data aktivitas yang baru saja Anda inputkan ke sistem.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- HEADER RIWAYAT --}}
            <h5 class="mb-4 text-secondary fw-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 1px;">
                <i class="bi bi-clock-history me-2" style="color: var(--color-primary-teal);"></i> Riwayat Input Saya (Terbaru)
            </h5>

            <div class="row">
                {{-- Riwayat Produksi --}}
                <div class="col-md-6 mb-4">
                    <div class="card card-dashboard h-100">
                        <div class="card-header bg-white fw-bold" style="color: var(--color-primary-teal); border-bottom: 2px solid var(--status-info-bg);">
                            <i class="bi bi-box-seam me-2"></i> Hasil Produksi Terakhir
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-modern mb-0 align-middle">
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
                                            <td>{{ $rp->Tanggal_produksi }}</td> {{-- TIDAK ADA PERUBAHAN FUNGSI --}}
                                            <td><span class="fw-bold">{{ $rp->produk->Nama_produk }}</span></td>
                                            <td>
                                                <span class="badge rounded-pill px-3 py-1 fw-normal" style="background-color: var(--status-info-bg); color: var(--status-info-text);">
                                                    {{ $rp->Jumlah_selesai }} {{ $rp->produk->Satuan }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-clipboard-data fs-1 opacity-25 mb-2"></i>
                                                    <p class="mb-0">Belum ada data produksi yang tercatat.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-3">
                            <a href="{{ route('produksi.create') }}" class="btn btn-action btn-outline-primary-custom w-100">
                                <i class="bi bi-plus-lg me-1"></i> Input Produksi Baru
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Riwayat Pengiriman --}}
                <div class="col-md-6 mb-4">
                    <div class="card card-dashboard h-100">
                        <div class="card-header bg-white fw-bold" style="color: var(--color-secondary-blue); border-bottom: 2px solid var(--status-secondary-bg);">
                            <i class="bi bi-truck me-2"></i> Pengiriman Terakhir
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-modern mb-0 align-middle">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Tujuan Pelanggan</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($riwayatPengiriman as $rk)
                                        <tr>
                                            <td>{{ $rk->Tanggal_kirim }}</td> {{-- TIDAK ADA PERUBAHAN FUNGSI --}}
                                            <td><span class="fw-bold">{{ $rk->pelanggan->Nama_pelanggan }}</span></td>
                                            <td class="text-center">
                                                @php
                                                    // Logika penentuan warna badge status, DILARANG MENGUBAH VALUE Status_pengiriman
                                                    $status = $rk->Status_pengiriman;
                                                    $style = match($status) {
                                                        'Selesai' => ['bg' => 'var(--status-success-bg)', 'text' => 'var(--status-success-text)', 'icon' => 'bi-check-circle-fill'],
                                                        'Proses'  => ['bg' => 'var(--status-info-bg)', 'text' => 'var(--status-info-text)', 'icon' => 'bi-arrow-repeat'],
                                                        'Batal'   => ['bg' => 'var(--status-danger-bg)', 'text' => 'var(--status-danger-text)', 'icon' => 'bi-x-circle-fill'],
                                                        default   => ['bg' => 'var(--status-secondary-bg)', 'text' => '#475569', 'icon' => 'bi-circle'],
                                                    };
                                                @endphp
                                                <span class="badge rounded-pill border-0 d-inline-flex align-items-center fw-normal" 
                                                    style="background-color: {{ $style['bg'] }}; color: {{ $style['text'] }}; padding: 6px 12px; font-size: 0.8rem;">
                                                    <i class="bi {{ $style['icon'] }} me-1" style="font-size: 0.75rem;"></i>
                                                    {{ $status }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-truck fs-1 opacity-25 mb-2"></i>
                                                    <p class="mb-0">Belum ada data pengiriman yang tercatat.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-3">
                            <a href="{{ route('pengiriman.create') }}" class="btn btn-action btn-outline-success-custom w-100">
                                <i class="bi bi-plus-lg me-1"></i> Input Pengiriman Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection