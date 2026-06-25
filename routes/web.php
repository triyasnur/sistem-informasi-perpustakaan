<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk akses DB::raw

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Asli (Sudah dilengkapi dengan logika kategori untuk grafik)
    Route::get('/dashboard', function () {
        $totalBuku = Book::count();
        $recentBooks = Book::latest()->take(6)->get();
        
        // Logika untuk mengisi grafik persentase kategori
        $categoryStats = Book::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get()
            ->map(function ($item) use ($totalBuku) {
                return [
                    'label' => $item->kategori,
                    'percentage' => $totalBuku > 0 ? round(($item->total / $totalBuku) * 100) : 0
                ];
            });

        return view('dashboard', compact(
            'totalBuku',
            'recentBooks',
            'categoryStats'
        ));
    })->name('dashboard');

    // CRUD Buku
    Route::resource('books', BookController::class);

    // Sirkulasi / Peminjaman
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/members/create', [TransactionController::class, 'createMember'])->name('transactions.create_member');
    Route::post('/transactions/members', [TransactionController::class, 'storeMember'])->name('transactions.store_member');
    Route::get('/transactions/peminjaman/create', [TransactionController::class, 'createPeminjaman'])->name('transactions.create_peminjaman');
    Route::post('/transactions/peminjaman', [TransactionController::class, 'storePeminjaman'])->name('transactions.store_peminjaman');
    Route::put('/transactions/{id}/return', [TransactionController::class, 'returnBuku'])->name('transactions.return_buku');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
