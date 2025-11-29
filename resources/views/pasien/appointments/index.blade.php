<x-app-layout>
    <x-slot name="header">
        {{ __('Status Janji Temu') }}
    </x-slot>

    <!-- KONTEN UTAMA: DAFTAR RIWAYAT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ cancelModalOpen: false, cancelAction: '' }">
        
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm animate-pulse-slow">
                <div class="p-1 bg-green-100 rounded-full text-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @elseif(session('error'))
             <div class="mb-8 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm">
                <div class="p-1 bg-red-100 rounded-full text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white overflow-hidden relative">
            
            <!-- Dekorasi Latar -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-50 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none opacity-60"></div>

            <div class="p-8 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6 relative z-10">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Riwayat Pengajuan</h3>
                    <p class="text-gray-500 text-sm mt-1">Pantau status pendaftaran dan jadwal konsultasi Anda.</p>
                </div>
                <a href="{{ route('pasien.appointments.create') }}" class="group flex items-center gap-2 bg-gradient-to-r from-red-800 to-red-900 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transition-all transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Janji Baru
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-gray-400 font-bold uppercase text-[10px] tracking-wider">
                        <tr>
                            <th class="px-8 py-5">Dokter & Poli</th>
                            <th class="px-6 py-5">Jadwal Konsultasi</th>
                            <th class="px-6 py-5">Keluhan</th>
                            <th class="px-6 py-5 text-center">Status</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($appointments as $appt)
                        <tr class="hover:bg-red-50/30 transition duration-300 group">
                            
                            <!-- Dokter -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <img class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md group-hover:border-red-200 transition duration-300" 
                                             src="{{ $appt->dokter->profile_photo_url }}" 
                                             alt="{{ $appt->dokter->name }}"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($appt->dokter->name) }}&background=E5E7EB&color=374151'">
                                        <!-- Online indicator decoration -->
                                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-base leading-tight">{{ $appt->dokter->name }}</p>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-red-50 text-red-700 border border-red-100">
                                                {{ $appt->dokter->poli->nama_poli ?? 'Umum' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Jadwal -->
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ \Carbon\Carbon::parse($appt->tanggal_booking)->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-gray-500 font-medium mt-1 ml-6 bg-gray-100 px-2 py-0.5 rounded w-max border border-gray-200">
                                        {{ $appt->schedule->jam_mulai ?? '-' }} WIB
                                    </span>
                                </div>
                            </td>

                            <!-- Keluhan -->
                            <td class="px-6 py-5">
                                <div class="text-gray-600 max-w-xs truncate text-xs leading-relaxed bg-gray-50 p-2 rounded-lg border border-gray-100 italic" title="{{ $appt->keluhan }}">
                                    "{{ $appt->keluhan }}"
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-5 text-center">
                                @if($appt->status == 'Pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-orange-50 text-orange-600 border border-orange-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                                        Menunggu
                                    </span>
                                @elseif($appt->status == 'Approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Disetujui
                                    </span>
                                @elseif($appt->status == 'Rejected')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-100">
                                        Ditolak
                                    </span>
                                @elseif($appt->status == 'Cancelled')
                                     <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                        Dibatalkan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-green-50 text-green-600 border border-green-100">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-5 text-center">
                                @if($appt->status == 'Pending')
                                    {{-- Tombol Batalkan memicu Modal --}}
                                    <button @click="cancelModalOpen = true; cancelAction = '{{ route('pasien.appointments.cancel', $appt->id) }}'" 
                                            class="inline-flex items-center gap-1 text-xs font-bold text-red-500 hover:text-red-700 bg-white border border-red-200 hover:bg-red-50 px-3 py-2 rounded-lg transition shadow-sm hover:shadow group/btn">
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Batalkan
                                    </button>
                                @elseif($appt->status == 'Selesai')
                                    <a href="{{ route('pasien.medical-records.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-2 rounded-lg hover:bg-blue-100 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Lihat Hasil
                                    </a>
                                @elseif($appt->status == 'Approved')
                                    <span class="text-[10px] text-gray-400 font-medium italic">Menunggu hari H</span>
                                @else
                                    <span class="text-gray-300 text-lg">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-50 p-4 rounded-full mb-3 shadow-inner">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="text-gray-900 font-bold text-sm">Belum ada riwayat</h3>
                                    <p class="text-gray-500 text-xs mt-1">Anda belum pernah mengajukan janji temu.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $appointments->links() }}
            </div>
        </div>

        <!-- MODAL POPUP BATAL (AlpineJS) -->
        <div x-show="cancelModalOpen" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="cancelModalOpen = false"></div>

            <!-- Modal Content -->
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100"
                 x-show="cancelModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="bg-white p-6 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-50 mb-6">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Batalkan Janji Temu?</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Apakah Anda yakin ingin membatalkan janji temu ini? <br>
                        <span class="text-red-600 font-medium">Tindakan ini tidak dapat dibatalkan</span> dan antrian Anda akan dihapus.
                    </p>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-center gap-3">
                    <button type="button" @click="cancelModalOpen = false" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-300 shadow-sm hover:bg-gray-50 transition">
                        Kembali
                    </button>
                    
                    <form :action="cancelAction" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-5 py-2.5 bg-red-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-red-600/30 hover:bg-red-700 transition">
                            Ya, Batalkan
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>