<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-[#8F74B4]">Anggota</p>
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Registrasi Anggota</h2>
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
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#F0EBF7] text-[#6C4E97]">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <div>
                                <h1 class="text-lg font-semibold text-gray-900">Form Anggota Baru</h1>
                                <p class="mt-1 text-sm text-gray-500">Simpan identitas peminjam agar bisa dipilih saat transaksi.</p>
                            </div>
                        </div>

                        <button type="button" onclick="autoFill()"
                                class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#DCD3EA] bg-[#F8F5FC] px-4 py-2 text-sm font-semibold text-[#6C4E97] transition hover:bg-[#F0EBF7]">
                            <i class="fa-solid fa-wand-magic-sparkles text-xs"></i>
                            Isi Otomatis
                        </button>
                    </div>
                </div>

                <form action="{{ route('transactions.store_member') }}" method="POST" class="space-y-5 px-5 py-6 sm:px-7">
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

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-gray-700" for="nomor_anggota">Nomor Anggota</label>
                            <input id="nomor_anggota" type="text" name="nomor_anggota" value="{{ old('nomor_anggota') }}" required
                                   class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none transition focus:border-[#6C4E97] focus:ring-4 focus:ring-[#EEE7F5]">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700" for="nama">Nama Lengkap</label>
                            <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required
                                   class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none transition focus:border-[#6C4E97] focus:ring-4 focus:ring-[#EEE7F5]">
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-gray-700" for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required
                                    class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none transition focus:border-[#6C4E97] focus:ring-4 focus:ring-[#EEE7F5]">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                                <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700" for="telepon">No. Telepon</label>
                            <input id="telepon" type="text" name="telepon" value="{{ old('telepon') }}" required
                                   class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none transition focus:border-[#6C4E97] focus:ring-4 focus:ring-[#EEE7F5]">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700" for="alamat">Alamat Rumah</label>
                        <textarea id="alamat" name="alamat" rows="4" required
                                  class="mt-1.5 w-full resize-none rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none transition focus:border-[#6C4E97] focus:ring-4 focus:ring-[#EEE7F5]">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                        <a href="{{ route('transactions.index') }}"
                           class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#6C4E97] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#5D4087]">
                            <i class="fa-solid fa-check text-xs"></i>
                            Simpan Anggota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function autoFill() {
            document.getElementById('nomor_anggota').value = "NIM-" + Math.floor(100000 + Math.random() * 900000);
            document.getElementById('nama').value = "Triyas Nurlita";
            document.getElementById('jenis_kelamin').value = "P";
            document.getElementById('telepon').value = "085298765432";
            document.getElementById('alamat').value = "Sleman, Yogyakarta";
        }
    </script>
</x-app-layout>
