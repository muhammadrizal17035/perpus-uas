<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBuku = Buku::count();
        $jumlahAnggota = Anggota::count();
        $jumlahDipinjam = Peminjaman::where('status', 'Dipinjam')->count();
        $jumlahTersedia = Buku::sum('stok');

        return view('dashboard.index', compact(
            'jumlahBuku',
            'jumlahAnggota',
            'jumlahDipinjam',
            'jumlahTersedia'
        ));
    }
}