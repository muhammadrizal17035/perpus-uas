@extends('layouts.app')
@section('title', 'Tambah Buku - SI Perpustakaan')
@section('content')

<h2 class="mb-4">Tambah Data Buku</h2>

<form action="{{ route('buku.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    <div class="mb-3">
        <label class="form-label">Kode Buku</label>
        <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Penerbit</label>
        <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', 0) }}" min="0" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection