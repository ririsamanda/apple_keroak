<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Apple Keroak</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* --- 1. SIDEBAR PROFESSIONAL (Fixed & Scrollable) --- */
        .sidebar {
            width: 280px;
            background-color: #0f172a; /* Dark Navy Premium */
            height: 100vh; /* PENTING: Gunakan height fix agar bisa di-scroll */
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            box-shadow: 5px 0 15px rgba(0,0,0,0.05);
            padding: 20px;
            color: #fff;
            transition: all 0.3s;
        }

        /* Profil User (Fixed di Atas) */
        .sidebar-profile {
            text-align: center;
            padding: 10px 0 20px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 10px;
            flex-shrink: 0; /* Agar tidak mengecil saat menu di-scroll */
        }

        .profile-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.1);
            padding: 3px;
            margin-bottom: 10px;
            transition: 0.3s;
        }
        
        .profile-img:hover { border-color: #fff; transform: scale(1.05); }

        .brand-text {
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .user-name { font-weight: 600; font-size: 1rem; color: #fff; }
        .user-role { font-size: 0.75rem; color: #64748b; background: rgba(255,255,255,0.05); padding: 2px 10px; border-radius: 20px; }

        /* --- AREA MENU SCROLLABLE --- */
        .sidebar-menu {
            flex-grow: 1; /* Mengisi sisa ruang kosong */
            overflow-y: auto; /* Aktifkan scroll vertikal */
            overflow-x: hidden; /* Sembunyikan scroll horizontal */
            padding-right: 5px; /* Jarak agar scrollbar tidak nempel */
            margin-right: -10px; /* Trik agar scrollbar agak ke kanan */
        }

        /* Custom Scrollbar (Agar terlihat rapi) */
        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-menu::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Label Kategori Menu */
        .menu-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #475569;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            margin-top: 15px; /* Tambah jarak antar kategori */
            padding-left: 15px;
        }

        /* Link Menu */
        .sidebar-link {
            display: flex;
            align-items: center;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 20px;
            margin-bottom: 8px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            width: 25px;
            margin-right: 10px;
            text-align: center;
        }

        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.08);
            color: #fff;
            transform: translateX(5px);
        }

        /* ACTIVE STATE */
        .sidebar-link.active {
            background-color: #ffffff;
            color: #0f172a;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            font-weight: 600;
        }
        .sidebar-link.active i { color: #0f172a; }

        /* Tombol Logout (Fixed di Bawah) */
        .logout-container { 
            margin-top: auto; 
            padding-top: 20px;
            flex-shrink: 0; /* Agar tidak ikut mengecil/hilang */
        }
        
        .btn-logout-custom {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: none;
            font-weight: 500;
            padding: 12px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .btn-logout-custom:hover {
            background-color: #ef4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* --- 2. MAIN CONTENT --- */
        .main-wrapper {
            margin-left: 280px;
            padding: 30px;
            transition: all 0.3s;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-heading h3 { font-weight: 700; color: #1e293b; margin: 0; }
        .page-subheading { color: #64748b; font-size: 0.9rem; }

        @media (max-width: 992px) {
            .sidebar { margin-left: -280px; }
            .main-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        
        <!-- 1. Profil (Fixed) -->
        <div class="sidebar-profile">
            <div class="brand-text mb-3"><i class="bi bi-apple me-1"></i> APPLE KEROAK</div>
            
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->Nama_karyawan) }}&background=334155&color=fff&size=128" 
                 class="profile-img" alt="User">
            
            <div class="user-name">{{ Auth::user()->Nama_karyawan }}</div>
            <span class="user-role">Administrator</span>
        </div>
        
        <!-- 2. Menu List (Scrollable) -->
        <div class="sidebar-menu">
            
            <div class="menu-label" style="margin-top: 0;">Overview</div>
            
            <a href="/admin/dashboard" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-label">Master Data</div>

            <a href="/admin/karyawan" class="sidebar-link {{ Request::is('admin/karyawan*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Data Karyawan</span>
            </a>

            <a href="/admin/produk" class="sidebar-link {{ Request::is('admin/produk*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i>
                <span>Data Produk</span>
            </a>

            <a href="/admin/pelanggan" class="sidebar-link {{ Request::is('admin/pelanggan*') ? 'active' : '' }}">
                <i class="bi bi-person-vcard-fill"></i>
                <span>Data Pelanggan</span>
            </a>

            <div class="menu-label">Report</div>

            <a href="/admin/laporan" class="sidebar-link {{ Request::is('admin/laporan*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                <span>Laporan</span>
            </a>

            <!-- Contoh Menu Tambahan untuk Test Scroll (Opsional) -->
            <!-- 
            <div class="menu-label">Settings</div>
            <a href="#" class="sidebar-link"><i class="bi bi-gear-fill"></i> <span>Konfigurasi</span></a>
            <a href="#" class="sidebar-link"><i class="bi bi-shield-lock-fill"></i> <span>Keamanan</span></a>
            -->

        </div>
        
        <!-- 3. Logout (Fixed) -->
        <div class="logout-container">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-logout-custom w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-power me-2"></i> Logout System
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">
        
        <div class="top-header">
            <div>
                <div class="page-heading">
                    <h3>@yield('title', 'Dashboard')</h3>
                </div>
                <div class="page-subheading">Selamat datang kembali, {{ Auth::user()->Nama_karyawan }}!</div>
            </div>
            
            <div class="d-none d-md-block bg-white px-3 py-2 rounded-pill shadow-sm text-muted" style="font-size: 0.9rem;">
                <i class="bi bi-calendar3 me-2"></i> {{ date('l, d F Y') }}
            </div>
        </div>

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>