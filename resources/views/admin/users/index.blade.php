<x-app-layout>
    <x-slot name="header">
        {{ __('Akun Internal (Staf)') }}
    </x-slot>

    <!-- 1. STATISTIK STAF (BARU) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card Dokter -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-red-50 rounded-full text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Dokter</p>
                <p class="text-2xl font-bold text-gray-900">{{ $total_dokter }}</p>
            </div>
        </div>

        <!-- Card Admin -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-gray-100 rounded-full text-gray-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Administrator</p>
                <p class="text-2xl font-bold text-gray-900">{{ $total_admin }}</p>
            </div>
        </div>

        <!-- Card Action -->
        <div class="flex items-center justify-end">
            <a href="{{ route('admin.users.create') }}" class="w-full md:w-auto bg-primary hover:bg-red-800 text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-red-900/20 transition flex items-center justify-center gap-3 transform hover:-translate-y-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Staf Baru
            </a>
        </div>
    </div>

    <!-- 2. TABEL MODERN -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ showDetail: false, activeUser: {} }">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Nama & Email</th>
                        <th class="px-6 py-4">Jabatan</th>
                        <th class="px-6 py-4">Unit Kerja</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <!-- Kolom Nama -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="h-10 w-10 rounded-full flex items-center justify-center font-bold text-white shadow-sm 
                                    {{ $user->role == 'admin' ? 'bg-gray-700' : 'bg-primary' }}">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-base">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Kolom Jabatan -->
                        <td class="px-6 py-4">
                            @if($user->role === 'admin')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-700 border border-gray-200">
                                    Administrator
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-50 text-primary border border-red-100">
                                    Dokter Spesialis
                                </span>
                            @endif
                        </td>

                        <!-- Kolom Unit Kerja -->
                        <td class="px-6 py-4">
                            @if($user->role === 'dokter' && $user->poli)
                                <div class="flex items-center gap-2 text-gray-700 font-medium">
                                    <span class="w-2 h-2 bg-primary rounded-full"></span>
                                    {{ $user->poli->nama_poli }}
                                </div>
                            @elseif($user->role === 'dokter')
                                <span class="text-yellow-600 italic text-xs bg-yellow-50 px-2 py-1 rounded">Belum ada poli</span>
                            @else
                                <span class="text-gray-400 text-xs italic">Sistem Pusat</span>
                            @endif
                        </td>

                        <!-- Kolom Aksi (Konsisten Merah) -->
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <!-- Tombol Lihat Detail (Mata) -->
                                @if($user->role === 'dokter')
                                <button @click="showDetail = true; activeUser = { 
                                    name: '{{ $user->name }}', 
                                    email: '{{ $user->email }}', 
                                    role: 'Dokter Spesialis', 
                                    poli: '{{ $user->poli->nama_poli ?? 'Belum ditentukan' }}',
                                    joined: '{{ $user->created_at->format('d M Y') }}'
                                }" class="p-2 text-primary hover:bg-red-50 rounded-lg transition" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                @endif

                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-gray-400 hover:text-primary hover:bg-red-50 rounded-lg transition" title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus akses staf ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus Akses">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $users->links() }}
        </div>

        <!-- MODAL DETAIL USER (AESTHETIC) -->
        <div x-show="showDetail" 
             class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-6"
             style="display: none;">
            
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="showDetail = false"></div>

            <div class="relative bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 transform transition-all scale-100 text-center">
                <!-- Tombol Close -->
                <button @click="showDetail = false" class="absolute top-4 right-4 text-gray-300 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="h-24 w-24 rounded-full bg-gradient-to-br from-primary to-red-600 text-white flex items-center justify-center font-bold text-4xl mx-auto mb-4 shadow-lg ring-4 ring-red-50">
                    <span x-text="activeUser.name ? activeUser.name.charAt(0) : ''"></span>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-1" x-text="activeUser.name"></h3>
                <span class="px-3 py-1 rounded-full bg-red-50 text-primary text-xs font-bold uppercase tracking-wide" x-text="activeUser.role"></span>

                <div class="mt-6 space-y-4 text-left">
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 text-sm">Email</span>
                        <span class="text-gray-900 font-medium text-sm" x-text="activeUser.email"></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500 text-sm">Poli</span>
                        <span class="text-gray-900 font-medium text-sm" x-text="activeUser.poli"></span>
                    </div>
                    <div class="flex justify-between pb-2">
                        <span class="text-gray-500 text-sm">Bergabung</span>
                        <span class="text-gray-900 font-medium text-sm" x-text="activeUser.joined"></span>
                    </div>
                </div>

                <div class="mt-8">
                    <button @click="showDetail = false" class="w-full py-3 bg-primary text-white font-bold rounded-xl hover:bg-red-800 transition shadow-lg shadow-red-900/20">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>