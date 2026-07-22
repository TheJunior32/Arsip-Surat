<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Arsip Surat</title>
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

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
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

        .btn-login {
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

        .btn-login:hover {
            background: #3d36a0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 68, 189, 0.3);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .form-check-input:checked {
            background-color: #4e44bdff;
            border-color: #4e44bdff;
        }

        .form-check-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .forgot-password {
            color: #4e44bdff;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #3d36a0;
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 20px 0 0 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .invalid-feedback {
            font-size: 0.85rem;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 25px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo/Header Section -->
            <div class="logo-section">
                <h2>Arsip Surat</h2>
                <p>Silakan login untuk melanjutkan</p>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Firebase Error Alert (JS akan isi ini kalau login gagal) -->
            <div id="firebase-error" class="alert alert-danger mb-4" role="alert" style="display: none;"></div>

            <!-- Login Form -->
            <form id="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        placeholder="nama@example.com">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Masukkan password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label" for="remember_me">
                            Ingat Saya
                        </label>
                    </div>

                    <!-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Lupa Password?
                        </a>
                    @endif -->
                </div>

                <!-- Submit Button -->
                <button type="submit" id="login-btn" class="btn btn-login">
                    Masuk
                </button>

                <!-- Register Link -->
                <!-- <div class="divider">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="forgot-password">Daftar di sini</a>
                </div> -->
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Firebase SDK -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-app.js";
        import {
            getAuth,
            signInWithEmailAndPassword
        } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-auth.js";

        // TODO: Ganti dengan config dari Firebase Console
        // Project Settings > General > Your apps > SDK setup and configuration
        const firebaseConfig = {
            apiKey: "AIzaSyD30PvH0OV44h6wbdJTMSsEBaE2Su5IIIM",
            authDomain: "arsip-persuratan-pln.firebaseapp.com",
            projectId: "arsip-persuratan-pln",
            storageBucket: "arsip-persuratan-pln.firebasestorage.app",
            messagingSenderId: "774646196774",
            appId: "1:774646196774:web:bf6625a72915f85758d4e7",
            measurementId: "G-F21D1PHKRT"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        const form = document.getElementById('login-form');
        const btn = document.getElementById('login-btn');
        const errorBox = document.getElementById('firebase-error');

        function showError(message) {
            errorBox.textContent = message;
            errorBox.style.display = 'block';
        }

        function hideError() {
            errorBox.style.display = 'none';
        }

        function mapFirebaseError(code) {
            switch (code) {
                case 'auth/invalid-email':
                    return 'Format email tidak valid.';
                case 'auth/user-not-found':
                case 'auth/wrong-password':
                case 'auth/invalid-credential':
                    return 'Email atau password salah.';
                case 'auth/too-many-requests':
                    return 'Terlalu banyak percobaan gagal. Coba lagi nanti.';
                default:
                    return 'Terjadi kesalahan saat login. Silakan coba lagi.';
            }
        }

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            hideError();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            btn.disabled = true;
            btn.textContent = 'Memproses...';

            try {
                // 1. Login ke Firebase
                const userCredential = await signInWithEmailAndPassword(auth, email, password);
                const idToken = await userCredential.user.getIdToken();

                // 2. Kirim token ke Laravel untuk verifikasi & login session
                const csrfToken = document.querySelector('input[name="_token"]').value;

                const response = await fetch("{{ route('login.firebase') }}", {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + idToken,
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal login ke server.');
                }

                const data = await response.json();

                // 3. Redirect ke dashboard
                window.location.href = data.redirect;

            } catch (error) {
                console.error(error);

                if (error.code) {
                    showError(mapFirebaseError(error.code));
                } else {
                    showError('Terjadi kesalahan. Silakan coba lagi.');
                }

                btn.disabled = false;
                btn.textContent = 'Masuk';
            }
        });
    </script>
</body>

</html>