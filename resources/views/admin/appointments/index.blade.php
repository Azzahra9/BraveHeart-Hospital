<x-app-layout>
    <x-slot name="header">
        {{ __('Validasi Janji Temu') }}
    </x-slot>

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Pending -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-yellow-50 rounded-full text-yellow-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Menunggu Validasi</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ $appointments->where('status', 'Pending')->count() }}
                </p>
            </div>
        </div>
        <!-- Approved Today -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Disetujui Hari Ini</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ $appointments->where('status', 'Approved')->count() }}
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Daftar Permintaan Janji Temu</h3>
            <p class="text-sm text-gray-500">Validasi permintaan konsultasi dari pasien.</p>
        </div>

        <!-- Alert Sukses/Error -->
        @if(session('success'))
            <div class="mx-6 mt-4 bg-green-50 text-green-700 p-4 rounded-lg border border-green-100 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 mt-4 bg-red-50 text-red-700 p-4 rounded-lg border border-red-100 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Pasien</th>
                        <th class="px-6 py-4">Dokter Tujuan</th>
                        <th class="px-6 py-4">Jadwal</th>
                        <th class="px-6 py-4">Keluhan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition">
                        <!-- Pasien -->
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $appointment->pasien->name }}
                            <p class="text-xs text-gray-400 font-normal mt-0.5">{{ $appointment->pasien->email }}</p>
                        </td>
                        
                        <!-- Dokter -->
                        <td class="px-6 py-4 text-gray-700">
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-full bg-red-50 flex items-center justify-center text-primary font-bold text-xs">
                                    Dr
                                </div>
                                <div>
                                    <p class="font-bold">{{ $appointment->dokter->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $appointment->dokter->poli->nama_poli ?? 'Umum' }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Jadwal -->
                        <td class="px-6 py-4 text-gray-600">
                            <div class="flex flex-col">
                                <span class="font-bold">{{ \Carbon\Carbon::parse($appointment->tanggal_booking)->format('d M Y') }}</span>
                                <span class="text-xs">{{ $appointment->schedule->jam_mulai ?? '-' }} - {{ \Carbon\Carbon::parse($appointment->schedule->jam_mulai)->addMinutes($appointment->schedule->durasi)->format('H:i') }}</span>
                            </div>
                        </td>

                        <!-- Keluhan -->
                        <td class="px-6 py-4 text-gray-500 max-w-xs truncate" title="{{ $appointment->keluhan }}">
                            {{Str::limit($appointment->keluhan, 30) }}
                        </td>

                        <!-- Status Badge -->
                        <td class="px-6 py-4 text-center">
                            @if($appointment->status == 'Pending')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($appointment->status == 'Approved')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @elseif($appointment->status == 'Rejected')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800">
                                    Selesai
                                </span>
                            @endif
                        </td>

                        <!-- Aksi (Tombol Approve/Reject) -->
                        <td class="px-6 py-4 text-center">
                            @if($appointment->status == 'Pending')
                                <div class="flex justify-center gap-2">
                                    <!-- Tombol Approve -->
                                    <form action="{{ route('admin.appointments.approve', $appointment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 bg-green-50 text-green-600 hover:bg-green-600 hover:text-white rounded-lg transition" title="Setujui">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>

                                    <!-- Tombol Reject -->
                                    <form action="{{ route('admin.appointments.reject', $appointment->id) }}" method="POST" onsubmit="return confirm('Tolak janji temu ini?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition" title="Tolak">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-xs text-gray-400 italic">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Belum ada data janji temu yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $appointments->links() }}
        </div>
    </div>
</x-app-layout>