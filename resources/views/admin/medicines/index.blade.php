<x-app-layout>
    <x-slot name="header">
        {{ __('Manajemen Obat') }}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" 
         x-data="{ 
            showDeleteModal: false, 
            deleteUrl: '',
            activeMedicineName: '' 
         }">

        <!-- 1. HEADER BANNER -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2.5rem] p-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6">
            <!-- Texture Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <div class="relative z-10 flex items-center gap-5">
                <div class="h-16 w-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-inner">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold tracking-tight mb-1">Inventaris Farmasi</h2>
                    <p class="text-red-100 text-sm font-medium opacity-90">Kelola stok obat dan alat kesehatan.</p>
                </div>
            </div>

            <div class="relative z-10">
                <a href="{{ route('admin.medicines.create') }}" class="group bg-white text-red-900 px-6 py-3 rounded-2xl text-sm font-bold shadow-lg hover:shadow-xl hover:bg-gray-50 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <div class="bg-red-100 p-1 rounded-full group-hover:bg-red-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    Tambah Obat Baru
                </a>
            </div>
        </div>

        <!-- 2. STATISTIK & FILTER -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Kartu Statistik -->
            <div class="lg:col-span-1 grid grid-cols-2 gap-4">
                <!-- Total Jenis Obat -->
                <div class="bg-white p-5 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-blue-100 transition-all group">
                    <div class="h-10 w-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Total Jenis</p>
                    <h3 class="text-2xl font-extrabold text-gray-900">{{ $medicines->total() }}</h3>
                </div>

                <!-- Stok Menipis -->
                <div class="bg-white p-5 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-yellow-100 transition-all group">
                    <div class="h-10 w-10 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Stok Menipis</p>
                    <h3 class="text-2xl font-extrabold text-gray-900">{{ $medicines->where('stok', '<', 10)->count() }}</h3>
                </div>
            </div>

            <!-- Toolbar Filter -->
            <div class="lg:col-span-2 bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white flex flex-col justify-center">
                <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 items-center">
                    
                    <div class="flex gap-3 w-full md:w-auto">
                        <select name="stock" onchange="this.form.submit()" class="w-full md:w-auto border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-600 bg-gray-50 font-medium cursor-pointer hover:bg-gray-100 transition">
                            <option value="">Status Stok</option>
                            <option value="available" {{ request('stock') == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="out_of_stock" {{ request('stock') == 'out_of_stock' ? 'selected' : '' }}>Habis</option>
                        </select>

                        <select name="sort" onchange="this.form.submit()" class="w-full md:w-auto border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-600 bg-gray-50 font-medium cursor-pointer hover:bg-gray-100 transition">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>A-Z</option>
                            <option value="stock_low" {{ request('sort') == 'stock_low' ? 'selected' : '' }}>Stok Min</option>
                            <option value="stock_high" {{ request('sort') == 'stock_high' ? 'selected' : '' }}>Stok Max</option>
                        </select>
                    </div>

                    <div class="flex-1 w-full relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama obat..." 
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/50 text-sm bg-white shadow-sm font-medium placeholder-gray-400">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                    
                    @if(request()->hasAny(['search', 'stock', 'sort']))
                        <a href="{{ url()->current() }}" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition shadow-sm" title="Reset Filter">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- 3. TABEL OBAT -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-red-800 rounded-full"></span>
                    Daftar Obat & Alkes
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-50">
                        <tr>
                            <th class="px-8 py-4">Gambar</th>
                            <th class="px-6 py-4">Detail Obat</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4 text-center">Stok</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($medicines as $medicine)
                        <tr class="hover:bg-red-50/30 transition duration-200 group">
                            <!-- Kolom Gambar -->
                            <td class="px-8 py-4">
                                <div class="h-12 w-12 rounded-xl overflow-hidden border border-gray-100 shadow-sm bg-gray-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    @if($medicine->gambar)
                                        <img src="{{ asset('storage/' . $medicine->gambar) }}" alt="{{ $medicine->nama }}" class="h-full w-full object-cover">
                                    @else
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                            </td>

                            <!-- Kolom Nama -->
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900 text-base">{{ $medicine->nama }}</p>
                                <p class="text-[11px] text-gray-500 mt-0.5 truncate max-w-[200px]" title="{{ $medicine->deskripsi }}">
                                    {{ Str::limit($medicine->deskripsi, 50) }}
                                </p>
                            </td>

                            <!-- Kolom Kategori -->
                            <td class="px-6 py-4">
                                @if($medicine->tipe == 'obat keras')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-red-50 text-red-700 text-[10px] font-bold border border-red-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Obat Keras
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-green-50 text-green-700 text-[10px] font-bold border border-green-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Biasa
                                    </span>
                                @endif
                            </td>

                            <!-- Kolom Stok -->
                            <td class="px-6 py-4 text-center">
                                @if($medicine->stok == 0)
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-500 border border-gray-200">Habis</span>
                                @elseif($medicine->stok < 10)
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200 animate-pulse">
                                        {{ $medicine->stok }} (Menipis)
                                    </span>
                                @else
                                    <span class="font-mono font-bold text-gray-700 bg-gray-50 px-3 py-1 rounded-lg border border-gray-200">
                                        {{ $medicine->stok }}
                                    </span>
                                @endif
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.medicines.edit', $medicine->id) }}" class="p-2 bg-white text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-xl border border-gray-100 hover:border-gray-300 transition shadow-sm" title="Edit Obat">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    
                                    <!-- Trigger Modal Hapus -->
                                    <button @click="showDeleteModal = true; deleteUrl = '{{ route('admin.medicines.destroy', $medicine->id) }}'; activeMedicineName = '{{ $medicine->nama }}'" 
                                            class="p-2 bg-white text-red-300 hover:text-red-600 hover:bg-red-50 rounded-xl border border-gray-100 hover:border-red-200 transition shadow-sm" 
                                            title="Hapus Obat">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">
                                Tidak ada data obat yang cocok dengan pencarian Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-6 border-t border-gray-100 bg-gray-50/30">
                {{ $medicines->links() }}
            </div>
        </div>

        <!-- 4. MODAL POPUP HAPUS (AlpineJS) -->
        <div x-show="showDeleteModal" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showDeleteModal = false"></div>

            <div class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100"
                 x-show="showDeleteModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
                
                <div class="bg-white p-8 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-50 mb-6 border border-red-100">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Obat?</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4">
                        Apakah Anda yakin ingin menghapus obat <span class="font-bold text-gray-800" x-text="activeMedicineName"></span> dari inventaris?
                    </p>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-center gap-3">
                    <button type="button" @click="showDeleteModal = false" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-300 shadow-sm hover:bg-gray-50 transition">
                        Batal
                    </button>
                    
                    <form :action="deleteUrl" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-5 py-2.5 bg-red-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-red-600/30 hover:bg-red-700 transition">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>