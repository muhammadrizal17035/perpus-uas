@extends('layouts.app')
@section('title', 'Edit Buku - SI Perpustakaan')
@section('content')

<h2 class="mb-4">Edit Data Buku</h2>

<form action="{{ route('buku.update', $buku) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Kode Buku</label>
        <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku', $buku->kode_buku) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $buku->judul) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $buku->penulis) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Penerbit</label>
        <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $buku->penerbit) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $buku->tahun) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $buku->stok) }}" min="0" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection