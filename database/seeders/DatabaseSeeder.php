<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin default
        User::updateOrCreate(
            ['email' => 'admin@perpus.com'],
            ['name' => 'Admin Perpus', 'password' => Hash::make('admin123')]
        );

        // Data buku
        Buku::insert([
            ['kode_buku' => 'BK001', 'judul' => 'Laravel untuk Pemula', 'penulis' => 'Andi Wijaya', 'penerbit' => 'Elex Media', 'tahun' => 2022, 'stok' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['kode_buku' => 'BK002', 'judul' => 'Belajar PHP OOP', 'penulis' => 'Budi Santoso', 'penerbit' => 'Informatika', 'tahun' => 2021, 'stok' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['kode_buku' => 'BK003', 'judul' => 'Dasar Basis Data MySQL', 'penulis' => 'Citra Dewi', 'penerbit' => 'Andi Publisher', 'tahun' => 2020, 'stok' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Data anggota
        Anggota::insert([
            ['nama' => 'Ahmad Fauzi', 'alamat' => 'Jl. Merdeka No. 1, Yogyakarta', 'no_hp' => '081234567890', 'email' => 'ahmad@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Siti Rahma', 'alamat' => 'Jl. Malioboro No. 5, Yogyakarta', 'no_hp' => '081298765432', 'email' => 'siti@example.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}