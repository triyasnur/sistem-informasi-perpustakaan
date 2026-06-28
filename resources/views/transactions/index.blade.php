<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-white">Sirkulasi</p>
                <h2 class="text-xl font-semibold text-white tracking-tight">Peminjaman Buku</h2>
            </div>
            <div class="hidden sm:flex h-10 w-10 items-center justify-center rounded-xl bg-[#F0EBF7] text-[#6C4E97]">
                <i class="fa-solid fa-arrow-right-arrow-left"></i>
            </div>
        </div>
    </x-slot>

    @php
        $totalBooks = $books->count();
        $totalStock = $books->sum('stok');
        $totalMembers = $members->count();
        $activeLoans = $transactions->where('status', 'dipinjam')->count();
        $returnedLoans = $transactions->where('status', 'dikembalikan')->count();
    @endphp

    <div class="min-h-screen bg-[#F7F6FB] py-6 sm:py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm">
                    <i class="fa-solid fa-circle-check mt-0.5"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-lg border border-white bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Data Buku</p>
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 text-[#6C4E97]">
                            <i class="fa-solid fa-book"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalBooks }}</p>
                    <p class="mt-1 text-sm text-gray-500">{{ $totalStock }} stok buku tersedia</p>
                </div>

                <div class="rounded-lg border border-white bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Anggota</p>
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-[#6C4E97]">
                            <i class="fa-solid fa-users"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalMembers }}</p>
                    <p class="mt-1 text-sm text-gray-500">Terdaftar sebagai peminjam</p>
                </div>

                <div class="rounded-lg border border-white bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Dipinjam</p>
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-bold text-gray-900">{{ $activeLoans }}</p>
                    <p class="mt-1 text-sm text-gray-500">Buku belum dikembalikan</p>
                </div>

                <div class="rounded-lg border border-white bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Selesai</p>
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-check"></i>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-bold text-gray-900">{{ $returnedLoans }}</p>
                    <p class="mt-1 text-sm text-gray-500">Riwayat pengembalian</p>
                </div>
            </div>

            <div class="mb-6 flex flex-col gap-3 rounded-lg border border-gray-100 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-lg font-semibold text-gray-900">Panel Sirkulasi</h1>
                    <p class="text-sm text-gray-500">Kelola anggota, peminjaman, dan pengembalian buku dari satu halaman.</p>
                </div>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <a href="{{ route('transactions.create_member') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#DCD3EA] bg-white px-4 py-2.5 text-sm font-semibold text-[#6C4E97] transition hover:bg-[#F6F1FB]">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Tambah Anggota</span>
                    </a>
                    <a href="{{ route('transactions.create_peminjaman') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#6C4E97] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#5D4087]">
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span>Catat Peminjaman</span>
                    </a>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_380px]">
                <section class="rounded-lg border border-gray-100 bg-white shadow-sm">
                    <div class="border-b border-gray-100 px-5 py-4">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h2 class="text-base font-semibold text-gray-900">Riwayat Peminjaman</h2>
                                <p class="text-sm text-gray-500">Daftar transaksi terbaru dan status pengembalian.</p>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[820px] text-sm">
                            <thead class="bg-[#F0EBF7] text-xs font-bold uppercase tracking-wider text-[#6C4E97]">
                                <tr>
                                    <th class="px-5 py-3 text-left">Kode</th>
                                    <th class="px-5 py-3 text-left">Peminjam</th>
                                    <th class="px-5 py-3 text-left">Buku</th>
                                    <th class="px-5 py-3 text-left">Pinjam</th>
                                    <th class="px-5 py-3 text-left">Kembali</th>
                                    <th class="px-5 py-3 text-center">Status</th>
                                    <th class="px-5 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($transactions as $trx)
                                    <tr class="transition hover:bg-[#FAF8FD]">
                                        <td class="px-5 py-4 font-mono text-xs font-bold text-gray-800">{{ $trx->kode_transaksi }}</td>
                                        <td class="px-5 py-4">
                                            <p class="font-semibold text-gray-800">{{ $trx->member->nama }}</p>
                                            <p class="text-xs text-gray-400">{{ $trx->member->nomor_anggota }}</p>
                                        </td>
                                        <td class="px-5 py-4 text-gray-600">{{ $trx->book->judul }}</td>
                                        <td class="px-5 py-4 text-gray-600">{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}</td>
                                        <td class="px-5 py-4 text-gray-600">
                                            {{ $trx->tanggal_kembali ? \Carbon\Carbon::parse($trx->tanggal_kembali)->format('d M Y') : '-' }}
                                        </td>
                                        <td class="px-5 py-4 text-center">
                                            @if($trx->status == 'dipinjam')
                                                <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 text-right">
                                            @if($trx->status == 'dipinjam')
                                                <form action="{{ route('transactions.return_buku', $trx->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                            onclick="return confirm('Proses pengembalian buku ini?')"
                                                            class="inline-flex items-center justify-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100">
                                                        <i class="fa-solid fa-rotate-left"></i>
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="inline-flex rounded-lg border border-gray-100 bg-gray-50 px-3 py-2 text-xs font-semibold text-gray-400">Arsip</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-5 py-12 text-center">
                                            <div class="mx-auto flex max-w-sm flex-col items-center">
                                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-[#F0EBF7] text-[#6C4E97]">
                                                    <i class="fa-solid fa-book-open"></i>
                                                </div>
                                                <p class="font-semibold text-gray-800">Belum ada transaksi</p>
                                                <p class="mt-1 text-sm text-gray-500">Mulai catat peminjaman pertama untuk menampilkan riwayat di sini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <div class="space-y-6">
                    <section class="rounded-lg border border-gray-100 bg-white shadow-sm">
                        <div class="border-b border-gray-100 px-5 py-4">
                            <h2 class="text-base font-semibold text-gray-900">Data Buku</h2>
                            <p class="text-sm text-gray-500">Koleksi terbaru dan sisa stok.</p>
                        </div>
                        <div class="max-h-[360px] divide-y divide-gray-100 overflow-y-auto">
                            @forelse($books as $book)
                                <div class="px-5 py-4 transition hover:bg-[#FAF8FD]">
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-[#6C4E97]">
                                            <i class="fa-solid fa-book"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-start justify-between gap-3">
                                                <div class="min-w-0">
                                                    <p class="truncate font-semibold text-gray-800">{{ $book->judul }}</p>
                                                    <p class="mt-0.5 text-xs text-gray-400">{{ $book->kode_buku }} - {{ $book->penulis }}</p>
                                                </div>
                                                <span class="shrink-0 rounded-md px-2 py-1 text-xs font-bold {{ $book->stok > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600' }}">
                                                    {{ $book->stok }} stok
                                                </span>
                                            </div>
                                            <div class="mt-3 flex flex-wrap gap-2 text-xs">
                                                <span class="rounded-md bg-gray-50 px-2 py-1 font-medium text-gray-500">{{ $book->kategori ?? 'Tanpa kategori' }}</span>
                                                <span class="rounded-md bg-gray-50 px-2 py-1 font-medium text-gray-500">{{ $book->tahun ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-5 py-12 text-center">
                                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-50 text-gray-400">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <p class="font-semibold text-gray-800">Belum ada buku</p>
                                    <p class="mt-1 text-sm text-gray-500">Tambahkan buku agar bisa dipinjam.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <section class="rounded-lg border border-gray-100 bg-white shadow-sm">
                    <div class="border-b border-gray-100 px-5 py-4">
                        <h2 class="text-base font-semibold text-gray-900">Anggota Terdaftar</h2>
                        <p class="text-sm text-gray-500">Data peminjam yang bisa dipilih saat transaksi.</p>
                    </div>
                    <div class="max-h-[560px] divide-y divide-gray-100 overflow-y-auto">
                        @forelse($members as $member)
                            <div class="flex items-start gap-3 px-5 py-4 transition hover:bg-[#FAF8FD]">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#F0EBF7] text-sm font-bold text-[#6C4E97]">
                                    {{ strtoupper(substr($member->nama, 0, 1)) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="truncate font-semibold text-gray-800">{{ $member->nama }}</p>
                                        <span class="rounded-md px-2 py-0.5 text-xs font-bold {{ $member->jenis_kelamin == 'L' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600' }}">
                                            {{ $member->jenis_kelamin }}
                                        </span>
                                    </div>
                                    <p class="mt-0.5 text-xs font-medium text-gray-400">{{ $member->nomor_anggota }}</p>
                                    <p class="mt-2 truncate text-sm text-gray-500">{{ $member->telepon }} - {{ $member->alamat }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="px-5 py-12 text-center">
                                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-gray-50 text-gray-400">
                                    <i class="fa-solid fa-user-plus"></i>
                                </div>
                                <p class="font-semibold text-gray-800">Belum ada anggota</p>
                                <p class="mt-1 text-sm text-gray-500">Tambahkan anggota sebelum membuat peminjaman.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
<section class="rounded-lg border border-gray-100 bg-white shadow-sm mt-6">
                <div class="border-b border-gray-100 px-5 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-base font-semibold text-gray-900">Riwayat Pengembalian</h2>
                            <p class="text-sm text-gray-500">Daftar buku yang telah dikembalikan.</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[820px] text-sm">
                        <thead class="bg-[#F0EBF7] text-xs font-bold uppercase tracking-wider text-[#6C4E97]">
                            <tr>
                                <th class="px-5 py-3 text-left">Kode</th>
                                <th class="px-5 py-3 text-left">Peminjam</th>
                                <th class="px-5 py-3 text-left">Buku</th>
                                <th class="px-5 py-3 text-left">Pinjam</th>
                                <th class="px-5 py-3 text-left">Kembali</th>
                                <th class="px-5 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($returnedTransactions as $trx)
                                <tr class="transition hover:bg-[#FAF8FD]">
                                    <td class="px-5 py-4 font-mono text-xs font-bold text-gray-800">{{ $trx->kode_transaksi }}</td>
                                    <td class="px-5 py-4">
                                        <p class="font-semibold text-gray-800">{{ $trx->member->nama }}</p>
                                        <p class="text-xs text-gray-400">{{ $trx->member->nomor_anggota }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-gray-600">{{ $trx->book->judul }}</td>
                                    <td class="px-5 py-4 text-gray-600">{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}</td>
                                    <td class="px-5 py-4 text-gray-600">
                                        {{ $trx->tanggal_kembali ? \Carbon\Carbon::parse($trx->tanggal_kembali)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Selesai
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-12 text-center">
                                        <div class="mx-auto flex max-w-sm flex-col items-center">
                                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-[#F0EBF7] text-[#6C4E97]">
                                                <i class="fa-solid fa-rotate-left"></i>
                                            </div>
                                            <p class="font-semibold text-gray-800">Belum ada pengembalian</p>
                                            <p class="mt-1 text-sm text-gray-500">Belum ada buku yang dikembalikan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
</div>
                 </section>
             </div>
         </div>

         <section class="rounded-lg border border-gray-100 bg-white shadow-sm mt-6">
             <div class="border-b border-gray-100 px-5 py-4">
                 <h2 class="text-base font-semibold text-gray-900">Riwayat Pengembalian</h2>
                 <p class="text-sm text-gray-500">Daftar buku yang telah dikembalikan.</p>
             </div>
             <div class="overflow-x-auto">
                 <table class="w-full min-w-[820px] text-sm">
                     <thead class="bg-[#F0EBF7] text-xs font-bold uppercase tracking-wider text-[#6C4E97]">
                         <tr>
                             <th class="px-5 py-3 text-left">Kode</th>
                             <th class="px-5 py-3 text-left">Peminjam</th>
                             <th class="px-5 py-3 text-left">Buku</th>
                             <th class="px-5 py-3 text-left">Pinjam</th>
                             <th class="px-5 py-3 text-left">Kembali</th>
                             <th class="px-5 py-3 text-center">Status</th>
                         </tr>
                     </thead>
                     <tbody class="divide-y divide-gray-100">
                         @forelse($returnedTransactions as $trx)
                             <tr class="transition hover:bg-[#FAF8FD]">
                                 <td class="px-5 py-4 font-mono text-xs font-bold text-gray-800">{{ $trx->kode_transaksi }}</td>
                                 <td class="px-5 py-4">
                                     <p class="font-semibold text-gray-800">{{ $trx->member->nama }}</p>
                                     <p class="text-xs text-gray-400">{{ $trx->member->nomor_anggota }}</p>
                                 </td>
                                 <td class="px-5 py-4 text-gray-600">{{ $trx->book->judul }}</td>
                                 <td class="px-5 py-4 text-gray-600">{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}</td>
                                 <td class="px-5 py-4 text-gray-600">
                                     {{ $trx->tanggal_kembali ? \Carbon\Carbon::parse($trx->tanggal_kembali)->format('d M Y') : '-' }}
                                 </td>
                                 <td class="px-5 py-4 text-center">
                                     <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                         <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                         Selesai
                                     </span>
                                 </td>
                             </tr>
                         @empty
                             <tr>
                                 <td colspan="6" class="px-5 py-12 text-center">
                                     <div class="mx-auto flex max-w-sm flex-col items-center">
                                         <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-[#F0EBF7] text-[#6C4E97]">
                                             <i class="fa-solid fa-rotate-left"></i>
                                         </div>
                                         <p class="font-semibold text-gray-800">Belum ada pengembalian</p>
                                         <p class="mt-1 text-sm text-gray-500">Belum ada buku yang dikembalikan.</p>
                                     </div>
                                 </td>
                             </tr>
                         @endforelse
                     </tbody>
                 </table>
             </div>
         </section>
     </div>
 </div>
</x-app-layout>
