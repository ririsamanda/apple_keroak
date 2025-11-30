<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan - PT Apple Keroak</title>
    
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

        /* --- 1. SIDEBAR NAVY (Style Admin) --- */
        .sidebar {
            width: 280px;
            background-color: #1e3a56; /* Warna Navy Utama */
            min-height: 100vh;
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

        /* Profil User di Sidebar (Seperti Gambar Kiri) */
        .sidebar-profile {
            text-align: center;
            padding: 20px 0 30px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .profile-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.1);
            padding: 3px;
            margin-bottom: 10px;
            object-fit: cover;
        }

        .brand-text {
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .user-name { font-weight: 600; font-size: 1rem; color: #fff; }
        .user-role { 
            font-size: 0.75rem; 
            color: #a5b4fc; 
            background: rgba(255,255,255,0.1); 
            padding: 3px 12px; 
            border-radius: 20px; 
        }

        /* Label Kategori Menu */
        .menu-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            margin-top: 15px;
            padding-left: 15px;
        }

        /* Link Menu */
        .sidebar-link {
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 12px 20px;
            margin-bottom: 5px;
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
            background-color: rgba(255,255,255,0.1);
            color: #fff;
            transform: translateX(5px);
        }

        /* State Active (Putih) */
        .sidebar-link.active {
            background-color: #ffffff;
            color: #1e3a56; /* Teks jadi Navy */
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            font-weight: 600;
        }
        
        .sidebar-link.active i { color: #1e3a56; }

        /* Logout Button */
        .logout-container { margin-top: auto; }
        
        .btn-logout-custom {
            background-color: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
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

        /* --- 2. MAIN WRAPPER --- */
        .main-wrapper {
            margin-left: 280px;
            padding: 30px;
            transition: all 0.3s;
        }

        /* Top Navbar Simple */
        .top-navbar {
            background: white;
            padding: 15px 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title { margin: 0; font-weight: 600; color: #1e3a56; font-size: 1.1rem; }

        @media (max-width: 992px) {
            .sidebar { margin-left: -280px; }
            .main-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        
        <div class="sidebar-profile">
            <div class="brand-text mb-3"><i class="bi bi-apple me-1"></i> APPLE KEROAK</div>
            
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->Nama_karyawan) }}&background=334155&color=fff&size=128" 
                 class="profile-img" alt="User">
            
            <div class="user-name">{{ Auth::user()->Nama_karyawan }}</div>
            <span class="user-role">{{ Auth::user()->Jabatan }}</span>
        </div>
        
        <div class="d-flex flex-column flex-grow-1">
            
            <div class="menu-label">Overview</div>
            
            <a href="/karyawan/dashboard" class="sidebar-link {{ Request::is('karyawan/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-label">Produksi</div>

            <a href="{{ route('produksi.create') }}" class="sidebar-link {{ Request::is('karyawan/produksi*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Input Produksi</span>
            </a>

            <div class="menu-label">Logistik</div>

            <a href="{{ route('pengiriman.create') }}" class="sidebar-link {{ Request::is('karyawan/pengiriman*') ? 'active' : '' }}">
                <i class="bi bi-truck"></i>
                <span>Input Pengiriman</span>
            </a>

        </div>
        
        <div class="logout-container">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-logout-custom w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-power me-2"></i> Logout System
                </button>
            </form>
        </div>
    </div>

    <div class="main-wrapper">
        
        <nav class="top-navbar">
            <h1 class="page-title">Area Operasional</h1>
            <div class="text-muted small">
                <i class="bi bi-calendar3 me-1"></i> {{ date('l, d F Y') }}
            </div>
        </nav>

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>