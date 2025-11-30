<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan - PT Apple Keroak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .sidebar { min-height: 100vh; background-color: #212529; color: white; } /* Warna beda dikit biar tahu bedanya */
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 10px 15px; display: block; }
        .sidebar a:hover, .sidebar .active { background-color: #0d6efd; color: white; }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar p-3" style="width: 250px;">
        <h4 class="mb-4 text-white">KARYAWAN</h4>
        <ul class="list-unstyled">
            <li>
                <a href="/karyawan/dashboard" class="{{ Request::is('karyawan/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="my-2 text-uppercase small text-muted fw-bold">Produksi</li>
            <li>
                <a href="{{ route('produksi.create') }}" class="{{ Request::is('karyawan/produksi*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam me-2"></i> Input Produksi
                </a>
            </li>
            <li class="my-2 text-uppercase small text-muted fw-bold">Pengiriman</li>
            <li>
                <a href="{{ route('pengiriman.create') }}" class="">
                    <i class="bi bi-truck me-2"></i> Input Pengiriman
                </a>
            </li>
        </ul>
        
        <hr class="text-secondary">
        
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 btn-sm">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>

    <div class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
            <span class="navbar-brand h1 mb-0">Area Produksi & Distribusi</span>
            <div class="ms-auto">
                Halo, <strong>{{ Auth::user()->Nama_karyawan }}</strong> <span class="badge bg-secondary">{{ Auth::user()->Jabatan }}</span>
            </div>
        </nav>

        <div class="p-4 bg-light" style="min-height: 90vh;">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>