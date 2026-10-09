<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user' => 'USR001',
            'nama_lengkap' => 'Muhamad Haikal',
            'email' => 'haikal@example.com',
            'username' => 'haikal',
            'password' => Hash::make('password123'),
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Sukarno Hatta No. 45, Bandung',
        ]);

        $products = [
            ['id_barang' => 'BRG001', 'nama_barang' => 'Buku Tulis Sidu 38 Lembar', 'deskripsi' => 'Buku tulis isi 38 lembar.', 'harga' => 4500, 'stok' => 25, 'gambar' => 'buku.jpg'],
            ['id_barang' => 'BRG002', 'nama_barang' => 'Pulpen Gel Hitam 0.5mm', 'deskripsi' => 'Pulpen tinta hitam pekat.', 'harga' => 3500, 'stok' => 30, 'gambar' => 'pulpen.jpg'],
            ['id_barang' => 'BRG003', 'nama_barang' => 'Pensil 2B Faber Castell', 'deskripsi' => 'Pensil grafit standar ujian.', 'harga' => 2500, 'stok' => 20, 'gambar' => 'pensil.jpg'],
            ['id_barang' => 'BRG004', 'nama_barang' => 'Penghapus Karet Putih', 'deskripsi' => 'Penghapus lembut tanpa debu.', 'harga' => 2000, 'stok' => 15, 'gambar' => 'penghapus.jpg'],
            ['id_barang' => 'BRG005', 'nama_barang' => 'Penggaris Besi 30cm', 'deskripsi' => 'Penggaris stainless anti patah.', 'harga' => 7000, 'stok' => 10, 'gambar' => 'penggaris.jpg'],
            ['id_barang' => 'BRG006', 'nama_barang' => 'Tipe-X Kertas Correction Tape', 'deskripsi' => 'Pita koreksi instan kering.', 'harga' => 8500, 'stok' => 12, 'gambar' => 'tipex.jpg'],
            ['id_barang' => 'BRG007', 'nama_barang' => 'Spidol Whiteboard Hitam', 'deskripsi' => 'Spidol mudah dihapus.', 'harga' => 9000, 'stok' => 18, 'gambar' => 'spidol.jpg'],
            ['id_barang' => 'BRG008', 'nama_barang' => 'Map Plastik Kancing', 'deskripsi' => 'Map dokumen ukuran folio.', 'harga' => 4000, 'stok' => 40, 'gambar' => 'map.jpg'],
            ['id_barang' => 'BRG009', 'nama_barang' => 'Gunting Kertas Sedang', 'deskripsi' => 'Gunting tajam dengan pegangan nyaman.', 'harga' => 6500, 'stok' => 8, 'gambar' => 'gunting.jpg'],
            ['id_barang' => 'BRG010', 'nama_barang' => 'Stapler Mini + Isi', 'deskripsi' => 'Stapler praktis ukuran saku (Stok habis).', 'harga' => 11000, 'stok' => 0, 'gambar' => 'stapler.jpg'],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
