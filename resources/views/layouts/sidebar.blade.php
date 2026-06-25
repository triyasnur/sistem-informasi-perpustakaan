<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed lg:static inset-y-0 left-0 z-40 w-64 
              bg-white flex flex-col border-r border-purple-100 
              transform lg:transform-none transition-transform duration-200 ease-in-out">

    {{-- HEADER --}}
    <div class="flex items-center justify-between px-6 py-5 border-b border-purple-100">

        <div class="flex items-center gap-3">

            <div class="w-9 h-9 rounded-xl bg-[#6C4E97] flex items-center justify-center text-white shadow-md">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <div>
                <p class="text-sm font-bold text-gray-800 leading-none">Pustaka</p>
                <p class="text-[10px] text-gray-400 mt-0.5">Sistem Informasi</p>
            </div>

        </div>

        <button @click="sidebarOpen = false"
                class="lg:hidden text-gray-400 hover:text-[#6C4E97]">
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>

    {{-- MENU --}}
    <nav class="flex-1 py-4 overflow-y-auto">

        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-6 mb-3">
            MENU
        </p>

        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 text-sm font-medium rounded-xl mx-3 transition
           {{ request()->routeIs('dashboard') 
                ? 'bg-[#F0EBF7] text-[#6C4E97] font-semibold' 
                : 'text-gray-600 hover:bg-gray-50' }}">

            <i class="fa-solid fa-house w-5 text-center"></i>
            <span>Beranda</span>
        </a>

        {{-- BUKU --}}
        <a href="{{ route('books.index') }}"
           class="flex items-center gap-3 px-6 py-3 text-sm font-medium rounded-xl mx-3 transition
           {{ request()->routeIs('books.*') 
                ? 'bg-[#F0EBF7] text-[#6C4E97] font-semibold' 
                : 'text-gray-600 hover:bg-gray-50' }}">

            <i class="fa-solid fa-book w-5 text-center"></i>
            <span>Data Buku</span>
        </a>

        {{-- PEMINJAMAN --}}
        <a href="{{ route('transactions.index') }}"
           class="flex items-center gap-3 px-6 py-3 text-sm font-medium rounded-xl mx-3 transition
           {{ request()->routeIs('transactions.*') 
                ? 'bg-[#F0EBF7] text-[#6C4E97] font-semibold' 
                : 'text-gray-600 hover:bg-gray-50' }}">

            <i class="fa-solid fa-arrow-right-arrow-left w-5 text-center"></i>
            <span>Peminjaman</span>
        </a>

    </nav>

</aside>
