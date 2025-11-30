<x-app-layout>
    <x-slot name="header">
        {{ __('Akun Internal (Staf)') }}
    </x-slot>

    <!-- Container dengan AlpineJS untuk Modal Detail & Hapus -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" 
         x-data="{ 
            showDetail: false, 
            activeUser: {},
            showDeleteModal: false,
            deleteUrl: ''
         }">

        <!-- 1. HEADER BANNER (Modern) -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2.5rem] p-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <div class="relative z-10">
                <h2 class="text-3xl font-bold tracking-tight mb-1">Manajemen Staf</h2>
                <p class="text-red-100 text-sm font-medium opacity-90">Kelola akun Dokter dan Administrator sistem.</p>
            </div>

            <div class="relative z-10">
                <a href="{{ route('admin.users.create') }}" class="group bg-white text-red-900 px-6 py-3 rounded-2xl text-sm font-bold shadow-lg hover:shadow-xl hover:bg-gray-50 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <div class="bg-red-100 p-1 rounded-full group-hover:bg-red-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    Tambah Staf Baru
                </a>
            </div>
        </div>

        <!-- 2. STATISTIK & FILTER -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kartu Statistik -->
            <div class="lg:col-span-1 grid grid-cols-2 gap-4">
                <!-- Total Dokter -->
                <div class="bg-white p-5 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-red-100 transition-all group">
                    <div class="h-10 w-10 flex items-center justify-center bg-red-50 text-red-600 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Total Dokter</p>
                    <h3 class="text-2xl font-extrabold text-gray-900">{{ $total_dokter }}</h3>
                </div>

                <!-- Administrator -->
                <div class="bg-white p-5 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-gray-200 transition-all group">
                    <div class="h-10 w-10 flex items-center justify-center bg-gray-100 text-gray-600 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Administrator</p>
                    <h3 class="text-2xl font-extrabold text-gray-900">{{ $total_admin }}</h3>
                </div>
            </div>

            <!-- Toolbar Filter -->
            <div class="lg:col-span-2 bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white flex flex-col justify-center">
                <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 items-center">
                    
                    <div class="flex gap-3 w-full md:w-auto">
                        <select name="role" onchange="this.form.submit()" class="w-full md:w-auto border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-600 bg-gray-50 font-medium cursor-pointer hover:bg-gray-100 transition">
                            <option value="">Semua Jabatan</option>
                            <option value="dokter" {{ request('role') == 'dokter' ? 'selected' : '' }}>Hanya Dokter</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Hanya Admin</option>
                        </select>

                        <select name="sort" onchange="this.form.submit()" class="w-full md:w-auto border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-600 bg-gray-50 font-medium cursor-pointer hover:bg-gray-100 transition">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Z-A</option>
                        </select>
                    </div>

                    <div class="flex-1 w-full relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." 
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/50 text-sm bg-white shadow-sm font-medium placeholder-gray-400">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                    
                    @if(request()->hasAny(['search', 'role', 'sort']))
                        <a href="{{ url()->current() }}" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition shadow-sm" title="Reset Filter">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- 3. TABEL DATA STAF -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30">
                <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-red-800 rounded-full"></span>
                    Daftar Staf
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-50">
                        <tr>
                            <th class="px-8 py-4">Nama & Email</th>
                            <th class="px-6 py-4">Jabatan</th>
                            <th class="px-6 py-4">Unit Kerja</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($users as $user)
                        <tr class="hover:bg-red-50/30 transition duration-200 group">
                            <!-- Kolom Nama -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full flex items-center justify-center font-bold text-white shadow-md group-hover:scale-110 transition-transform border-2 border-white
                                        {{ $user->role == 'admin' ? 'bg-gray-700' : 'bg-gradient-to-br from-red-600 to-red-800' }}">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-base">{{ $user->name }}</p>
                                        <p class="text-[11px] text-gray-500 font-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Kolom Jabatan -->
                            <td class="px-6 py-5">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-700 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Administrator
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-red-50 text-red-700 border border-red-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Dokter
                                    </span>
                                @endif
                            </td>

                            <!-- Kolom Unit Kerja -->
                            <td class="px-6 py-5">
                                @if($user->role === 'dokter' && $user->poli)
                                    <div class="flex items-center gap-2 text-gray-700 font-medium">
                                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        {{ $user->poli->nama_poli }}
                                    </div>
                                @elseif($user->role === 'dokter')
                                    <span class="text-orange-500 bg-orange-50 px-2 py-0.5 rounded border border-orange-100 text-[10px] font-bold">Belum ada poli</span>
                                @else
                                    <span class="text-gray-400 text-xs italic">Sistem Pusat</span>
                                @endif
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Tombol Lihat Detail (Mata) -->
                                    @if($user->role === 'dokter')
                                    <button @click="showDetail = true; activeUser = { 
                                        name: '{{ $user->name }}', 
                                        email: '{{ $user->email }}', 
                                        role: 'Dokter Spesialis', 
                                        poli: '{{ $user->poli->nama_poli ?? 'Belum ditentukan' }}',
                                        joined: '{{ $user->created_at->format('d M Y') }}'
                                    }" class="p-2 bg-white text-blue-600 hover:bg-blue-50 rounded-xl border border-gray-100 hover:border-blue-200 transition shadow-sm" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    @endif

                                    <!-- Edit -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl border border-gray-100 hover:border-gray-300 transition shadow-sm" title="Edit Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    
                                    <!-- Delete Trigger -->
                                    <button @click="showDeleteModal = true; deleteUrl = '{{ route('admin.users.destroy', $user->id) }}'" 
                                            class="p-2 bg-white text-red-400 hover:bg-red-50 hover:text-red-600 rounded-xl border border-gray-100 hover:border-red-200 transition shadow-sm" 
                                            title="Hapus Akses">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <div class="bg-gray-50 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    Tidak ada data staf yang cocok dengan pencarian Anda.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-6 border-t border-gray-100 bg-gray-50/30">
                {{ $users->links() }}
            </div>
        </div>

        <!-- 4. MODAL POPUP (AlpineJS) -->
        
        <!-- Detail Modal -->
        <div x-show="showDetail" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showDetail = false"></div>

            <div class="relative bg-white rounded-[2rem] shadow-2xl max-w-sm w-full p-8 transform transition-all scale-100 text-center border border-gray-100"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
                
                <div class="h-24 w-24 rounded-full bg-gradient-to-br from-red-600 to-red-800 text-white flex items-center justify-center font-bold text-4xl mx-auto mb-4 shadow-xl ring-4 ring-red-50">
                    <span x-text="activeUser.name ? activeUser.name.charAt(0) : ''"></span>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-1" x-text="activeUser.name"></h3>
                <span class="px-3 py-1 rounded-full bg-red-50 text-red-700 text-[10px] font-bold uppercase tracking-wide border border-red-100" x-text="activeUser.role"></span>

                <div class="mt-8 space-y-4 text-left bg-gray-50 p-5 rounded-2xl border border-gray-100">
                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-500 text-xs uppercase font-bold">Email</span>
                        <span class="text-gray-900 font-medium text-sm" x-text="activeUser.email"></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-500 text-xs uppercase font-bold">Poli</span>
                        <span class="text-gray-900 font-medium text-sm" x-text="activeUser.poli"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 text-xs uppercase font-bold">Bergabung</span>
                        <span class="text-gray-900 font-medium text-sm" x-text="activeUser.joined"></span>
                    </div>
                </div>

                <button @click="showDetail = false" class="mt-6 w-full py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition shadow-lg">
                    Tutup
                </button>
            </div>
        </div>

        <!-- Delete Modal -->
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Akses Staf?</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Apakah Anda yakin ingin menghapus akun ini? <br>
                        <span class="text-red-600 font-medium">Tindakan ini permanen</span> dan staf tidak akan bisa login kembali.
                    </p>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-center gap-3">
                    <button type="button" @click="showDeleteModal = false" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-300 shadow-sm hover:bg-gray-50 transition">
                        Batal
                    </button>
                    
                    <form :action="deleteUrl" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-6 py-3 bg-red-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-red-600/30 hover:bg-red-700 transition">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>