<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;

class TransactionController extends Controller
{
    // 1. Tampilan Utama (Dua Tabel: Anggota & Sirkulasi)
    public function index()
    {
        $members = Member::latest()->get();
        $books = Book::latest()->get();
        $transactions = Transaction::with(['book', 'member'])->where('status', 'dipinjam')->latest()->get();
        $returnedTransactions = Transaction::with(['book', 'member'])->where('status', 'dikembalikan')->latest()->get();

        return view('transactions.index', compact('members', 'books', 'transactions', 'returnedTransactions'));
    }

    // 2. Form Tambah Anggota
    public function createMember()
    {
        return view('transactions.create_member');
    }

    // 3. Simpan Anggota Baru
    public function storeMember(Request $request)
    {
        $validated = $request->validate([
            'nomor_anggota' => 'required|unique:members,nomor_anggota',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        Member::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Anggota baru berhasil didaftarkan!');
    }

    // 4. Form Peminjaman Buku
    public function createPeminjaman()
    {
        $members = Member::all();
        // Hanya memunculkan buku yang stoknya lebih dari 0
        $books = Book::where('stok', '>', 0)->get();

        return view('transactions.create_peminjaman', compact('members', 'books'));
    }

    // 5. Simpan Transaksi Peminjaman (Stok Buku Otomatis -1)
    public function storePeminjaman(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:transactions,kode_transaksi',
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Validasi tambahan jika stok mendadak kosong
        if ($book->stok < 1) {
            return back()->withErrors(['book_id' => 'Maaf, stok buku ini sedang habis!']);
        }

        // Buat data transaksi peminjaman
        Transaction::create([
            'kode_transaksi' => $request->kode_transaksi,
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
        ]);

        // Kurangi stok buku
        $book->decrement('stok');

        return redirect()->route('transactions.index')->with('success', 'Transaksi peminjaman berhasil dicatat! Stok buku berkurang.');
    }

    // 6. Proses Pengembalian Buku (Stok Buku Otomatis +1)
    public function returnBuku($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status == 'dikembalikan') {
            return back()->with('success', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        // Update data transaksi
        $transaction->update([
            'tanggal_kembali' => date('Y-m-d'),
            'status' => 'dikembalikan',
        ]);

        // Tambah (kembalikan) stok buku
        $transaction->book()->increment('stok');

        return redirect()->route('transactions.index')->with('success', 'Buku berhasil dikembalikan! Stok buku bertambah.');
    }
}
