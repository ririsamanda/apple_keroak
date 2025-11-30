@extends('layouts.admin')

@section('title', 'Dashboard Profesional')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Styling Dashboard */
    .dashboard-header {
        background: linear-gradient(135deg, #1e3a56 0%, #2c537a 100%);
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
    }

    .card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .icon-square {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 15px;
    }

    .stat-label { font-size: 0.85rem; color: #7b8ca0; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-value { font-size: 1.8rem; font-weight: 700; color: #1e3a56; }
    
    .bg-light-primary { background: #e3f2fd; color: #1565c0; }
    .bg-light-success { background: #e8f5e9; color: #2e7d32; }
    .bg-light-warning { background: #fff8e1; color: #f9a825; }

    /* Chart Container Full Width */
    .chart-container {
        position: relative; 
        height: 400px; /* Tinggi diperbesar sedikit agar proporsional */
        width: 100%;
    }
</style>

<div class="container-fluid p-0">
    
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1">Selamat Datang, Admin!</h2>
            <p class="mb-0 opacity-75">Ringkasan aktivitas produksi dan inventory hari ini.</p>
        </div>
        <div class="d-none d-md-block text-end">
            <h5 class="fw-bold mb-0">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</h5>
            <small class="opacity-75">System v1.0</small>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="card-modern p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-1">Total Produksi</div>
                        <div class="stat-value">{{ $prodTahun }} <span class="fs-6 text-muted fw-normal">Unit</span></div>
                        <div class="mt-3 badge bg-light-primary rounded-pill px-3 py-2">
                            <i class="bi bi-arrow-up-short"></i> Hari ini: <b>{{ $prodHari }}</b>
                        </div>
                    </div>
                    <div class="icon-square bg-light-primary">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card-modern p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-1">Total Pengiriman</div>
                        <div class="stat-value">{{ $kirimTahun }} <span class="fs-6 text-muted fw-normal">Kali</span></div>
                        <div class="mt-3 badge bg-light-success rounded-pill px-3 py-2">
                            <i class="bi bi-truck"></i> Bulan ini: <b>{{ $kirimBulan }}</b>
                        </div>
                    </div>
                    <div class="icon-square bg-light-success">
                        <i class="bi bi-send"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card-modern p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-1">Total SDM</div>
                        <div class="stat-value">{{ $totalKaryawan }} <span class="fs-6 text-muted fw-normal">Orang</span></div>
                        <div class="mt-3 text-muted small">
                            Semua karyawan aktif
                        </div>
                    </div>
                    <div class="icon-square bg-light-warning">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12"> <div class="card-modern p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-navy mb-0">Statistik Produksi 6 Bulan Terakhir</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-4">
                        Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="chart-container">
                    <canvas id="productionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('productionChart').getContext('2d');
        
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(30, 58, 86, 0.2)');
        gradient.addColorStop(1, 'rgba(30, 58, 86, 0)');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Juni', 'Juli', 'Agustus', 'Sept', 'Okt', 'Nov'],
                datasets: [{
                    label: 'Jumlah Produksi',
                    data: [120, 190, 150, 250, 220, {{ $prodBulan }}],
                    backgroundColor: gradient,
                    borderColor: '#1e3a56',
                    borderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#1e3a56',
                    pointRadius: 5, // Titik sedikit diperbesar
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e3a56',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [2, 4], color: '#f0f0f0' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endsection