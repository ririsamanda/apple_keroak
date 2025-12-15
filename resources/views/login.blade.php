<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Apple Keroak</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f0f4f8;
            background-image: radial-gradient(#d1d5db 1px, transparent 1px);
            background-size: 20px 20px;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            border: none;
            border-radius: 24px; 
            box-shadow: 0 20px 50px rgba(30, 58, 86, 0.15); 
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            background: #fff;
            position: relative;
        }

        .login-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 6px;
            background: #1e3a56; 
        }

        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-icon {
            font-size: 2.5rem;
            color: #1e3a56;
            background: #e3f2fd;
            width: 70px; height: 70px;
            line-height: 70px;
            border-radius: 50%;
            display: inline-block;
            margin-bottom: 15px;
        }

        h3 {
            color: #1e3a56;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        p.subtitle {
            color: #64748b;
            font-size: 0.9rem;
        }

        .input-group-text {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-right: none;
            color: #1e3a56;
            border-radius: 12px 0 0 12px;
        }

        .form-control {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: none;
            height: 50px;
            border-radius: 0 12px 12px 0;
            font-size: 0.95rem;
            color: #334155;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #1e3a56;
            box-shadow: none;
        }
        
        .form-control:focus + .input-group-text, 
        .input-group:focus-within .input-group-text {
            background-color: #fff;
            border-color: #1e3a56;
        }

        .form-label {
            color: #1e3a56;
            font-weight: 600;
            font-size: 0.85rem;
            margin-left: 5px;
        }

        .btn-primary {
            background-color: #1e3a56;
            border: none;
            height: 50px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(30, 58, 86, 0.2);
        }

        .btn-primary:hover {
            background-color: #162d45;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 58, 86, 0.3);
        }

        .alert-danger {
            border-radius: 12px;
            font-size: 0.9rem;
            border: none;
            background-color: #fee2e2;
            color: #b91c1c;
        }
    </style>
</head>
<body>

    <div class="login-card p-4 p-md-5">
        
        <div class="header-section">
            <div class="brand-icon">
                <i class="bi bi-apple"></i>
            </div>
            <h3>Welcome!</h3>
            <p class="subtitle">Silakan login untuk masuk ke sistem.</p>
        </div>

        @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div>
                    {{ session('loginError') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="/login" method="post">
            @csrf 
            
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="Username" class="form-control" id="username" placeholder="Masukkan username Anda" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="Password" class="form-control" id="password" placeholder="Masukkan password Anda" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2">
                MASUK SISTEM <i class="bi bi-arrow-right-short ms-1"></i>
            </button>
            
            <div class="text-center mt-4">
                <small class="text-muted" style="font-size: 0.8rem;">
                    &copy; 2025 PT Apple Keroak Inventory <br> Version 1.0
                </small>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>