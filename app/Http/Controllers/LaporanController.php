<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari  = $request->input('dari');
        $sampai = $request->input('sampai');

        $laporan = Peminjaman::with(['anggota', 'buku'])
            ->when($dari, fn($q) => $q->whereDate('tgl_pinjam', '>=', $dari))
            ->when($sampai, fn($q) => $q->whereDate('tgl_pinjam', '<=', $sampai))
            ->orderByDesc('tgl_pinjam')
            ->get();

        $totalPinjam = $laporan->count();
        $totalDikembalikan = $laporan->where('status', 'Dikembalikan')->count();
        $totalBelumKembali = $laporan->where('status', 'Dipinjam')->count();

        return view('laporan.index', compact('laporan', 'dari', 'sampai', 'totalPinjam', 'totalDikembalikan', 'totalBelumKembali'));
    }
}