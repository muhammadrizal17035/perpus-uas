@extends('layouts.app')
@section('title', 'Data Buku - SI Perpustakaan')
@section('content')

<div class="topbar">
    <h1>Data Buku</h1>
    <div>
        <a href="{{ route('buku.barcode.semua') }}" target="_blank" class="btn btn-outline-secondary"><i class="bi bi-upc-scan me-1"></i>Cetak Semua Barcode</a>
        <a href="{{ route('buku.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Buku</a>
    </div>
</div>

<form method="GET" action="{{ route('buku.index') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="q" value="{{ $keyword }}" class="form-control" placeholder="Cari kode, judul, atau penulis...">
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
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($buku as $b)
        <tr>
            <td>{{ $loop->iteration + ($buku->currentPage() - 1) * $buku->perPage() }}</td>
            <td>{{ $b->kode_buku }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->penulis }}</td>
            <td>{{ $b->penerbit }}</td>
            <td>{{ $b->tahun }}</td>
            <td>
                @if($b->stok > 0)
                    <span class="badge bg-success">{{ $b->stok }}</span>
                @else
                    <span class="badge bg-danger">Habis</span>
                @endif
            </td>
            <td>
                <a href="{{ route('buku.barcode', $b) }}" target="_blank" class="btn btn-sm btn-info text-white"><i class="bi bi-upc-scan"></i></a>
                <a href="{{ route('buku.edit', $b) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                <form action="{{ route('buku.destroy', $b) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center text-muted py-4">Belum ada data buku.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

{{ $buku->links() }}

@endsection