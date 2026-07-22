<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Arsip Surat</title>
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

        .verify-email-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .verify-email-card {
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

        .btn-verify {
            background: #4e44bdff;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-verify:hover {
            background: #3d36a0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 68, 189, 0.3);
        }

        .btn-logout {
            background: transparent;
            color: #6c757d;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-logout:hover {
            border-color: #dc3545;
            color: #dc3545;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        @media (max-width: 576px) {
            .verify-email-card {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="verify-email-container">
        <div class="verify-email-card">
            <!-- Logo/Header Section -->
            <div class="logo-section">
                <h2>Verifikasi Email</h2>
                <p>Konfirmasi alamat email Anda</p>
            </div>

            <!-- Info Text -->
            <div class="info-text">
                Terima kasih sudah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan. Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan ulang.
            </div>

            <!-- Success Alert -->
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success mb-4" role="alert">
                    Link verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.
                </div>
            @endif

            <!-- Resend Verification Form -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-verify">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout">
                    Keluar
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>