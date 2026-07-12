@extends('layouts.app')
@section('title', 'Dashboard - SI Perpustakaan')
@section('content')

<div class="topbar">
    <div>
        <h1>Dashboard</h1>
        <p class="text-muted mb-0" style="font-size:.85rem;">Ringkasan aktivitas perpustakaan hari ini</p>
    </div>
</div>

<div class="row g-3 mb-2">
    <div class="col-md-3">
        <div class="stat-card-v3">
            <div class="stat-top">
                <div class="stat-icon" style="background:#eff6ff; color:#2563eb;"><i class="bi bi-journal-bookmark-fill"></i></div>
            </div>
            <div class="value">{{ $jumlahBuku }}</div>
            <div class="label">Jumlah Buku</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-v3">
            <div class="stat-top">
                <div class="stat-icon" style="background:#f0fdf4; color:#16a34a;"><i class="bi bi-people-fill"></i></div>
            </div>
            <div class="value">{{ $jumlahAnggota }}</div>
            <div class="label">Jumlah Anggota</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-v3">
            <div class="stat-top">
                <div class="stat-icon" style="background:#fff7ed; color:#ea580c;"><i class="bi bi-arrow-left-right"></i></div>
            </div>
            <div class="value">{{ $jumlahDipinjam }}</div>
            <div class="label">Buku Dipinjam</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-v3">
            <div class="stat-top">
                <div class="stat-icon" style="background:#ecfeff; color:#0891b2;"><i class="bi bi-box-seam-fill"></i></div>
            </div>
            <div class="value">{{ $jumlahTersedia }}</div>
            <div class="label">Stok Tersedia</div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-7">
        <div class="panel-card h-100">
            <div class="panel-header">
                <h5><i class="bi bi-lightning-charge-fill me-2" style="color:#2563eb;"></i>Aksi Cepat</h5>
            </div>
            <div class="quick-actions">
                <a href="{{ route('buku.create') }}" class="qa-item">
                    <div class="qa-icon"><i class="bi bi-plus-lg"></i></div>
                    <span>Tambah Buku</span>
                </a>
                <a href="{{ route('anggota.create') }}" class="qa-item">
                    <div class="qa-icon"><i class="bi bi-person-plus-fill"></i></div>
                    <span>Tambah Anggota</span>
                </a>
                <a href="{{ route('peminjaman.create') }}" class="qa-item">
                    <div class="qa-icon"><i class="bi bi-journal-plus"></i></div>
                    <span>Pinjam Buku</span>
                </a>
                <a href="{{ route('laporan.index') }}" class="qa-item">
                    <div class="qa-icon"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                    <span>Lihat Laporan</span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="panel-card h-100">
            <div class="panel-header">
                <h5><i class="bi bi-bar-chart-fill me-2" style="color:#2563eb;"></i>Status Stok</h5>
            </div>
            @php
                $totalStokAwal = $jumlahDipinjam + $jumlahTersedia;
                $persenTersedia = $totalStokAwal > 0 ? round(($jumlahTersedia / $totalStokAwal) * 100) : 0;
            @endphp
            <div class="d-flex justify-content-between mb-1" style="font-size:.82rem;">
                <span class="text-muted fw-medium">Tersedia</span>
                <span class="fw-bold">{{ $persenTersedia }}%</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" style="width: {{ $persenTersedia }}%; background: #2563eb;"></div>
            </div>

            <div class="d-flex justify-content-between mt-3 mb-1" style="font-size:.82rem;">
                <span class="text-muted fw-medium">Sedang Dipinjam</span>
                <span class="fw-bold">{{ 100 - $persenTersedia }}%</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" style="width: {{ 100 - $persenTersedia }}%; background: #ea580c;"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card-v3 {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px 20px;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
    }
    .stat-top { margin-bottom: 14px; }
    .stat-icon {
        width: 40px; height: 40px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }
    .stat-card-v3 .value {
        font-size: 1.7rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
        letter-spacing: -.02em;
    }
    .stat-card-v3 .label {
        font-size: .8rem;
        color: #64748b;
        font-weight: 500;
        margin-top: 2px;
    }

    .panel-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
    }
    .panel-header h5 {
        font-size: .95rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 18px;
    }
    .quick-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    .qa-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        text-decoration: none;
        color: #0f172a;
        font-size: .82rem;
        font-weight: 600;
        transition: .15s;
    }
    .qa-item:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb;
    }
    .qa-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        background: #0f172a;
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: .85rem;
        flex-shrink: 0;
    }
    .progress-track {
        height: 8px;
        border-radius: 999px;
        background: #f1f5f9;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        border-radius: 999px;
        transition: width .4s ease;
    }
</style>

@endsection