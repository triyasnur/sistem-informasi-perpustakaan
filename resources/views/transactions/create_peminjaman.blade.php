<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-[#8F74B4]">Transaksi</p>
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Peminjaman Baru</h2>
            </div>
            <a href="{{ route('transactions.index') }}"
               class="hidden rounded-lg border border-[#DCD3EA] bg-[#F8F5FC] px-3 py-2 text-sm font-semibold text-[#6C4E97] transition hover:bg-[#F0EBF7] sm:inline-flex">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F7F6FB] py-6 sm:py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg border border-gray-100 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-5 sm:px-7">
                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#F0EBF7] text-[#6C4E97]">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <div>
                            <h1 class="text-lg font-semibold text-gray-900">Form Peminjaman Buku</h1>
                            <p class="mt-1 text-sm text-gray-500">Pilih anggota dan buku yang tersedia untuk mencatat transaksi baru.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('transactions.store_peminjaman') }}" method="POST" class="space-y-5 px-5 py-6 sm:px-7">
                    @csrf

                    @if($errors->any())
                        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <p class="font-semibold">Data belum lengkap</p>
                            <ul class="mt-2 list-disc space-y-1 pl-4">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label class="text-sm font-semibold text-gray-700" for="kode_transaksi">Kode Transaksi</label>
                        <div class="mt-1.5 flex rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-500">
                            <i class="fa-solid fa-barcode mr-3 mt-0.5 text-gray-400"></i>
                            <input id="kode_transaksi" type="text" name="kode_transaksi" value="TRX-{{ strtoupper(Str::random(5)) }}" readonly
                                   class="w-full border-0 bg-transparent p-0 font-mono text-gray-600 outline-none focus:ring-0">
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-gray-700" for="member_id">Anggota Peminjam</label>
                            <select id="member_id" name="member_id" required
                                    class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none transition focus:border-[#6C4E97] focus:ring-4 focus:ring-[#EEE7F5]">
                                <option value="">Pilih anggota</option>
                                @foreach($members as $m)
                                    <option value="{{ $m->id }}" @selected(old('member_id') == $m->id)>
                                        {{ $m->nomor_anggota }} - {{ $m->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700" for="tanggal_pinjam">Tanggal Pinjam</label>
                            <input id="tanggal_pinjam" type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required
                                   class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none transition focus:border-[#6C4E97] focus:ring-4 focus:ring-[#EEE7F5]">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700" for="book_id">Buku Perpustakaan</label>
                        <select id="book_id" name="book_id" required
                                class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none transition focus:border-[#6C4E97] focus:ring-4 focus:ring-[#EEE7F5]">
                            <option value="">Pilih judul buku</option>
                            @foreach($books as $b)
                                <option value="{{ $b->id }}" @selected(old('book_id') == $b->id) @disabled($b->stok < 1)>
                                    {{ $b->judul }} {{ $b->stok < 1 ? '(stok habis)' : '(sisa stok: '.$b->stok.')' }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-xs text-gray-400">Buku dengan stok habis tidak bisa dipilih untuk transaksi baru.</p>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                        <a href="{{ route('transactions.index') }}"
                           class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#6C4E97] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#5D4087]">
                            <i class="fa-solid fa-check text-xs"></i>
                            Konfirmasi Pinjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
