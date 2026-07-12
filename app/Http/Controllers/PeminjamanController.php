<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');

        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderByDesc('tgl_pinjam')
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjaman', 'status'));
    }

    public function create()
    {
        $anggota = Anggota::orderBy('nama')->get();
        $buku = Buku::where('stok', '>', 0)->orderBy('judul')->get();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id'    => 'required|exists:buku,id',
            'tgl_pinjam' => 'required|date',
        ]);

        $buku = Buku::findOrFail($validated['buku_id']);

        if ($buku->stok < 1) {
            return back()->withInput()->with('error', 'Stok buku habis, tidak bisa dipinjam.');
        }

        Peminjaman::create([
            'anggota_id' => $validated['anggota_id'],
            'buku_id'    => $validated['buku_id'],
            'tgl_pinjam' => $validated['tgl_pinjam'],
            'tgl_kembali' => null,
            'status'     => 'Dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')->with('msg', 'Peminjaman berhasil disimpan.');
    }

    public function editKembali(Peminjaman $peminjaman)
    {
        return view('peminjaman.kembali', compact('peminjaman'));
    }

    public function kembalikan(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'Dikembalikan') {
            return redirect()->route('peminjaman.index')->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        $validated = $request->validate([
            'tgl_kembali' => 'required|date|after_or_equal:' . $peminjaman->tgl_pinjam,
        ]);

        $peminjaman->update([
            'tgl_kembali' => $validated['tgl_kembali'],
            'status'      => 'Dikembalikan',
        ]);

        $peminjaman->buku->increment('stok');

        return redirect()->route('peminjaman.index')->with('msg', 'Buku berhasil dikembalikan.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'Dipinjam') {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('msg', 'Data peminjaman berhasil dihapus.');
    }
}