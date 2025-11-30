<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Apple Keroak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            /* Background Gradasi Biru Muda (Sesuai tema Inventory Management) */
            background: linear-gradient(135deg, #e0eaec 0%, #cbdae2 100%);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            border: none;
            border-radius: 20px; /* Sudut melengkung */
            box-shadow: 0 15px 35px rgba(30, 58, 86, 0.1); /* Bayangan halus */
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            background: #fff;
        }

        .card-header-custom {
            background: transparent;
            padding-bottom: 0;
            text-align: center;
        }

        h3 {
            color: #1e3a56; /* Warna Biru Dongker (Sesuai Sidebar di foto) */
            font-weight: 600;
            margin-bottom: 5px;
        }

        p.subtitle {
            color: #7b8ca0;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-label {
            color: #1e3a56;
            font-weight: 500;
            font-size: 14px;
            margin-left: 5px;
        }

        .form-control {
            background-color: #f3f6f9; /* Abu-abu sangat muda */
            border: 1px solid #e1e5eb;
            height: 50px;
            border-radius: 12px; /* Input melengkung */
            padding-left: 20px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #1e3a56;
            box-shadow: 0 0 0 4px rgba(30, 58, 86, 0.1);
        }

        .btn-primary {
            background-color: #1e3a56; /* Warna Tombol Biru Gelap */
            border: none;
            height: 50px;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-top: 10px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #162d45;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 58, 86, 0.3);
        }

        /* Styling Alert Error */
        .alert-danger {
            border-radius: 12px;
            background-color: #ffe5e5;
            border-color: #ffcccc;
            color: #cc0000;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-card p-4 p-md-5">
        <div class="card-header-custom">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="60" class="mb-3" alt="User Icon">
            <h3>LOGIN SYSTEM</h3>
            <p class="subtitle">PT Apple Keroak Inventory</p>
        </div>

        @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i> {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="/login" method="post">
            @csrf 
            
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="Username" class="form-control" id="username" placeholder="Masukkan username" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="Password" class="form-control" id="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">LOGIN</button>
            
            <div class="text-center mt-4">
                <small class="text-muted">&copy; 2025 Inventory Management</small>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>