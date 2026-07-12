@extends('layouts.app')
@section('title', 'Peminjaman - SI Perpustakaan')
@section('content')

<div class="topbar">
    <h1>Data Peminjaman</h1>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Peminjaman Baru</a>
</div>

<form method="GET" action="{{ route('peminjaman.index') }}" class="row mb-3">
    <div class="col-md-3">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">-- Semua Status --</option>
            <option value="Dipinjam" @selected($status == 'Dipinjam')>Dipinjam</option>
            <option value="Dikembalikan" @selected($status == 'Dikembalikan')>Dikembalikan</option>
        </select>
    </div>
</form>

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
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($peminjaman as $p)
        <tr>
            <td>{{ $loop->iteration + ($peminjaman->currentPage() - 1) * $peminjaman->perPage() }}</td>
            <td>{{ $p->anggota->nama ?? '-' }}</td>
            <td>{{ $p->buku->judul ?? '-' }}</td>
            <td>{{ $p->tgl_pinjam }}</td>
            <td>{{ $p->tgl_kembali ?? '-' }}</td>
            <td>
                @if($p->status == 'Dipinjam')
                    <span class="badge bg-warning text-dark">Dipinjam</span>
                @else
                    <span class="badge bg-success">Dikembalikan</span>
                @endif
            </td>
            <td>
                @if($p->status == 'Dipinjam')
                    <a href="{{ route('peminjaman.kembali.form', $p) }}" class="btn btn-sm btn-primary"><i class="bi bi-arrow-return-left"></i> Kembalikan</a>
                @endif
                <form action="{{ route('peminjaman.destroy', $p) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus data peminjaman ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-muted py-4">Belum ada data peminjaman.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

{{ $peminjaman->links() }}

@endsection