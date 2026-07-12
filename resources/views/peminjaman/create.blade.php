@extends('layouts.app')
@section('title', 'Peminjaman Baru - SI Perpustakaan')
@section('content')

<h2 class="mb-4">Form Peminjaman Buku</h2>

<form action="{{ route('peminjaman.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    <div class="mb-3">
        <label class="form-label">Anggota</label>
        <select name="anggota_id" class="form-select" required>
            <option value="">-- Pilih Anggota --</option>
            @foreach($anggota as $a)
                <option value="{{ $a->id }}" @selected(old('anggota_id') == $a->id)>{{ $a->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Buku (hanya menampilkan stok tersedia)</label>
        <select name="buku_id" class="form-select" required>
            <option value="">-- Pilih Buku --</option>
            @foreach($buku as $b)
                <option value="{{ $b->id }}" @selected(old('buku_id') == $b->id)>{{ $b->judul }} (stok: {{ $b->stok }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" class="form-control" value="{{ old('tgl_pinjam', date('Y-m-d')) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection