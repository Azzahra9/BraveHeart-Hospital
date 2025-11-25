<x-app-layout>
    <x-slot name="header">
        {{ __('Manajemen Obat') }}
    </x-slot>

    <!-- 1. STATISTIK STOK OBAT -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Jenis Obat -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Jenis Obat</p>
                <p class="text-2xl font-bold text-gray-900">{{ $medicines->total() }}</p>
            </div>
        </div>

        <!-- Obat Stok Menipis (Contoh Statistik Tambahan) -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-yellow-50 rounded-full text-yellow-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Stok Menipis (<10)</p>
                <!-- Hitung manual di view untuk sementara (atau pass dari controller lebih baik) -->
                <p class="text-2xl font-bold text-gray-900">{{ $medicines->where('stok', '<', 10)->count() }}</p>
            </div>
        </div>

        <!-- Card Action -->
        <div class="flex items-center justify-end">
            <a href="{{ route('admin.medicines.create') }}" class="w-full md:w-auto bg-primary hover:bg-red-800 text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-red-900/20 transition flex items-center justify-center gap-3 transform hover:-translate-y-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Obat Baru
            </a>
        </div>
    </div>

    <!-- 2. TOOLBAR PENCARIAN & FILTER (BARU) -->
    <div class="mb-6 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
        <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 justify-between items-center">
            
            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                <!-- Filter Stok -->
                <select name="stock" onchange="this.form.submit()" class="border-gray-200 rounded-xl text-sm focus:ring-primary focus:border-primary text-gray-600 bg-gray-50/50">
                    <option value="">Semua Status Stok</option>
                    <option value="available" {{ request('stock') == 'available' ? 'selected' : '' }}>Stok Tersedia</option>
                    <option value="out_of_stock" {{ request('stock') == 'out_of_stock' ? 'selected' : '' }}>Stok Habis (0)</option>
                </select>

                <!-- Sorting -->
                <select name="sort" onchange="this.form.submit()" class="border-gray-200 rounded-xl text-sm focus:ring-primary focus:border-primary text-gray-600 bg-gray-50/50">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru Ditambahkan</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                    <option value="stock_low" {{ request('sort') == 'stock_low' ? 'selected' : '' }}>Stok Terendah</option>
                    <option value="stock_high" {{ request('sort') == 'stock_high' ? 'selected' : '' }}>Stok Tertinggi</option>
                </select>
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <!-- Search Bar -->
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama obat..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 text-sm bg-gray-50/50">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                
                <!-- Reset Button -->
                @if(request()->hasAny(['search', 'stock', 'sort']))
                    <a href="{{ url()->current() }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition flex items-center justify-center" title="Reset Filter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- 3. TABEL OBAT -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Gambar</th>
                        <th class="px-6 py-4">Nama Obat</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4 text-center">Stok</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($medicines as $medicine)
                    <tr class="hover:bg-gray-50 transition">
                        <!-- Kolom Gambar -->
                        <td class="px-6 py-4">
                            @if($medicine->gambar)
                                <img src="{{ asset('storage/' . $medicine->gambar) }}" alt="{{ $medicine->nama }}" class="h-12 w-12 rounded-xl object-cover border border-gray-200 shadow-sm">
                            @else
                                <div class="h-12 w-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>

                        <!-- Kolom Nama & Deskripsi -->
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-900 text-base">{{ $medicine->nama }}</p>
                            <p class="text-xs text-gray-400 font-normal mt-0.5 truncate max-w-xs" title="{{ $medicine->deskripsi }}">{{ Str::limit($medicine->deskripsi, 50) }}</p>
                        </td>

                        <!-- Kolom Tipe -->
                        <td class="px-6 py-4">
                            @if($medicine->tipe == 'obat keras')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700 border border-red-200 uppercase tracking-wide">
                                    Obat Keras
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200 uppercase tracking-wide">
                                    Biasa
                                </span>
                            @endif
                        </td>

                        <!-- Kolom Stok -->
                        <td class="px-6 py-4 text-center">
                            @if($medicine->stok == 0)
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-500 border border-gray-200">Habis</span>
                            @elseif($medicine->stok < 10)
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">
                                    {{ $medicine->stok }} (Menipis)
                                </span>
                            @else
                                <span class="font-mono font-bold text-gray-700 bg-gray-50 px-2 py-1 rounded border border-gray-200">
                                    {{ $medicine->stok }}
                                </span>
                            @endif
                        </td>

                        <!-- Kolom Aksi -->
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.medicines.edit', $medicine->id) }}" class="p-2 text-gray-400 hover:text-primary hover:bg-red-50 rounded-lg transition" title="Edit Obat">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                
                                <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" onsubmit="return confirm('Hapus obat ini dari daftar?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus Obat">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">
                            Tidak ada data obat yang cocok dengan pencarian Anda.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $medicines->links() }}
        </div>
    </div>
</x-app-layout>