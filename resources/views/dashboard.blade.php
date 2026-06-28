<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-white">Ringkasan</p>
                <h2 class="text-xl font-semibold text-white tracking-tight">Dashboard Perpustakaan</h2>
            </div>
            <div class="hidden h-10 w-10 items-center justify-center rounded-lg bg-[#F0EBF7] text-[#6C4E97] sm:flex">
                <i class="fa-solid fa-chart-simple"></i>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F7F6FB] py-6 sm:py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <section class="mb-6 overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm">
                <div class="grid gap-0 lg:grid-cols-[minmax(0,1fr)_340px]">
                    <div class="p-6 sm:p-8">
                        <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-[#F0EBF7] px-3 py-1 text-xs font-bold text-[#6C4E97]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#6C4E97]"></span>
                            Sistem aktif
                        </div>
                        <h1 class="max-w-2xl text-2xl font-bold leading-tight text-gray-900 sm:text-3xl">
                            Halo, {{ Auth::user()->name }}
                        </h1>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                            Pantau koleksi buku, stok, anggota, dan aktivitas peminjaman perpustakaan dari satu tempat yang ringkas.
                        </p>

                        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('books.create') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#6C4E97] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#5D4087]">
                                <i class="fa-solid fa-plus text-xs"></i>
                                Tambah Buku
                            </a>
                            <a href="{{ route('transactions.index') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#DCD3EA] bg-white px-4 py-2.5 text-sm font-semibold text-[#6C4E97] transition hover:bg-[#F6F1FB]">
                                <i class="fa-solid fa-arrow-right-arrow-left text-xs"></i>
                                Lihat Peminjaman
                            </a>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 bg-[#FBFAFD] p-6 lg:border-l lg:border-t-0">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Koleksi</p>
                        <p class="mt-4 text-5xl font-bold text-[#6C4E97]">{{ $totalBuku }}</p>
                        <p class="mt-2 text-sm text-gray-500">Judul buku tersimpan</p>
                        <div class="mt-6 rounded-lg border border-gray-100 bg-white p-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-medium text-gray-500">Stok tersedia</span>
                                <span class="font-bold text-gray-900">{{ $totalStok }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Buku</p>
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 text-[#6C4E97]">
                            <i class="fa-solid fa-book"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalBuku }}</p>
                    <p class="mt-1 text-sm text-gray-500">Total judul buku</p>
                </div>

                <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Stok</p>
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-box-archive"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalStok }}</p>
                    <p class="mt-1 text-sm text-gray-500">Eksemplar tersedia</p>
                </div>

                <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Anggota</p>
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-users"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalAnggota }}</p>
                    <p class="mt-1 text-sm text-gray-500">Peminjam terdaftar</p>
                </div>

                <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Dipinjam</p>
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalDipinjam }}</p>
                    <p class="mt-1 text-sm text-gray-500">Belum dikembalikan</p>
                </div>
            </section>

            <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_380px]">
                <section class="rounded-lg border border-gray-100 bg-white shadow-sm">
                    <div class="flex flex-col gap-3 border-b border-gray-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900">Buku Terbaru</h3>
                            <p class="text-sm text-gray-500">Koleksi yang terakhir masuk ke sistem.</p>
                        </div>
                        <a href="{{ route('books.index') }}" class="text-sm font-semibold text-[#6C4E97] hover:text-[#5D4087]">
                            Lihat semua
                        </a>
                    </div>

                    <div class="grid gap-4 p-5 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($recentBooks as $book)
                            <article class="rounded-lg border border-gray-100 bg-white p-4 transition hover:border-[#DCD3EA] hover:shadow-sm">
                                <div class="mb-4 flex h-24 items-center justify-center rounded-lg bg-[#F0EBF7] text-[#6C4E97]">
                                    <i class="fa-solid fa-book-open text-2xl"></i>
                                </div>
                                <p class="truncate text-sm font-bold text-gray-900">{{ $book->judul }}</p>
                                <p class="mt-1 truncate text-xs text-gray-500">{{ $book->penulis }}</p>
                                <div class="mt-4 flex items-center justify-between gap-2">
                                    <span class="truncate rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-500">
                                        {{ $book->kategori ?? 'Tanpa kategori' }}
                                    </span>
                                    <span class="shrink-0 rounded-md bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700">
                                        {{ $book->stok }} stok
                                    </span>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full rounded-lg border border-dashed border-gray-200 px-5 py-12 text-center">
                                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-50 text-gray-400">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <p class="font-semibold text-gray-800">Belum ada buku</p>
                                <p class="mt-1 text-sm text-gray-500">Tambahkan koleksi pertama untuk mengisi dashboard.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <aside class="space-y-6">
                    <section class="rounded-lg border border-gray-100 bg-white shadow-sm">
                        <div class="border-b border-gray-100 px-5 py-4">
                            <h3 class="text-base font-semibold text-gray-900">Kategori Buku</h3>
                            <p class="text-sm text-gray-500">Distribusi koleksi saat ini.</p>
                        </div>
                        <div class="space-y-4 p-5">
                            @forelse($categoryStats as $cat)
                                <div>
                                    <div class="mb-1.5 flex items-center justify-between gap-3 text-sm">
                                        <span class="truncate font-semibold text-gray-700">{{ $cat['label'] }}</span>
                                        <span class="text-xs font-bold text-[#6C4E97]">{{ $cat['percentage'] }}%</span>
                                    </div>
                                    <div class="h-2 overflow-hidden rounded-full bg-[#F0EBF7]">
                                        <div class="h-full rounded-full bg-[#6C4E97]" style="width: {{ $cat['percentage'] }}%;"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">Belum ada kategori buku.</p>
                            @endforelse
                        </div>
                    </section>

                    <section class="rounded-lg border border-gray-100 bg-white shadow-sm">
                        <div class="border-b border-gray-100 px-5 py-4">
                            <h3 class="text-base font-semibold text-gray-900">Aktivitas Terbaru</h3>
                            <p class="text-sm text-gray-500">Riwayat peminjaman terakhir.</p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @forelse($recentTransactions as $transaction)
                                <div class="flex items-start gap-3 px-5 py-4">
                                    <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $transaction->status == 'dipinjam' ? 'bg-amber-50 text-amber-600' : 'bg-emerald-50 text-emerald-600' }}">
                                        <i class="fa-solid {{ $transaction->status == 'dipinjam' ? 'fa-arrow-up-right-from-square' : 'fa-check' }} text-xs"></i>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-semibold text-gray-800">{{ $transaction->book->judul }}</p>
                                        <p class="mt-1 truncate text-xs text-gray-500">{{ $transaction->member->nama }}</p>
                                        <p class="mt-2 text-xs font-semibold {{ $transaction->status == 'dipinjam' ? 'text-amber-600' : 'text-emerald-600' }}">
                                            {{ $transaction->status == 'dipinjam' ? 'Sedang dipinjam' : 'Sudah dikembalikan' }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="px-5 py-10 text-center">
                                    <p class="font-semibold text-gray-800">Belum ada aktivitas</p>
                                    <p class="mt-1 text-sm text-gray-500">Transaksi peminjaman akan tampil di sini.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
