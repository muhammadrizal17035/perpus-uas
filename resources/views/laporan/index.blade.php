@extends('layouts.app')
@section('title', 'Laporan - SI Perpustakaan')
@section('content')

<div class="topbar">
    <h1>Laporan Peminjaman</h1>
    <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer-fill me-1"></i>Cetak</button>
</div>

<form method="GET" action="{{ route('laporan.index') }}" class="row g-2 mb-3">
    <div class="col-md-3">
        <label class="form-label">Dari Tanggal</label>
        <input type="date" name="dari" value="{{ $dari }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Sampai Tanggal</label>
        <input type="date" name="sampai" value="{{ $sampai }}" class="form-control">
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-outline-secondary w-100" type="submit"><i class="bi bi-funnel-fill"></i> Filter</button>
    </div>
</form>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#4f46e5,#6366f1);">
            <div class="value">{{ $totalPinjam }}</div>
            <div class="label">Total Transaksi</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#059669,#10b981);">
            <div class="value">{{ $totalDikembalikan }}</div>
            <div class="label">Sudah Dikembalikan</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#d97706,#f59e0b);">
            <div class="value">{{ $totalBelumKembali }}</div>
            <div class="label">Masih Dipinjam</div>
        </div>
    </div>
</div>

<div class="table-wrap">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Anggota</th>
            <th>Buku</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($laporan as $i => $l)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $l->anggota->nama ?? '-' }}</td>
            <td>{{ $l->buku->judul ?? '-' }}</td>
            <td>{{ $l->tgl_pinjam }}</td>
            <td>{{ $l->tgl_kembali ?? '-' }}</td>
            <td>
                @if($l->status == 'Dipinjam')
                    <span class="badge bg-warning text-dark">Dipinjam</span>
                @else
                    <span class="badge bg-success">Dikembalikan</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted py-4">Tidak ada data untuk periode ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

<style>
    @media print {
        .sidebar, .topbar button, form { display: none !important; }
        .main-content { margin-left: 0 !important; }
    }
</style>

@endsection