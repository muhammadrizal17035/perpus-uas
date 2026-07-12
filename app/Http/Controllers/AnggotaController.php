<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');

        $anggota = Anggota::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('no_hp', 'like', "%{$keyword}%");
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('anggota', 'keyword'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => ['required', 'string'],
            'no_hp'  => ['required', 'string', 'regex:/^(\+62|08)[0-9]{8,11}$/'],
            'email'  => ['required', 'email', 'max:255', 'unique:anggota,email'],
        ], [
            'nama.regex'   => 'Nama hanya boleh berisi huruf dan spasi, tidak boleh ada angka atau simbol.',
            'no_hp.regex'  => 'Nomor HP harus diawali 08 atau +62, dengan panjang 10-13 digit.',
            'email.email'  => 'Format email tidak valid, pastikan menggunakan tanda @.',
            'email.unique' => 'Email sudah terdaftar untuk anggota lain.',
        ]);

        Anggota::create($validated);

        return redirect()->route('anggota.index')->with('msg', 'Data anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nama'   => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => ['required', 'string'],
            'no_hp'  => ['required', 'string', 'regex:/^(\+62|08)[0-9]{8,11}$/'],
            'email'  => ['required', 'email', 'max:255', 'unique:anggota,email,' . $anggota->id],
        ], [
            'nama.regex'   => 'Nama hanya boleh berisi huruf dan spasi, tidak boleh ada angka atau simbol.',
            'no_hp.regex'  => 'Nomor HP harus diawali 08 atau +62, dengan panjang 10-13 digit.',
            'email.email'  => 'Format email tidak valid, pastikan menggunakan tanda @.',
            'email.unique' => 'Email sudah terdaftar untuk anggota lain.',
        ]);

        $anggota->update($validated);

        return redirect()->route('anggota.index')->with('msg', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        if ($anggota->peminjaman()->where('status', 'Dipinjam')->exists()) {
            return redirect()->route('anggota.index')->with('error', 'Anggota tidak bisa dihapus karena masih memiliki pinjaman aktif.');
        }

        $anggota->delete();

        return redirect()->route('anggota.index')->with('msg', 'Data anggota berhasil dihapus.');
    }
}