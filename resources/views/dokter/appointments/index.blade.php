<x-app-layout>
    <x-slot name="header">
        {{ __('Janji Temu Masuk') }}
    </x-slot>

    <!-- 1. STATISTIK RINGKAS (Dokter) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Menunggu Konfirmasi -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-yellow-50 rounded-full text-yellow-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menunggu Konfirmasi</p>
                <p class="text-2xl font-bold text-gray-900">{{ $pendingCount }}</p>
            </div>
        </div>

        <!-- Pasien Hari Ini -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jadwal Hari Ini</p>
                <p class="text-2xl font-bold text-gray-900">{{ $todayCount }}</p>
            </div>
        </div>
        
        <!-- Quick Action: Buat Jadwal -->
        <div class="flex items-center justify-end">
            <a href="{{ route('dokter.schedules.create') }}" class="w-full md:w-auto bg-white text-gray-700 border border-gray-200 hover:border-primary hover:text-primary font-bold py-4 px-6 rounded-2xl shadow-sm transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Atur Jadwal Praktik
            </a>
        </div>
    </div>

    <!-- 2. TABEL JANJI TEMU -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ showDetail: false, activeAppt: {} }">
        
        <!-- Header Tabel -->
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Daftar Pasien</h3>
                <p class="text-sm text-gray-500">Kelola pasien yang mendaftar di jadwal Anda.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto mt-2">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-white text-gray-500 font-semibold border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Nama Pasien</th>
                        <th class="px-6 py-4">Jadwal Konsultasi</th>
                        <th class="px-6 py-4">Keluhan Utama</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($appointments as $appt)
                    <tr class="hover:bg-red-50/30 transition duration-200">
                        
                        <!-- Pasien -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-primary to-red-600 text-white flex items-center justify-center font-bold shadow-sm">
                                    {{ substr($appt->pasien->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $appt->pasien->name }}</p>
                                    <p class="text-xs text-gray-400">#PAT-{{ $appt->pasien->id }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Jadwal -->
                        <td class="px-6 py-4 text-gray-600">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($appt->tanggal_booking)->format('d M Y') }}</span>
                                <span class="text-xs bg-gray-100 px-2 py-0.5 rounded w-max mt-1">
                                    {{ $appt->schedule->jam_mulai ?? '-' }} WIB
                                </span>
                            </div>
                        </td>

                        <!-- Keluhan -->
                        <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                            {{ $appt->keluhan }}
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 text-center">
                            @if($appt->status == 'Pending')
                                <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-bold border border-yellow-100">Menunggu</span>
                            @elseif($appt->status == 'Approved')
                                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100">Siap Periksa</span>
                            @elseif($appt->status == 'Rejected')
                                <span class="px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold border border-red-100">Ditolak</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold border border-green-100">Selesai</span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                
                                <!-- 1. Jika Pending -> Tampilkan Tombol Approve/Reject -->
                                @if($appt->status == 'Pending')
                                    <form action="{{ route('dokter.appointments.updateStatus', $appt->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Approved">
                                        <button type="submit" class="p-2 bg-green-50 text-green-600 hover:bg-green-600 hover:text-white rounded-lg transition" title="Terima Pasien">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('dokter.appointments.updateStatus', $appt->id) }}" method="POST" onsubmit="return confirm('Tolak pasien ini?');">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition" title="Tolak">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>
                                
                                <!-- 2. Jika Approved -> Tampilkan Tombol Periksa (Menuju Rekam Medis) -->
                                @elseif($appt->status == 'Approved')
                                    <a href="{{ route('dokter.medical-records.create', ['appointment_id' => $appt->id]) }}" class="px-4 py-2 bg-primary text-white text-xs font-bold rounded-lg hover:bg-red-800 transition shadow-md shadow-red-900/20 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                        Periksa
                                    </a>
                                
                                <!-- 3. Jika Selesai -> Lihat Hasil -->
                                @elseif($appt->status == 'Selesai')
                                    <button class="text-xs text-gray-400 font-bold border border-gray-200 px-3 py-1 rounded-lg cursor-default">
                                        Riwayat Tersimpan
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-50 p-4 rounded-full mb-3">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <p>Belum ada janji temu masuk.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $appointments->links() }}
        </div>
    </div>

</x-app-layout>