@extends('layouts.admin')

@section('title', 'Dashboard Rekapitulasi')

@section('content')
    <h3 class="mb-4">DASHBOARD REKAPITULASI</h3>
    <p class="text-muted">Pantauan aktivitas produksi dan pengiriman periode Hari, Bulan, dan Tahun ini.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm mb-4 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0"><i class="bi bi-box-seam me-2"></i> Hasil Produksi</h5>
                        <i class="bi bi-graph-up fs-4"></i>
                    </div>
                    <hr class="border-light">
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Hari Ini:</span> 
                        <span class="fw-bold fs-5">{{ $prodHari }} Unit</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Bulan Ini:</span> 
                        <span class="fw-bold fs-5">{{ $prodBulan }} Unit</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Tahun Ini:</span> 
                        <span class="fw-bold fs-5">{{ $prodTahun }} Unit</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm mb-4 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0"><i class="bi bi-truck me-2"></i> Pengiriman</h5>
                        <i class="bi bi-send fs-4"></i>
                    </div>
                    <hr class="border-light">
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Hari Ini:</span> 
                        <span class="fw-bold fs-5">{{ $kirimHari }} Kali</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Bulan Ini:</span> 
                        <span class="fw-bold fs-5">{{ $kirimBulan }} Kali</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Tahun Ini:</span> 
                        <span class="fw-bold fs-5">{{ $kirimTahun }} Kali</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-dark shadow-sm mb-4 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0"><i class="bi bi-people-fill me-2"></i> Total Karyawan</h5>
                        <i class="bi bi-person-badge fs-4"></i>
                    </div>
                    <hr class="border-dark">
                    <div class="text-center py-3">
                        <h1 class="display-4 fw-bold">{{ $totalKaryawan }}</h1>
                        <span>Orang Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection