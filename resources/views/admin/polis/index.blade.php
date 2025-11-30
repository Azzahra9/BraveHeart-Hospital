<x-app-layout>
    <x-slot name="header">
        {{ __('Manajemen Poli') }}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" 
         x-data="{ 
            showDeleteModal: false, 
            deleteUrl: '',
            activePoliName: '' 
         }">

        <!-- 1. HEADER BANNER (Modern Slim) -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2.5rem] p-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6">
            <!-- Texture Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <div class="relative z-10 flex items-center gap-5">
                <div class="h-16 w-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-inner">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold tracking-tight mb-1">Manajemen Poli</h2>
                    <p class="text-red-100 text-sm font-medium opacity-90">Kelola unit layanan dan spesialisasi rumah sakit.</p>
                </div>
            </div>

            <div class="relative z-10">
                <a href="{{ route('admin.polis.create') }}" class="group bg-white text-red-900 px-6 py-3 rounded-2xl text-sm font-bold shadow-lg hover:shadow-xl hover:bg-gray-50 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <div class="bg-red-100 p-1 rounded-full group-hover:bg-red-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    Tambah Poli Baru
                </a>
            </div>
        </div>

        <!-- 2. STATISTIK RINGKAS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Total Poli -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-red-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-red-50 text-red-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Layanan</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $polis->total() }}</h3>
                    </div>
                </div>
            </div>
            
            <!-- Placeholder Statistik Lain (Opsional) -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-blue-100 transition-all group opacity-60">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-blue-50 text-blue-600 rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status</p>
                        <h3 class="text-lg font-bold text-gray-800">Aktif</h3>
                    </div>
                </div>
            </div>
             <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-green-100 transition-all group opacity-60">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-green-50 text-green-600 rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Sistem</p>
                        <h3 class="text-lg font-bold text-gray-800">Terintegrasi</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. TABEL DATA POLI -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-red-800 rounded-full"></span>
                    Daftar Poli & Layanan
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-50">
                        <tr>
                            <th class="px-8 py-4">Nama Poli</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4 text-center">Tim Dokter</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @foreach($polis as $poli)
                        <tr class="hover:bg-red-50/30 transition duration-200 group">
                            <!-- Nama Poli -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-red-50 text-red-800 flex items-center justify-center font-bold border border-red-100 shadow-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <span class="font-bold text-gray-900 text-base">{{ $poli->nama_poli }}</span>
                                </div>
                            </td>

                            <!-- Deskripsi -->
                            <td class="px-6 py-5 text-gray-600 max-w-xs truncate">
                                {{ $poli->deskripsi ?? '-' }}
                            </td>

                            <!-- Tim Dokter -->
                            <td class="px-6 py-5 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $poli->dokters->count() }} Dokter
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.polis.edit', $poli->id) }}" class="p-2 bg-white text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-xl border border-gray-100 hover:border-gray-300 transition shadow-sm" title="Edit Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    
                                    <!-- Trigger Modal Hapus -->
                                    <button @click="showDeleteModal = true; deleteUrl = '{{ route('admin.polis.destroy', $poli->id) }}'; activePoliName = '{{ $poli->nama_poli }}'" 
                                            class="p-2 bg-white text-red-300 hover:text-red-600 hover:bg-red-50 rounded-xl border border-gray-100 hover:border-red-200 transition shadow-sm" 
                                            title="Hapus Poli">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="p-6 border-t border-gray-100 bg-gray-50/30">
                {{ $polis->links() }}
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
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Poli?</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4">
                        Apakah Anda yakin ingin menghapus poli <span class="font-bold text-gray-800" x-text="activePoliName"></span>?
                    </p>
                    <p class="text-xs text-red-500 bg-red-50 p-3 rounded-xl border border-red-100">
                        <strong>Peringatan:</strong> Tindakan ini mungkin mempengaruhi data dokter yang terdaftar di poli ini.
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