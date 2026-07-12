<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');

        $buku = Buku::when($keyword, function ($query) use ($keyword) {
                $query->where('kode_buku', 'like', "%{$keyword}%")
                    ->orWhere('judul', 'like', "%{$keyword}%")
                    ->orWhere('penulis', 'like', "%{$keyword}%");
            })
            ->orderBy('judul')
            ->paginate(10)
            ->withQueryString();

        return view('buku.index', compact('buku', 'keyword'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku',
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'tahun'     => 'required|numeric',
            'stok'      => 'required|numeric|min:0',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')->with('msg', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,' . $buku->id,
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'tahun'     => 'required|numeric',
            'stok'      => 'required|numeric|min:0',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')->with('msg', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')->with('msg', 'Buku berhasil dihapus.');
    }

    public function barcode(Buku $buku)
    {
        return view('buku.barcode', compact('buku'));
    }

    public function barcodeSemua()
    {
        $buku = Buku::orderBy('kode_buku')->get();
        return view('buku.barcode_semua', compact('buku'));
    }
}