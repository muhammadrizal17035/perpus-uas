@extends('layouts.app')
@section('title', 'Pengembalian Buku - SI Perpustakaan')
@section('content')

<h2 class="mb-4">Form Pengembalian Buku</h2>

<form action="{{ route('peminjaman.kembali', $peminjaman) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Anggota</label>
        <input type="text" class="form-control" value="{{ $peminjaman->anggota->nama }}" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Buku</label>
        <input type="text" class="form-control" value="{{ $peminjaman->buku->judul }}" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Pinjam</label>
        <input type="text" class="form-control" value="{{ $peminjaman->tgl_pinjam }}" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" class="form-control" value="{{ old('tgl_kembali', date('Y-m-d')) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Proses Pengembalian</button>
    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection