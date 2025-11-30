<x-app-layout>
    <x-slot name="header">
        {{ __('Data Pasien') }}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" 
         x-data="{ 
            showDetail: false, 
            activePatient: {},
            showDeleteModal: false,
            deleteUrl: ''
         }">

        <!-- 1. HEADER BANNER (Modern Slim) -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2.5rem] p-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6">
            <!-- Texture -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <div class="relative z-10">
                <h2 class="text-3xl font-bold tracking-tight mb-1">Manajemen Pasien</h2>
                <p class="text-red-100 text-sm font-medium opacity-90">Kelola data dan akun pasien terdaftar.</p>
            </div>

            <div class="relative z-10">
                <a href="{{ route('admin.users.create') }}" class="group bg-white text-red-900 px-6 py-3 rounded-2xl text-sm font-bold shadow-lg hover:shadow-xl hover:bg-gray-50 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <div class="bg-red-100 p-1 rounded-full group-hover:bg-red-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    Registrasi Pasien
                </a>
            </div>
        </div>

        <!-- 2. STATISTIK & FILTER -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Kartu Statistik -->
            <div class="lg:col-span-1 grid grid-cols-2 gap-4">
                <!-- Total Pasien -->
                <div class="bg-white p-5 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-blue-100 transition-all group">
                    <div class="h-10 w-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Total Pasien</p>
                    <h3 class="text-2xl font-extrabold text-gray-900">{{ $total_pasien }}</h3>
                </div>

                <!-- Baru Hari Ini -->
                <div class="bg-white p-5 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-green-100 transition-all group">
                    <div class="h-10 w-10 flex items-center justify-center bg-green-50 text-green-600 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Baru Hari Ini</p>
                    <h3 class="text-2xl font-extrabold text-gray-900">{{ $today_pasien }}</h3>
                </div>
            </div>

            <!-- Toolbar Filter -->
            <div class="lg:col-span-2 bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white flex flex-col justify-center">
                <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 items-center">
                    
                    <!-- Sorting -->
                    <div class="w-full md:w-auto relative">
                        <select name="sort" onchange="this.form.submit()" class="w-full md:w-auto appearance-none pl-4 pr-10 py-2.5 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-600 bg-gray-50 font-medium cursor-pointer hover:bg-gray-100 transition">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru Mendaftar</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama Mendaftar</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="flex-1 w-full relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email pasien..." 
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/50 text-sm bg-white shadow-sm font-medium placeholder-gray-400">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                    
                    @if(request()->hasAny(['search', 'sort']))
                        <a href="{{ url()->current() }}" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition shadow-sm" title="Reset Filter">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- 3. TABEL DATA PASIEN -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30">
                <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
                    Direktori Pasien
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-50">
                        <tr>
                            <th class="px-8 py-4">Profil Pasien</th>
                            <th class="px-6 py-4">Kontak</th>
                            <th class="px-6 py-4">Status Akun</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($patients as $patient)
                        <tr class="hover:bg-blue-50/30 transition duration-200 group">
                            <!-- Kolom Profil -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 text-white flex items-center justify-center font-bold text-sm shadow-md border-2 border-white group-hover:scale-110 transition-transform">
                                        {{ substr($patient->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-base">{{ $patient->name }}</p>
                                        <p class="text-[11px] text-gray-400 font-medium font-mono">ID: #PAT-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Kolom Kontak -->
                            <td class="px-6 py-5 text-gray-600 font-medium">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $patient->email }}
                                </div>
                            </td>

                            <!-- Kolom Status -->
                            <td class="px-6 py-5">
                                @if($patient->email_verified_at)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-green-50 text-green-700 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Terverifikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Belum Verifikasi
                                    </span>
                                @endif
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Tombol Lihat Detail -->
                                    <button @click="showDetail = true; activePatient = { 
                                        name: '{{ $patient->name }}', 
                                        email: '{{ $patient->email }}', 
                                        id: '#PAT-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}',
                                        joined: '{{ $patient->created_at->format('d M Y') }}',
                                        initial: '{{ substr($patient->name, 0, 1) }}'
                                    }" class="p-2 bg-white text-blue-500 hover:bg-blue-50 rounded-xl border border-gray-100 hover:border-blue-200 transition shadow-sm" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.users.edit', $patient->id) }}" class="p-2 bg-white text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-xl border border-gray-100 hover:border-gray-300 transition shadow-sm" title="Edit Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    
                                    <!-- Tombol Hapus (Trigger Modal) -->
                                    <button @click="showDeleteModal = true; deleteUrl = '{{ route('admin.users.destroy', $patient->id) }}'" 
                                            class="p-2 bg-white text-red-300 hover:text-red-600 hover:bg-red-50 rounded-xl border border-gray-100 hover:border-red-200 transition shadow-sm" 
                                            title="Hapus Data">
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
                                    Tidak ada data pasien yang cocok dengan pencarian Anda.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-6 border-t border-gray-100 bg-gray-50/30">
                {{ $patients->links() }}
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
                
                <div class="h-24 w-24 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-bold text-5xl mx-auto mb-4 shadow-xl ring-4 ring-blue-50">
                    <span x-text="activePatient.initial"></span>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-1" x-text="activePatient.name"></h3>
                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-[10px] font-bold uppercase tracking-wide border border-blue-100">Pasien</span>

                <div class="mt-8 space-y-4 text-left bg-gray-50 p-5 rounded-2xl border border-gray-100">
                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-500 text-xs uppercase font-bold">ID Sistem</span>
                        <span class="text-gray-900 font-medium text-sm font-mono bg-white px-2 py-0.5 rounded border border-gray-200" x-text="activePatient.id"></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-500 text-xs uppercase font-bold">Email</span>
                        <span class="text-gray-900 font-medium text-sm truncate max-w-[150px]" x-text="activePatient.email"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 text-xs uppercase font-bold">Bergabung</span>
                        <span class="text-gray-900 font-medium text-sm" x-text="activePatient.joined"></span>
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
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Data Pasien?</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Apakah Anda yakin ingin menghapus data pasien ini? <br>
                        <span class="text-red-600 font-medium">Tindakan ini akan menghapus riwayat medis dan janji temu terkait secara permanen.</span>
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