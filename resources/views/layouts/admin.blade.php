<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Apple Keroak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .sidebar { min-height: 100vh; background-color: #343a40; color: white; }
        .sidebar a { color: white; text-decoration: none; padding: 10px 15px; display: block; }
        .sidebar a:hover { background-color: #495057; }
        .sidebar .active { background-color: #0d6efd; }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar p-3" style="width: 250px;">
        <h4 class="mb-4">ADMINISTRASI</h4>
        <ul class="list-unstyled">
            <li>
                <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>
            
            <li>
                <a href="/admin/karyawan" class="{{ Request::is('admin/karyawan*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Data Karyawan
                </a>
            </li>

            <li>
                <a href="/admin/produk" class="{{ Request::is('admin/produk*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam me-2"></i> Data Produk
                </a>
            </li>

            <li>
                <a href="/admin/pelanggan" class="{{ Request::is('admin/pelanggan*') ? 'active' : '' }}">
                    <i class="bi bi-person-vcard me-2"></i> Data Pelanggan
                </a>
            </li>

            <li>
                <a href="/admin/laporan" class="{{ Request::is('admin/laporan*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text me-2"></i> Laporan (Report)
                </a>
            </li>
        </ul>
        
        <hr>
        
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
    <div class="w-100">
        <nav class="navbar navbar-light bg-light border-bottom px-4">
            <span class="navbar-brand mb-0 h1">Sistem Inventory</span>
            <div class="d-flex align-items-center">
                <span class="me-3">Halo, <strong>{{ Auth::user()->Nama_karyawan }}</strong></span>
                <i class="bi bi-person-circle fs-4"></i>
            </div>
        </nav>

        <div class="p-4">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>