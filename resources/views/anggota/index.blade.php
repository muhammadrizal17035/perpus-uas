@extends('layouts.app')
@section('title', 'Data Anggota - SI Perpustakaan')
@section('content')

<div class="topbar">
    <h1>Data Anggota</h1>
    <a href="{{ route('anggota.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Anggota</a>
</div>

<form method="GET" action="{{ route('anggota.index') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="q" value="{{ $keyword }}" class="form-control" placeholder="Cari nama, email, atau no HP...">
    </div>
    <div class="col-auto">
        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
    </div>
</form>

<div class="table-wrap">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($anggota as $a)
        <tr>
            <td>{{ $loop->iteration + ($anggota->currentPage() - 1) * $anggota->perPage() }}</td>
            <td>{{ $a->nama }}</td>
            <td>{{ $a->alamat }}</td>
            <td>{{ $a->no_hp }}</td>
            <td>{{ $a->email }}</td>
            <td>
                <a href="{{ route('anggota.edit', $a) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                <form action="{{ route('anggota.destroy', $a) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus anggota ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted py-4">Belum ada data anggota.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

{{ $anggota->links() }}

@endsection