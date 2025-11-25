<x-app-layout>
    <x-slot name="header">
        {{ __('Data Pasien') }}
    </x-slot>

    <!-- 1. STATISTIK PASIEN -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card Total Pasien -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pasien</p>
                <p class="text-2xl font-bold text-gray-900">{{ $total_pasien }}</p>
            </div>
        </div>

        <!-- Card Pasien Baru Hari Ini -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mendaftar Hari Ini</p>
                <p class="text-2xl font-bold text-gray-900">{{ $today_pasien }}</p>
            </div>
        </div>
        
        <!-- Card Action (UPDATED: MAROON STYLE) -->
        <div class="flex items-center justify-end">
            <a href="{{ route('admin.users.create') }}" class="w-full md:w-auto bg-primary hover:bg-red-800 text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-red-900/20 transition flex items-center justify-center gap-3 transform hover:-translate-y-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Registrasi Pasien
            </a>
        </div>
    </div>

    <!-- 2. TOOLBAR PENCARIAN & SORTING (BARU) -->
    <div class="mb-6 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
        <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 justify-between items-center">
            
            <!-- Sorting Dropdown -->
            <div class="w-full md:w-auto">
                <select name="sort" onchange="this.form.submit()" class="w-full md:w-auto border-gray-200 rounded-xl text-sm focus:ring-primary focus:border-primary text-gray-600 bg-gray-50/50">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru Mendaftar</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama Mendaftar</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                </select>
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <!-- Search Bar -->
                <div class="relative w-full md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email pasien..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 text-sm bg-gray-50/50">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                
                <!-- Reset Button -->
                @if(request()->hasAny(['search', 'sort']))
                    <a href="{{ url()->current() }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition flex items-center justify-center" title="Reset Filter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- 3. TABEL PASIEN -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ showDetail: false, activePatient: {} }">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Profil Pasien</th>
                        <th class="px-6 py-4">Kontak Email</th>
                        <th class="px-6 py-4">Status Akun</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($patients as $patient)
                    <tr class="hover:bg-blue-50/30 transition duration-200">
                        <!-- Kolom Profil -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="h-11 w-11 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 text-white flex items-center justify-center font-bold text-lg shadow-md border-2 border-white">
                                    {{ substr($patient->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-base">{{ $patient->name }}</p>
                                    <p class="text-xs text-gray-400 font-mono">ID: #PAT-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Kolom Kontak -->
                        <td class="px-6 py-4 text-gray-600 font-medium">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ $patient->email }}
                            </div>
                        </td>

                        <!-- Kolom Status -->
                        <td class="px-6 py-4">
                            @if($patient->email_verified_at)
                                <span class="px-3 py-1 inline-flex items-center gap-1 text-xs font-bold rounded-full bg-green-50 text-green-700 border border-green-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Terverifikasi
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex items-center gap-1 text-xs font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Belum Verifikasi
                                </span>
                            @endif
                        </td>

                        <!-- Kolom Aksi -->
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <!-- Tombol Lihat Detail -->
                                <button @click="showDetail = true; activePatient = { 
                                    name: '{{ $patient->name }}', 
                                    email: '{{ $patient->email }}', 
                                    id: '#PAT-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}',
                                    joined: '{{ $patient->created_at->format('d M Y') }}',
                                    initial: '{{ substr($patient->name, 0, 1) }}'
                                }" class="p-2 text-blue-500 hover:bg-blue-100 rounded-lg transition shadow-sm border border-transparent hover:border-blue-200" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>

                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.users.edit', $patient->id) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-gray-100 rounded-lg transition shadow-sm border border-transparent hover:border-gray-200" title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.users.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Hapus data pasien ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition shadow-sm border border-transparent hover:border-red-100" title="Hapus Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                            Tidak ada data pasien yang cocok dengan pencarian Anda.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $patients->links() }}
        </div>

        <!-- MODAL DETAIL PASIEN -->
        <div x-show="showDetail" 
             class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-6"
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90">
            
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showDetail = false"></div>

            <div class="relative bg-white rounded-3xl shadow-2xl max-w-sm w-full p-0 overflow-hidden transform transition-all">
                
                <!-- Header Modal -->
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6 text-center relative">
                    <button @click="showDetail = false" class="absolute top-4 right-4 text-white/70 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>

                    <div class="h-24 w-24 rounded-full bg-white text-blue-600 flex items-center justify-center font-bold text-5xl mx-auto mb-4 shadow-lg ring-4 ring-white/30">
                        <span x-text="activePatient.initial"></span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-white mb-1 tracking-wide" x-text="activePatient.name"></h3>
                    <span class="px-3 py-1 rounded-full bg-white/20 text-white text-xs font-bold uppercase tracking-wider backdrop-blur-sm">Pasien</span>
                </div>

                <!-- Body Modal -->
                <div class="p-8 space-y-5">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                        <span class="text-gray-400 text-sm font-medium uppercase tracking-wider">ID Sistem</span>
                        <span class="text-gray-800 font-bold font-mono bg-gray-100 px-2 py-1 rounded" x-text="activePatient.id"></span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                        <span class="text-gray-400 text-sm font-medium uppercase tracking-wider">Email</span>
                        <span class="text-gray-800 font-bold text-sm" x-text="activePatient.email"></span>
                    </div>
                    <div class="flex justify-between items-center pb-2">
                        <span class="text-gray-400 text-sm font-medium uppercase tracking-wider">Bergabung</span>
                        <span class="text-gray-800 font-bold text-sm" x-text="activePatient.joined"></span>
                    </div>

                    <div class="mt-8 pt-4">
                        <button @click="showDetail = false" class="w-full py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition shadow-sm hover:shadow-md">
                            Tutup Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>