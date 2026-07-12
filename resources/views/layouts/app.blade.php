<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SI Perpustakaan')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark: #0f172a;
            --dark-2: #1e293b;
            --accent: #2563eb;
            --accent-2: #3b82f6;
            --bg-soft: #f1f5f9;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-soft);
            margin: 0;
            color: #0f172a;
        }
        .sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 250px;
            background: var(--dark);
            color: #cbd5e1;
            padding: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #1e293b;
        }
        .sidebar .brand {
            font-weight: 700;
            font-size: 1.05rem;
            color: #fff;
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #1e293b;
        }
        .sidebar .brand .brand-icon {
            width: 34px; height: 34px;
            background: var(--accent);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
        }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .sidebar-nav .nav-label {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #64748b;
            font-weight: 600;
            padding: 8px 12px 6px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94a3b8;
            text-decoration: none;
            padding: 10px 12px;
            font-weight: 500;
            font-size: .88rem;
            border-radius: 8px;
            margin-bottom: 2px;
            transition: .15s;
        }
        .sidebar a i { font-size: 1rem; width: 18px; text-align: center; }
        .sidebar a:hover {
            color: #fff;
            background: rgba(255,255,255,.06);
        }
        .sidebar a.active {
            color: #fff;
            background: var(--accent);
        }
        .sidebar-footer {
            padding: 14px 16px;
            border-top: 1px solid #1e293b;
        }
        .sidebar-footer .user-row {
            display: flex; align-items: center; gap: 10px;
            padding: 8px;
            margin-bottom: 8px;
        }
        .sidebar-footer .avatar {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--dark-2);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 600; font-size: .8rem;
            border: 1px solid #334155;
        }
        .sidebar-footer .user-name { color: #fff; font-size: .82rem; font-weight: 600; line-height: 1.2; }
        .sidebar-footer .user-role { color: #64748b; font-size: .7rem; }
        .sidebar-footer form button {
            width: 100%;
            background: transparent;
            border: 1px solid #334155;
            color: #cbd5e1;
            border-radius: 8px;
            padding: 8px;
            font-size: .82rem;
            font-weight: 500;
            transition: .15s;
        }
        .sidebar-footer form button:hover {
            background: #1e293b;
            color: #fff;
            border-color: #475569;
        }

        .main-content {
            margin-left: 250px;
            padding: 28px 32px;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .topbar h1 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            letter-spacing: -.01em;
        }

        .card, .table-wrap {
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 1px 2px rgba(15,23,42,.04);
        }
        .table-wrap {
            background: #fff;
            padding: 4px;
        }
        table.table thead {
            background: #f8fafc;
        }
        table.table thead th {
            border: none;
            border-bottom: 1px solid var(--border);
            color: #475569;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-weight: 700;
            padding: 12px 16px;
        }
        table.table td {
            vertical-align: middle;
            border-color: var(--border);
            padding: 12px 16px;
            font-size: .88rem;
        }
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            font-weight: 600;
            font-size: .85rem;
        }
        .btn-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }
        .btn-outline-secondary {
            border-color: var(--border);
            color: #334155;
            font-weight: 600;
            font-size: .85rem;
        }
        .form-control, .form-select {
            border-color: var(--border);
            font-size: .88rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-2);
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }
        .badge { font-weight: 600; font-size: .72rem; padding: 5px 10px; border-radius: 6px; }

        @media (max-width: 768px) {
            .sidebar { width: 68px; }
            .sidebar .brand span, .sidebar a span, .nav-label, .user-name, .user-role { display: none; }
            .main-content { margin-left: 68px; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-book-half"></i></div>
            <span>SI Perpustakaan</span>
        </div>

        <div class="sidebar-nav">
            <div class="nav-label">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('buku.index') }}" class="{{ request()->routeIs('buku.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i> <span>Data Buku</span>
            </a>
            <a href="{{ route('anggota.index') }}" class="{{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> <span>Data Anggota</span>
            </a>
            <a href="{{ route('peminjaman.index') }}" class="{{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> <span>Peminjaman</span>
            </a>

            <div class="nav-label mt-3">Laporan</div>
            <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph-fill"></i> <span>Laporan</span>
            </a>
        </div>

        <div class="sidebar-footer">
            <div class="user-row">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                <div>
                    <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        @if(session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali isian Anda:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>