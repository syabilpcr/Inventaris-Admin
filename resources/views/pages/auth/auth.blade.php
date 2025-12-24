<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Inventaris & Aset - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @include('layouts.admin.css')

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url("/images/BG_admin4.jpg");
            background-size: 100% auto;
            /* FULL lebar, tidak zoom */
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #1b3c53;
            /* warna sisa area */
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .auth-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-card {
            display: flex;
            width: 90%;
            max-width: 1100px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            background: white;
        }

        .auth-left {
            background: #1b3c53;
            color: white;
            flex: 1.2;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            border-right: 1px solid #456882;
        }

        .auth-right {
            background: #f9f3ef;
            flex: 1;
            padding: 40px 45px;
        }

        .logo-container {
            width: 200px;
            height: 200px;
            margin: auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            border: 2px solid #456882;
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-text h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin: 15px 0 0;
        }

        .logo-text h2 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #d2c1b6;
            margin-top: 5px;
        }

        .illustration img {
            width: 95px;
            height: 95px;
            filter: brightness(0) invert(1);
        }

        .form-container {
            max-width: 380px;
            margin: auto;
        }

        .form-toggle {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e2e8f0;
            background: #f9f3ef;
            border-radius: 10px;
            padding: 5px;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: #64748b;
            font-weight: 600;
            font-size: 1rem;
            padding: 12px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            border-radius: 8px;
            flex: 1;
            margin: 0 2px;
        }

        .toggle-btn.active {
            color: #1b3c53;
            background: white;
            box-shadow: 0 2px 8px rgba(27, 60, 83, 0.15);
        }

        .form-panel {
            display: none;
            animation: fadeIn 0.5s ease forwards;
        }

        .form-panel.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-title {
            font-weight: 700;
            margin-bottom: 10px;
            color: #1b3c53;
            font-size: 1.5rem;
        }

        .form-subtitle {
            color: #64748b;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #374151;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #d2c1b6;
            border-radius: 8px;
            transition: all 0.3s;
            font-size: 15px;
            background: #f9f3ef;
        }

        .form-control:focus {
            border-color: #456882;
            box-shadow: 0 0 0 3px rgba(69, 104, 130, 0.1);
            outline: none;
            background: white;
        }

        .btn-auth {
            background: #456882;
            color: white;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            transition: all 0.3s ease;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(69, 104, 130, 0.3);
        }

        .btn-auth:hover {
            background: #1b3c53;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27, 60, 83, 0.4);
        }

        .auth-switch {
            text-align: center;
            margin-top: 25px;
            color: #64748b;
            font-size: 0.9rem;
        }

        .auth-switch a {
            color: #456882;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-switch a:hover {
            color: #1b3c53;
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: none;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .form-check-input:checked {
            background-color: #456882;
            border-color: #456882;
        }

        .form-check-label {
            color: #374151;
            font-size: 0.9rem;
        }

        .mini-logo-container {
            border-radius: 12px;
            width: 60px;
            height: 60px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(27, 60, 83, 0.3);
            margin: auto;
            border: 2px solid #d2c1b6;
        }

        .mini-logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Fitur list styling */
        .feature-item {
            color: #d2c1b6;
            margin-bottom: 10px;
        }

        .feature-item i {
            color: #456882;
        }
    </style>
</head>

<body>

    <div class="auth-container">
        <div class="auth-card">

            <!-- LEFT -->
            <div class="auth-left">
                <div>

                    <div class="logo-container mb-3">
                        <img src="{{ asset('images/Logo_Besmindo.jpg') }}" alt="Logo Besmindo">
                    </div>
                    <h2 style="font-size: 1.3rem; font-weight: 600; color: white; margin-bottom: 20px;">PT. BESMINDO</h2>
                    <div class="logo-text mb-4">
                        <h1>Inventory System</h1>
                        <h2>Inventaris & Aset</h2>
                    </div>

                    <div class="text-start mt-4">
                        
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="auth-right">
                <div class="form-container">
                    <div class="text-center mb-4">
                        <div class="mini-logo-container">
                            <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?auto=format&fit=crop&w=600&q=80">
                        </div>
                        <h4 class="mt-2" style="font-weight: 700; color: #1b3c53;">PT. BESMINDO</h4>
                        <p style="color: #64748b; margin: 0;">Sistem Inventaris & Aset</p>
                    </div>

                    <div class="form-toggle">
                        <button class="toggle-btn active" data-form="login">Masuk</button>
                        <button class="toggle-btn" data-form="register">Daftar</button>
                    </div>

                    <!-- LOGIN FORM -->
                    <div class="form-panel active" id="login-form">
                        <h2 class="form-title">Masuk ke Akun</h2>
                        <p class="form-subtitle">Selamat datang kembali! Masuk untuk melanjutkan.</p>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div class="form-group">
                                <label for="login_email" class="form-label">Email</label>
                                <input type="email" name="email" id="login_email" value="{{ old('email') }}" required
                                    class="form-control" placeholder="Masukkan email Anda">
                            </div>
                            <div class="form-group">
                                <label for="login_password" class="form-label">Password</label>
                                <input type="password" name="password" id="login_password" required class="form-control"
                                    placeholder="Masukkan password Anda">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Ingat saya</label>
                                </div>
                            </div>
                            <button type="submit" class="btn-auth">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                            </button>
                        </form>
                        <div class="auth-switch">
                            Belum punya akun? <a href="#" class="switch-to-register">Daftar Sekarang</a>
                        </div>
                    </div>

                    <!-- REGISTER FORM -->
                    <div class="form-panel" id="register-form">
                        <h2 class="form-title">Buat Akun Baru</h2>
                        <p class="form-subtitle">Daftar untuk mulai mengelola inventaris Anda.</p>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif

                        <form method="POST" action="{{ route('register.post') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required
                                    value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required
                                    value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Buat password (minimal 8 karakter)" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Ulangi password" required>
                            </div>
                            <button type="submit" class="btn-auth btn-register">
                                <i class="bi bi-person-plus me-2"></i>Daftar
                            </button>
                        </form>
                        <div class="auth-switch">
                            Sudah punya akun? <a href="#" class="switch-to-login">Masuk Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtns = document.querySelectorAll('.toggle-btn');
            const formPanels = document.querySelectorAll('.form-panel');
            const switchToRegister = document.querySelector('.switch-to-register');
            const switchToLogin = document.querySelector('.switch-to-login');

            // Toggle between forms
            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetForm = this.getAttribute('data-form');

                    // Update active toggle button
                    toggleBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    // Show target form
                    formPanels.forEach(panel => {
                        panel.classList.remove('active');
                        if (panel.id === targetForm + '-form') {
                            setTimeout(() => panel.classList.add('active'), 50);
                        }
                    });
                });
            });

            // Switch from login to register
            if (switchToRegister) {
                switchToRegister.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector('.toggle-btn[data-form="register"]').click();
                });
            }

            // Switch from register to login
            if (switchToLogin) {
                switchToLogin.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector('.toggle-btn[data-form="login"]').click();
                });
            }

            // Add input animations
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.transform = 'scale(1.02)';
                });
                input.addEventListener('blur', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>

</body>

</html>