<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #14a2ba 0%, #393c42ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .forgot-password-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .forgot-password-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-section h2 {
            color: #393c42ff;
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 8px;
        }

        .logo-section p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .info-text {
            background: #f8f9fa;
            border-left: 4px solid #4e44bdff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 0.9rem;
            color: #6c757d;
            line-height: 1.6;
        }

        .form-label {
            font-weight: 600;
            color: #393c42ff;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4e44bdff;
            box-shadow: 0 0 0 0.2rem rgba(78, 68, 189, 0.15);
        }

        .btn-reset {
            background: #4e44bdff;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-reset:hover {
            background: #3d36a0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 68, 189, 0.3);
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .back-to-login a {
            color: #4e44bdff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-to-login a:hover {
            color: #3d36a0;
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .invalid-feedback {
            font-size: 0.85rem;
        }

        @media (max-width: 576px) {
            .forgot-password-card {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <div class="forgot-password-card">
            <!-- Logo/Header Section -->
            <div class="logo-section">
                <h2>Lupa Password?</h2>
                <p>Reset password akun Anda</p>
            </div>

            <!-- Info Text -->
            <div class="info-text">
                Tidak masalah! Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Forgot Password Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        placeholder="nama@example.com"
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-reset">
                    Kirim Link Reset Password
                </button>

                <!-- Back to Login -->
                <div class="back-to-login">
                    Kembali ke <a href="{{ route('login') }}">Halaman Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>