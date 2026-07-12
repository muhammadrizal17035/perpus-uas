@extends('layouts.app')
@section('title', 'Edit Anggota - SI Perpustakaan')
@section('content')

<h2 class="mb-4">Edit Data Anggota</h2>

<form action="{{ route('anggota.update', $anggota) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $anggota->nama) }}" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $anggota->alamat) }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $anggota->no_hp) }}" required>
        @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $anggota->email) }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection