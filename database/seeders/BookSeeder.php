<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'kode_buku' => 'BK-1001',
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun' => 2005,
                'kategori' => 'Fiksi',
                'stok' => 7,
            ],
            [
                'kode_buku' => 'BK-1002',
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun' => 1980,
                'kategori' => 'Novel',
                'stok' => 5,
            ],
            [
                'kode_buku' => 'BK-1003',
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun' => 2019,
                'kategori' => 'Pengembangan Diri',
                'stok' => 8,
            ],
            [
                'kode_buku' => 'BK-1004',
                'judul' => 'Sejarah Indonesia Modern',
                'penulis' => 'M. C. Ricklefs',
                'penerbit' => 'Serambi',
                'tahun' => 2008,
                'kategori' => 'Non-Fiksi',
                'stok' => 4,
            ],
            [
                'kode_buku' => 'BK-1005',
                'judul' => 'Dasar-Dasar Pemrograman Web',
                'penulis' => 'Abdul Kadir',
                'penerbit' => 'Andi Offset',
                'tahun' => 2021,
                'kategori' => 'Teknologi',
                'stok' => 6,
            ],
            [
                'kode_buku' => 'BK-1006',
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun' => 2018,
                'kategori' => 'Filsafat',
                'stok' => 3,
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['kode_buku' => $book['kode_buku']],
                $book
            );
        }
    }
}
