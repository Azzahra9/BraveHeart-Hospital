<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Pasien') }}
    </x-slot>

    <!-- 1. WELCOME BANNER (Konsisten: Maroon Gradient) -->
    <div class="relative bg-gradient-to-r from-[#7F1D1D] to-[#991B1B] rounded-2xl p-6 text-white shadow-lg mb-8 flex flex-col md:flex-row justify-between items-center overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        
        <!-- Info Pasien & Foto Profil -->
        <div class="relative z-10 flex items-center gap-4 w-full md:w-auto">
            <div class="h-16 w-16 rounded-full border-2 border-red-200/50 bg-white p-0.5 shadow-sm overflow-hidden flex-shrink-0 group relative">
                <!-- Foto Profil -->
                <img class="h-full w-full object-cover rounded-full" 
                     src="{{ Auth::user()->profile_photo_url }}" 
                     alt="{{ Auth::user()->name }}"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random'">
                
                <!-- Indikator Edit (Hover) -->
                <a href="{{ route('profile.edit') }}" class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition rounded-full text-xs text-white font-bold">
                    Ubah
                </a>
            </div>
            
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Halo, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-red-100 text-sm font-light">Semoga hari Anda sehat dan menyenangkan.</p>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="relative z-10 mt-4 md:mt-0 flex flex-wrap gap-3 w-full md:w-auto justify-start md:justify-end">
            <a href="{{ route('profile.edit') }}" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm flex items-center gap-2 backdrop-blur-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Edit Profil
            </a>
            <a href="{{ route('pasien.appointments.create') }}" class="bg-white text-primary px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Janji Baru
            </a>
        </div>
    </div>

    <!-- 2. STATS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-all">
            <div class="h-12 w-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Total Janji Temu</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $total_appointment ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-all">
            <div class="h-12 w-12 flex items-center justify-center bg-orange-50 text-orange-500 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Menunggu Konfirmasi</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $pending_count ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-all">
            <div class="h-12 w-12 flex items-center justify-center bg-green-50 text-green-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Riwayat Selesai</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $medical_records_count ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- 3. DOKTER TERSEDIA (NEW SECTION) -->
    <div class="mb-8">
        <div class="flex justify-between items-end mb-4 px-1">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Dokter Tersedia</h3>
                <p class="text-sm text-gray-500">Pilih dokter spesialis untuk konsultasi Anda.</p>
            </div>
            <a href="{{ route('pasien.appointments.create') }}" class="text-sm font-bold text-primary hover:underline">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @if(isset($availableDoctors))
                @foreach($availableDoctors as $dokter)
                <div class="bg-white rounded-2xl border border-gray-100 p-4 hover:shadow-lg transition-all group flex flex-col items-center text-center relative overflow-hidden">
                    <!-- Background Hover Effect -->
                    <div class="absolute inset-0 bg-gradient-to-b from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="h-20 w-20 rounded-full p-1 bg-white border border-gray-100 shadow-sm mx-auto mb-3">
                            <img src="{{ $dokter->profile_photo_url }}" 
                                 alt="{{ $dokter->name }}" 
                                 class="h-full w-full object-cover rounded-full"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=random'">
                        </div>
                        
                        <h4 class="font-bold text-gray-900 text-sm mb-1 line-clamp-1">{{ $dokter->name }}</h4>
                        <span class="inline-block px-2 py-0.5 rounded-md bg-red-50 text-primary text-[10px] font-bold uppercase tracking-wide mb-3 border border-red-100">
                            {{ $dokter->poli->nama_poli ?? 'Umum' }}
                        </span>

                        <a href="{{ route('pasien.appointments.create', ['dokter_id' => $dokter->id]) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-white border border-primary text-primary text-xs font-bold rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
                            Buat Janji
                        </a>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- 4. MAIN CONTENT (Search & Table) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- KOLOM KIRI (2/3): TABEL RIWAYAT -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Toolbar Pencarian -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col md:flex-row gap-3">
                    <select name="poli_id" class="border-gray-200 rounded-xl text-sm focus:ring-primary focus:border-primary text-gray-600 bg-gray-50/50 w-full md:w-1/3">
                        <option value="">Semua Poli</option>
                        @if(isset($polis))
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}" {{ (isset($poliId) && $poliId == $poli->id) ? 'selected' : '' }}>
                                    {{ $poli->nama_poli }}
                                </option>
                            @endforeach
                        @endif
                    </select>

                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari riwayat dokter..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 text-sm bg-gray-50/50">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>

                    <button type="submit" class="bg-primary text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-800 transition shadow-sm">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Tabel Riwayat -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 text-base">Riwayat Janji Temu</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-gray-50/50 text-gray-400 font-semibold text-[10px] uppercase">
                            <tr>
                                <th class="px-6 py-3">Dokter & Poli</th>
                                <th class="px-4 py-3">Jadwal</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm">
                            @if(isset($appointments))
                                @forelse($appointments as $appt)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-full bg-red-50 text-primary flex items-center justify-center font-bold text-xs border border-red-100">
                                                Dr
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800 text-sm">{{ $appt->dokter->name }}</p>
                                                <p class="text-[10px] text-gray-500 bg-gray-100 px-2 py-0.5 rounded inline-block mt-0.5">
                                                    {{ $appt->dokter->poli->nama_poli ?? 'Umum' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-gray-600 text-xs">
                                        <div class="flex flex-col">
                                            <span class="font-bold">{{ \Carbon\Carbon::parse($appt->tanggal_booking)->format('d M Y') }}</span>
                                            <span class="text-gray-400">{{ $appt->schedule->jam_mulai ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        @if($appt->status == 'Pending')
                                            <span class="px-2 py-1 bg-orange-100 text-orange-600 rounded text-[10px] font-bold uppercase">Menunggu</span>
                                        @elseif($appt->status == 'Approved')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-[10px] font-bold uppercase">Disetujui</span>
                                        @elseif($appt->status == 'Selesai')
                                            <span class="px-2 py-1 bg-green-100 text-green-600 rounded text-[10px] font-bold uppercase">Selesai</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-600 rounded text-[10px] font-bold uppercase">{{ $appt->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($appt->status == 'Selesai')
                                            <a href="{{ route('pasien.medical-records.index') }}" class="text-primary hover:underline text-xs font-bold">Lihat Hasil</a>
                                        @elseif($appt->status == 'Approved')
                                            <span class="text-gray-400 text-xs">Tunggu Jadwal</span>
                                        @else
                                            <span class="text-gray-300 text-xs">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 text-sm italic">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                            Belum ada riwayat janji temu.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 border-t border-gray-100">
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (1/3): INFO STATUS TERAKHIR -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Widget Status Terakhir -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full -mr-10 -mt-10"></div>
                
                <h3 class="font-bold text-gray-900 text-sm mb-4">Status Terakhir</h3>
                
                @if(isset($last_appointment))
                    <div class="space-y-4 relative z-10">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Dokter</p>
                            <p class="font-bold text-gray-800">{{ $last_appointment->dokter->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Tanggal</p>
                            <p class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($last_appointment->tanggal_booking)->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Status</p>
                            @if($last_appointment->status == 'Pending')
                                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-bold">Sedang Diproses</span>
                            @elseif($last_appointment->status == 'Approved')
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">Disetujui</span>
                            @else
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold">{{ $last_appointment->status }}</span>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="text-gray-400 text-sm italic">Belum ada aktivitas terbaru.</p>
                    <div class="mt-4">
                        <a href="{{ route('pasien.appointments.create') }}" class="text-primary text-sm font-bold hover:underline">Buat Janji Sekarang &rarr;</a>
                    </div>
                @endif
            </div>

            <!-- Widget Informasi -->
            <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-sm border border-blue-100 p-6">
                <h3 class="font-bold text-blue-800 text-sm mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Informasi Penting
                </h3>
                <p class="text-xs text-blue-600 leading-relaxed">
                    Pastikan Anda datang <strong>15 menit</strong> sebelum jadwal yang ditentukan. 
                    Jika status janji temu <strong>Disetujui</strong>, silakan langsung menuju ke bagian administrasi rumah sakit.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>