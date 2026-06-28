<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $transactions = [
            [
                'kode_transaksi' => 'TRX-24001',
                'nomor_anggota' => 'NIM-240101',
                'kode_buku' => 'BK-1001',
                'tanggal_pinjam' => now()->subDays(6)->toDateString(),
                'tanggal_kembali' => null,
                'status' => 'dipinjam',
            ],
            [
                'kode_transaksi' => 'TRX-24002',
                'nomor_anggota' => 'NIM-240102',
                'kode_buku' => 'BK-1005',
                'tanggal_pinjam' => now()->subDays(4)->toDateString(),
                'tanggal_kembali' => null,
                'status' => 'dipinjam',
            ],
            [
                'kode_transaksi' => 'TRX-24003',
                'nomor_anggota' => 'NIM-240103',
                'kode_buku' => 'BK-1003',
                'tanggal_pinjam' => now()->subDays(12)->toDateString(),
                'tanggal_kembali' => now()->subDays(2)->toDateString(),
                'status' => 'dikembalikan',
            ],
            [
                'kode_transaksi' => 'TRX-24004',
                'nomor_anggota' => 'NIM-240104',
                'kode_buku' => 'BK-1006',
                'tanggal_pinjam' => now()->subDays(9)->toDateString(),
                'tanggal_kembali' => now()->subDays(1)->toDateString(),
                'status' => 'dikembalikan',
            ],
        ];

        foreach ($transactions as $transaction) {
            $member = Member::where('nomor_anggota', $transaction['nomor_anggota'])->first();
            $book = Book::where('kode_buku', $transaction['kode_buku'])->first();

            if (! $member || ! $book) {
                continue;
            }

            Transaction::updateOrCreate(
                ['kode_transaksi' => $transaction['kode_transaksi']],
                [
                    'member_id' => $member->id,
                    'book_id' => $book->id,
                    'tanggal_pinjam' => $transaction['tanggal_pinjam'],
                    'tanggal_kembali' => $transaction['tanggal_kembali'],
                    'status' => $transaction['status'],
                ]
            );
        }

        Book::where('kode_buku', 'BK-1001')->update(['stok' => 6]);
        Book::where('kode_buku', 'BK-1005')->update(['stok' => 5]);
    }
}
