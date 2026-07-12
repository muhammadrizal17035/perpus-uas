<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SI Perpustakaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
        }
        .login-wrap {
            display: flex;
            min-height: 100vh;
        }

        /* Sisi kiri - branding gelap */
        .login-side {
            flex: 1;
            background: #0f172a;
            background-image:
                radial-gradient(circle at 20% 20%, rgba(37,99,235,.25), transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(59,130,246,.15), transparent 40%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
        }
        .login-side .brand-icon {
            width: 56px; height: 56px;
            background: #2563eb;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 28px;
        }
        .login-side h2 {
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: -.02em;
            margin-bottom: 14px;
        }
        .login-side p {
            color: #94a3b8;
            font-size: .95rem;
            max-width: 380px;
            line-height: 1.6;
        }
        .login-side .feature-list {
            margin-top: 36px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .login-side .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            font-size: .88rem;
        }
        .login-side .feature-item i {
            color: #3b82f6;
            font-size: 1.1rem;
        }

        /* Sisi kanan - form */
        .login-form-side {
            width: 460px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 56px;
        }
        .login-form-side h3 {
            font-weight: 800;
            font-size: 1.5rem;
            color: #0f172a;
            margin-bottom: 6px;
        }
        .login-form-side .subtitle {
            color: #64748b;
            font-size: .88rem;
            margin-bottom: 32px;
        }
        .form-label {
            font-weight: 600;
            font-size: .82rem;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: .9rem;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }
        .input-group-icon {
            position: relative;
        }
        .input-group-icon i {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        .input-group-icon .form-control {
            padding-left: 40px;
        }
        .btn-login {
            background: #2563eb;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
            font-size: .92rem;
            color: #fff;
            width: 100%;
            transition: .15s;
        }
        .btn-login:hover {
            background: #1d4ed8;
        }
        .alert-danger {
            border-radius: 10px;
            font-size: .85rem;
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        @media (max-width: 900px) {
            .login-side { display: none; }
            .login-form-side { width: 100%; }
        }
    </style>
</head>
<body>

<div class="login-wrap">
    <div class="login-side">
        <div class="brand-icon"><i class="bi bi-book-half"></i></div>
        <h2>SI Perpustakaan</h2>
        <p>Kelola data buku, anggota, dan peminjaman perpustakaan dalam satu sistem yang cepat dan rapi.</p>

        <div class="feature-list">
            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Manajemen data buku &amp; stok</div>
            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Pencatatan peminjaman real-time</div>
            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Laporan otomatis &amp; terstruktur</div>
        </div>
    </div>

    <div class="login-form-side">
        <h3>Selamat Datang</h3>
        <div class="subtitle">Masuk ke akun admin untuk melanjutkan</div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group-icon">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="nama@perpus.com" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group-icon">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>
    </div>
</div>

</body>
</html>