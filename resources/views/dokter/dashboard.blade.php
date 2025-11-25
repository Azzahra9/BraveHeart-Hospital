<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Dokter') }}
    </x-slot>

    <!-- 1. COMPACT WELCOME BANNER -->
    <div class="relative bg-gradient-to-r from-[#7F1D1D] to-[#991B1B] rounded-2xl p-6 text-white shadow-lg mb-6 flex flex-col md:flex-row justify-between items-center overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        
        <!-- Kiri: Info Dokter -->
        <div class="relative z-10 flex items-center gap-4 w-full md:w-auto">
            <div class="h-14 w-14 rounded-full border-2 border-red-200/50 bg-white p-0.5 shadow-sm overflow-hidden">
                <img class="h-full w-full object-cover rounded-full" 
                     src="{{ Auth::user()->profile_photo_url }}" 
                     alt="{{ Auth::user()->name }}"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random'">
            </div>
            
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Dr. {{ Auth::user()->name }}</h2>
                <p class="text-red-100 text-sm font-light">{{ Auth::user()->poli->nama_poli ?? 'Spesialis Umum' }}</p>
            </div>
        </div>

        <!-- Kanan: Tanggal & Aksi -->
        <div class="relative z-10 mt-4 md:mt-0 flex flex-wrap gap-3 w-full md:w-auto justify-start md:justify-end">
            <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/10 text-center hidden lg:block">
                <p class="text-[10px] text-red-200 uppercase tracking-wider">Hari Ini</p>
                <p class="font-bold text-sm">{{ now()->format('d M Y') }}</p>
            </div>

            <!-- Edit Profil -->
            <a href="{{ route('profile.edit') }}" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm flex items-center gap-2 backdrop-blur-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                <span class="hidden sm:inline">Edit Profil</span>
            </a>

            <!-- Atur Jadwal -->
            @if(Route::has('dokter.schedules.index'))
            <a href="{{ route('dokter.schedules.index') }}" class="bg-white text-primary px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Atur Jadwal
            </a>
            @endif
        </div>
    </div>

    <!-- 2. STATS GRID (Compact & Horizontal) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        
        <!-- Card 1: Pasien Hari Ini -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group h-24">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Pasien Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $todayAppointments ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Card 2: Menunggu Konfirmasi -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group h-24 relative overflow-hidden">
            <div class="absolute left-0 top-0 w-1 h-full bg-orange-400"></div>
            
            <div class="flex items-center gap-4 pl-2">
                <div class="h-12 w-12 flex items-center justify-center bg-orange-50 text-orange-500 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-orange-400 uppercase tracking-wide">Perlu Validasi</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $myPendingCount ?? 0 }}</h3>
                </div>
            </div>
            
            @if(($myPendingCount ?? 0) > 0)
            <a href="{{ route('dokter.appointments.index') }}" class="h-8 w-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-orange-500 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            @endif
        </div>

        <!-- Card 3: Tindakan Selesai -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group h-24">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Pasien Selesai</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalRecords ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Card 4: Revenue -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group h-24">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Estimasi Revenue</p>
                    <h3 class="text-xl font-bold text-gray-800">Rp{{ number_format(($totalRevenue ?? 0)/1000, 0, ',', '.') }}k</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. MAIN CONTENT GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- KOLOM KIRI (2/3): TABEL PERMINTAAN -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Tabel Permintaan Janji Temu -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-base flex items-center gap-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                        Permintaan Janji Temu
                    </h3>
                    <a href="{{ route('dokter.appointments.index') }}" class="text-xs font-bold text-primary hover:underline">Lihat Semua</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-gray-50/50 text-gray-400 font-semibold text-[10px] uppercase">
                            <tr>
                                <th class="px-6 py-3">Pasien</th>
                                <th class="px-4 py-3">Waktu Booking</th>
                                <th class="px-4 py-3">Keluhan</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm">
                            @if(isset($appointments))
                                @forelse($appointments->where('status', 'Pending')->take(5) as $appt)
                                <tr class="hover:bg-orange-50/30 transition">
                                    <td class="px-6 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold text-xs">
                                                {{ substr($appt->pasien->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800 text-sm">{{ $appt->pasien->name }}</p>
                                                <p class="text-[10px] text-gray-400">#{{ $appt->pasien->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 text-xs">
                                        {{ \Carbon\Carbon::parse($appt->tanggal_booking)->format('d M') }}
                                        <span class="text-gray-400 ml-1">{{ $appt->schedule->jam_mulai ?? '' }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-500 text-xs truncate max-w-[150px]">
                                        {{ $appt->keluhan }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-2 py-1 bg-orange-100 text-orange-600 rounded text-[10px] font-bold uppercase">Pending</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('dokter.appointments.index') }}" class="text-primary hover:text-red-800 text-xs font-bold underline">Proses</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-sm italic bg-gray-50/50 rounded-b-2xl">
                                        Tidak ada permintaan janji temu baru.
                                    </td>
                                </tr>
                                @endforelse
                            @else
                                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Data tidak tersedia.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Jadwal Hari Ini -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-base flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        Jadwal Praktik Hari Ini
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-gray-50/50 text-gray-400 font-semibold text-[10px] uppercase">
                            <tr>
                                <th class="px-6 py-3">Pasien</th>
                                <th class="px-4 py-3">Jam</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm">
                            @if(isset($appointments))
                                @forelse($appointments->where('status', 'Approved')->where('tanggal_booking', '>=', now()->toDateString())->take(5) as $appt)
                                <tr class="hover:bg-blue-50/30 transition">
                                    <td class="px-6 py-3 font-medium text-gray-800">
                                        {{ $appt->pasien->name }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $appt->schedule->jam_mulai ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-[10px] font-bold uppercase">Siap</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if(Route::has('dokter.medical-records.create'))
                                        <a href="{{ route('dokter.medical-records.create', ['appointment_id' => $appt->id]) }}" class="inline-block px-3 py-1 bg-primary text-white text-xs font-bold rounded hover:bg-red-800 transition">
                                            Periksa
                                        </a>
                                        @else
                                        <span class="text-gray-400 text-xs">Tunggu</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm italic bg-gray-50/50 rounded-b-2xl">
                                        Tidak ada pasien terjadwal hari ini.
                                    </td>
                                </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN (1/3): GRAFIK & WIDGETS -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Widget Grafik -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Aktivitas Pasien</h3>
                        <p class="text-[10px] text-gray-400">Tren 6 bulan terakhir</p>
                    </div>
                </div>
                <div class="h-48 w-full relative">
                    <canvas id="patientChart"></canvas>
                </div>
            </div>

            <!-- Widget Pasien Terakhir -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <h3 class="font-bold text-gray-800 text-sm mb-4 border-b border-gray-100 pb-2">Riwayat Pemeriksaan</h3>
                <div class="space-y-3">
                    @if(isset($lastPatients))
                        @forelse($lastPatients as $record)
                        <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg transition group cursor-pointer">
                            <div class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs group-hover:bg-emerald-600 group-hover:text-white transition">
                                {{ substr($record->pasien->name, 0, 1) }}
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <h4 class="font-bold text-gray-800 text-xs truncate">{{ $record->pasien->name }}</h4>
                                <p class="text-[10px] text-gray-400 truncate">{{ Str::limit($record->diagnosis, 20) }}</p>
                            </div>
                            <span class="text-[10px] font-bold text-gray-300">{{ \Carbon\Carbon::parse($record->tanggal)->format('d/m') }}</span>
                        </div>
                        @empty
                        <p class="text-center text-gray-400 text-xs py-4">Belum ada riwayat.</p>
                        @endforelse
                    @else
                        <p class="text-center text-gray-400 text-xs py-4">Data tidak tersedia.</p>
                    @endif
                </div>
            </div>

        </div>

    </div>

    <!-- Script Chart.js (Safe Mode) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan variabel tidak undefined di JS
            const labels = @json($bulan ?? []); 
            const dataPeriksa = @json($data_periksa ?? []); 
            const dataPending = @json($data_pending ?? []);

            const canvas = document.getElementById('patientChart');
            if (canvas) {
                const ctx = canvas.getContext('2d');
                
                // Gradient Fill
                const gradientFill = ctx.createLinearGradient(0, 0, 0, 200);
                gradientFill.addColorStop(0, 'rgba(153, 27, 27, 0.1)');
                gradientFill.addColorStop(1, 'rgba(153, 27, 27, 0)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Selesai',
                            data: dataPeriksa,
                            borderColor: '#991B1B',
                            backgroundColor: gradientFill,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 2,
                            pointHoverRadius: 5,
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                backgroundColor: 'rgba(255, 255, 255, 0.9)',
                                titleColor: '#1f2937',
                                bodyColor: '#4b5563',
                                borderColor: '#e5e7eb',
                                borderWidth: 1,
                                padding: 8,
                                displayColors: false,
                            }
                        },
                        scales: {
                            y: { 
                                display: false, 
                                beginAtZero: true 
                            },
                            x: { 
                                grid: { display: false }, 
                                ticks: { font: { size: 9 }, color: '#9ca3af' } 
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>