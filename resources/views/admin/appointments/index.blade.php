<x-app-layout>
    <x-slot name="header">
        {{ __('Validasi Janji Temu') }}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" 
         x-data="{ 
            showRejectModal: false, 
            rejectUrl: '',
            patientName: ''
         }">

        <!-- 1. HEADER BANNER (Modern Slim) -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2.5rem] p-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6">
            <!-- Texture Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <div class="relative z-10 flex items-center gap-5">
                <div class="h-16 w-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-inner">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold tracking-tight mb-1">Validasi Janji Temu</h2>
                    <p class="text-red-100 text-sm font-medium opacity-90">Setujui atau tolak permintaan konsultasi dari pasien.</p>
                </div>
            </div>

            <!-- Statistik Ringkas di Header -->
            <div class="relative z-10 flex gap-4">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 px-5 py-3 rounded-2xl text-center">
                    <p class="text-[10px] text-red-200 uppercase tracking-wider font-bold">Menunggu</p>
                    <p class="text-2xl font-extrabold text-white">{{ $appointments->where('status', 'Pending')->count() }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/20 px-5 py-3 rounded-2xl text-center">
                    <p class="text-[10px] text-red-200 uppercase tracking-wider font-bold">Disetujui Hari Ini</p>
                    <p class="text-2xl font-extrabold text-white">{{ $appointments->where('status', 'Approved')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- 2. TABEL PERMINTAAN -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden relative">
            
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-red-800 rounded-full"></span>
                    Daftar Antrian Validasi
                </h3>
            </div>

            <!-- Alert Sukses/Error -->
            @if(session('success'))
                <div class="mx-8 mt-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm animate-pulse-slow">
                    <div class="bg-green-100 p-1 rounded-full text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mx-8 mt-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm">
                    <div class="bg-red-100 p-1 rounded-full text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <span class="font-medium text-sm">{{ session('error') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto mt-2">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-8 py-5">Pasien</th>
                            <th class="px-6 py-5">Dokter Tujuan</th>
                            <th class="px-6 py-5">Jadwal</th>
                            <th class="px-6 py-5">Keluhan</th>
                            <th class="px-6 py-5 text-center">Status</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($appointments as $appointment)
                        <tr class="hover:bg-red-50/30 transition duration-200 group">
                            
                            <!-- Pasien -->
                            <td class="px-8 py-5">
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">{{ $appointment->pasien->name }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium mt-0.5">{{ $appointment->pasien->email }}</p>
                                </div>
                            </td>
                            
                            <!-- Dokter -->
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-full bg-red-50 flex items-center justify-center text-red-800 font-bold text-xs border border-red-100">
                                        Dr
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-xs">{{ $appointment->dokter->name }}</p>
                                        <p class="text-[10px] text-gray-500">{{ $appointment->dokter->poli->nama_poli ?? 'Umum' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Jadwal -->
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900 text-xs">{{ \Carbon\Carbon::parse($appointment->tanggal_booking)->format('d M Y') }}</span>
                                    <span class="text-[10px] text-gray-500 mt-0.5 bg-gray-100 px-2 py-0.5 rounded w-max border border-gray-200">
                                        {{ $appointment->schedule->jam_mulai ?? '-' }} - {{ \Carbon\Carbon::parse($appointment->schedule->jam_mulai)->addMinutes($appointment->schedule->durasi)->format('H:i') }}
                                    </span>
                                </div>
                            </td>

                            <!-- Keluhan -->
                            <td class="px-6 py-5">
                                <div class="max-w-xs truncate text-gray-500 italic bg-gray-50 p-2 rounded-lg border border-gray-100 text-xs">
                                    "{{ Str::limit($appointment->keluhan, 30) }}"
                                </div>
                            </td>

                            <!-- Status Badge -->
                            <td class="px-6 py-5 text-center">
                                @if($appointment->status == 'Pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-yellow-50 text-yellow-700 text-[10px] font-bold border border-yellow-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span> Pending
                                    </span>
                                @elseif($appointment->status == 'Approved')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-green-50 text-green-700 text-[10px] font-bold border border-green-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Approved
                                    </span>
                                @elseif($appointment->status == 'Rejected')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-red-50 text-red-700 text-[10px] font-bold border border-red-100 uppercase tracking-wide">
                                        Rejected
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 text-[10px] font-bold border border-blue-100 uppercase tracking-wide">
                                        Selesai
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-2">
                                    
                                    @if($appointment->status == 'Pending')
                                        <!-- Tombol Approve -->
                                        <form action="{{ route('admin.appointments.approve', $appointment->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="group/btn flex items-center gap-1 px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-700 text-xs font-bold rounded-lg transition border border-green-100 shadow-sm" title="Setujui">
                                                <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Setujui
                                            </button>
                                        </form>
                                        
                                        <!-- Trigger Modal Tolak -->
                                        <button @click="showRejectModal = true; rejectUrl = '{{ route('admin.appointments.reject', $appointment->id) }}'; patientName = '{{ $appointment->pasien->name }}'" 
                                                class="group/btn flex items-center gap-1 px-3 py-1.5 bg-white hover:bg-red-50 text-gray-400 hover:text-red-600 text-xs font-bold rounded-lg transition border border-gray-200 hover:border-red-100 shadow-sm" title="Tolak">
                                            <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Tolak
                                        </button>

                                    @else
                                        <span class="text-[10px] text-gray-400 italic bg-gray-50 px-2 py-1 rounded border border-gray-100">Selesai diproses</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-gray-400 text-sm italic">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <div class="bg-gray-50 p-3 rounded-full mb-2">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p>Tidak ada permintaan janji temu saat ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/30">
                {{ $appointments->links() }}
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
            
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showRejectModal = false"></div>

            <div class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100"
                 x-show="showRejectModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
                
                <div class="bg-white p-8 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-50 mb-6 border border-red-100">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tolak Permintaan?</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Apakah Anda yakin ingin menolak permintaan janji temu dari <span class="font-bold text-gray-800" x-text="patientName"></span>? <br>
                        Tindakan ini akan membatalkan antrian secara permanen.
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