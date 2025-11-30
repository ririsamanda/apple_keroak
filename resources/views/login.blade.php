<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Apple Keroak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-card { max-width: 400px; margin: 100px auto; }
    </style>
</head>
<body>

<div class="container">
    <div class="card login-card shadow">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">LOGIN SYSTEM</h3>

            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="/login" method="post">
                @csrf <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="Username" class="form-control" id="username" placeholder="Masukkan username" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="Password" class="form-control" id="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">LOGIN</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>