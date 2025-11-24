<x-app-layout>
    <x-slot name="header">
        {{ __('Status Janji Temu') }}
    </x-slot>

    <!-- KONTEN UTAMA: DAFTAR RIWAYAT -->
    <div class="max-w-7xl mx-auto">
        
        @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm" role="alert">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @elseif(session('error'))
             <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm" role="alert">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900">Riwayat Pengajuan</h3>
                <a href="{{ route('pasien.appointments.create') }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                    + Buat Janji Baru
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 font-semibold border-b border-gray-100">
                        <tr>
                            <th class="px-8 py-4">Dokter & Poli</th>
                            <th class="px-6 py-4">Jadwal Konsultasi</th>
                            <th class="px-6 py-4">Keluhan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($appointments as $appt)
                        <tr class="hover:bg-red-50/30 transition duration-200">
                            
                            <!-- Dokter -->
                            <td class="px-8 py-4">
                                <p class="font-bold text-gray-900">{{ $appt->dokter->name }}</p>
                                <p class="text-xs text-primary">{{ $appt->dokter->poli->nama_poli ?? 'Umum' }}</p>
                            </td>

                            <!-- Jadwal -->
                            <td class="px-6 py-4 text-gray-600">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($appt->tanggal_booking)->format('l, d M Y') }}</span>
                                    <span class="text-xs bg-gray-100 px-2 py-0.5 rounded w-max mt-1">
                                        {{ $appt->schedule->jam_mulai ?? '-' }} WIB
                                    </span>
                                </div>
                            </td>

                            <!-- Keluhan -->
                            <td class="px-6 py-4 text-gray-500 max-w-xs truncate" title="{{ $appt->keluhan }}">
                                {{ $appt->keluhan }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                @if($appt->status == 'Pending')
                                    <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-bold border border-yellow-100">Menunggu Validasi</span>
                                @elseif($appt->status == 'Approved')
                                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100">Disetujui</span>
                                @elseif($appt->status == 'Rejected')
                                    <span class="px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold border border-red-100">Ditolak</span>
                                @elseif($appt->status == 'Cancelled')
                                     <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-bold border border-gray-200">Dibatalkan</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold border border-green-100">Selesai</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-center">
                                @if($appt->status == 'Pending' || $appt->status == 'Approved')
                                    <form action="{{ route('pasien.appointments.cancel', $appt->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan janji temu ini?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700 hover:underline">
                                            Batalkan
                                        </button>
                                    </form>
                                @elseif($appt->status == 'Rejected')
                                    <span class="text-xs text-gray-400 italic">Hubungi CS</span>
                                @elseif($appt->status == 'Cancelled')
                                     <span class="text-xs text-gray-400">-</span>
                                @else
                                    <span class="text-xs text-gray-400">Riwayat Tersedia</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-50 p-4 rounded-full mb-3">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p>Anda belum pernah mengajukan janji temu.</p>
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
    </div>

</x-app-layout>