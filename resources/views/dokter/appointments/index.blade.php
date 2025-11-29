<x-app-layout>
    <x-slot name="header">
        {{ __('Janji Temu Masuk') }}
    </x-slot>

    <!-- Container Utama dengan AlpineJS untuk Modal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" x-data="{ showRejectModal: false, rejectUrl: '' }">

        <!-- 1. STATISTIK RINGKAS (Modern Cards) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Menunggu Konfirmasi -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-orange-100 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-orange-400"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="h-14 w-14 flex items-center justify-center bg-orange-50 text-orange-500 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Menunggu Konfirmasi</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $pendingCount }}</h3>
                    </div>
                </div>
            </div>

            <!-- Pasien Hari Ini -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-green-100 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-green-500"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="h-14 w-14 flex items-center justify-center bg-green-50 text-green-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jadwal Hari Ini</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $todayCount }}</h3>
                    </div>
                </div>
            </div>
            
            <!-- Quick Action: Buat Jadwal -->
            <div class="flex items-center justify-end md:justify-center">
                <a href="{{ route('dokter.schedules.create') }}" class="w-full h-full flex flex-col items-center justify-center bg-white border-2 border-dashed border-red-200 rounded-[2rem] text-red-800 font-bold hover:bg-red-50 hover:border-red-300 transition gap-2 py-4">
                    <div class="bg-red-100 p-2 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <span>Atur Jadwal Praktik</span>
                </a>
            </div>
        </div>

        <!-- 2. TABEL JANJI TEMU (Modern Card) -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white overflow-hidden relative">
            
            <!-- Header Tabel & Pencarian -->
            <div class="p-8 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row md:justify-between md:items-center gap-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <div class="w-2 h-8 bg-red-800 rounded-full"></div>
                        Daftar Pasien
                    </h3>
                    <p class="text-sm text-gray-500 mt-1 ml-4">Kelola antrian dan status pasien Anda.</p>
                </div>

                <!-- Form Pencarian -->
                <form action="{{ route('dokter.appointments.index') }}" method="GET" class="flex w-full md:w-auto gap-3">
                    <div class="relative w-full md:w-72">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-red-500 focus:border-red-500 text-sm bg-white shadow-sm font-medium placeholder-gray-400 transition" 
                               placeholder="Cari nama pasien...">
                    </div>
                    <button type="submit" class="px-6 py-3 bg-red-800 text-white rounded-xl text-sm font-bold hover:bg-red-900 transition shadow-lg shadow-red-900/20">
                        Cari
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div class="mx-8 mt-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm animate-pulse-slow">
                    <div class="bg-green-100 p-1 rounded-full text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto mt-4">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-white text-gray-400 font-bold uppercase text-[10px] tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-8 py-4">Pasien</th>
                            <th class="px-6 py-4">Jadwal</th>
                            <th class="px-6 py-4">Keluhan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($appointments as $appt)
                        <tr class="hover:bg-red-50/30 transition duration-300 group">
                            
                            <!-- Pasien -->
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-red-600 to-red-800 text-white flex items-center justify-center font-bold shadow-md group-hover:scale-110 transition-transform">
                                        {{ substr($appt->pasien->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-sm">{{ $appt->pasien->name }}</p>
                                        <p class="text-[10px] text-gray-400 font-medium">#PAT-{{ $appt->pasien->id }}</p>
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
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded w-max mt-1 border border-gray-200 font-medium ml-6">
                                        {{ $appt->schedule->jam_mulai ?? '-' }} WIB
                                    </span>
                                </div>
                            </td>

                            <!-- Keluhan -->
                            <td class="px-6 py-5">
                                <div class="max-w-xs truncate text-gray-500 italic bg-gray-50 p-2 rounded-lg border border-gray-100 text-xs">
                                    "{{ $appt->keluhan }}"
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-5 text-center">
                                @if($appt->status == 'Pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                        Menunggu
                                    </span>
                                @elseif($appt->status == 'Approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Siap Periksa
                                    </span>
                                @elseif($appt->status == 'Rejected')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-100">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Selesai
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-2">
                                    
                                    <!-- 1. Jika Pending -> Approve/Reject -->
                                    @if($appt->status == 'Pending')
                                        <form action="{{ route('dokter.appointments.updateStatus', $appt->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="Approved">
                                            <button type="submit" class="group/btn flex items-center gap-1 px-3 py-2 bg-green-50 hover:bg-green-100 text-green-700 text-xs font-bold rounded-xl transition border border-green-100" title="Terima Pasien">
                                                <svg class="w-4 h-4 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Terima
                                            </button>
                                        </form>
                                        
                                        <!-- Tombol Tolak memicu Modal -->
                                        <button @click="showRejectModal = true; rejectUrl = '{{ route('dokter.appointments.updateStatus', $appt->id) }}'" 
                                                class="group/btn flex items-center gap-1 px-3 py-2 bg-white hover:bg-red-50 text-gray-400 hover:text-red-600 text-xs font-bold rounded-xl transition border border-gray-200 hover:border-red-100" title="Tolak">
                                            <svg class="w-4 h-4 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    
                                    <!-- 2. Jika Approved -> Periksa -->
                                    @elseif($appt->status == 'Approved')
                                        <a href="{{ route('dokter.medical-records.create', ['appointment_id' => $appt->id]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-red-800 text-white text-xs font-bold rounded-xl hover:bg-red-900 hover:shadow-lg hover:shadow-red-900/20 transition-all transform hover:-translate-y-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                            Mulai Periksa
                                        </a>
                                    
                                    <!-- 3. Jika Selesai -> Lihat Hasil -->
                                    @elseif($appt->status == 'Selesai')
                                        @if($appt->medicalRecord)
                                            <a href="{{ route('dokter.medical-records.show', $appt->medicalRecord->id) }}" class="inline-flex items-center gap-1 text-xs font-bold text-red-800 bg-red-50 px-3 py-2 rounded-xl hover:bg-red-100 transition border border-red-100">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat Rekam
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-300 font-bold border border-gray-100 px-3 py-1 rounded-lg cursor-not-allowed">
                                                Data Hilang
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-50 p-4 rounded-full mb-3 shadow-inner">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p class="font-medium text-gray-500">Belum ada janji temu masuk.</p>
                                    @if(request('search'))
                                        <p class="text-xs mt-1 text-gray-400">Coba kata kunci pencarian lain.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/50">
                {{ $appointments->withQueryString()->links() }}
            </div>
        </div>

        <!-- MODAL POPUP TOLAK (AlpineJS) -->
        <div x-show="showRejectModal" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showRejectModal = false"></div>

            <!-- Modal Content -->
            <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100"
                 x-show="showRejectModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="bg-white p-8 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-50 mb-6 border border-red-100">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tolak Janji Temu?</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Apakah Anda yakin ingin menolak pasien ini? <br>
                        Tindakan ini akan membatalkan antrian dan memberitahu pasien.
                    </p>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-center gap-3">
                    <button type="button" @click="showRejectModal = false" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-300 shadow-sm hover:bg-gray-50 transition">
                        Batal
                    </button>
                    
                    <form :action="rejectUrl" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="Rejected">
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-6 py-3 bg-red-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-red-600/30 hover:bg-red-700 transition">
                            Ya, Tolak
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>