<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #14a2ba 0%, #393c42ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            padding: 40px 0;
        }

        .reset-password-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .reset-password-card {
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

        .invalid-feedback {
            font-size: 0.85rem;
        }

        @media (max-width: 576px) {
            .reset-password-card {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="reset-password-container">
        <div class="reset-password-card">
            <!-- Logo/Header Section -->
            <div class="logo-section">
                <h2>Reset Password</h2>
                <p>Buat password baru untuk akun Anda</p>
            </div>

            <!-- Reset Password Form -->
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email', $request->email) }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="nama@example.com"
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        placeholder="Minimal 8 karakter"
                    >
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Ulangi password baru"
                    >
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-reset">
                    Reset Password
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>