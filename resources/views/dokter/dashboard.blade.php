<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Dokter') }}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- 1. WELCOME BANNER (Gradient Maroon & Texture) -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2.5rem] p-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6">
            <!-- Texture Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <!-- Info Dokter -->
            <div class="relative z-10 flex items-center gap-6 w-full md:w-auto">
                <div class="group relative">
                    <div class="h-20 w-20 rounded-full p-1 bg-white/10 backdrop-blur-sm border border-white/20">
                        <img class="h-full w-full object-cover rounded-full" 
                            src="{{ Auth::user()->profile_photo_url }}" 
                            alt="{{ Auth::user()->name }}"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random'">
                    </div>
                </div>
                
                <div>
                    <h2 class="text-3xl font-bold tracking-tight mb-1">Dr. {{ Auth::user()->name }}</h2>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-0.5 rounded-full bg-white/20 text-xs font-bold border border-white/10">
                            {{ Auth::user()->poli->nama_poli ?? 'Spesialis Umum' }}
                        </span>
                        <span class="text-red-100 text-sm font-medium opacity-80">{{ now()->translatedFormat('l, d F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Aksi Cepat -->
            <div class="relative z-10 flex flex-wrap gap-3 w-full md:w-auto justify-start md:justify-end">
                <a href="{{ route('profile.edit') }}" class="group bg-white/10 hover:bg-white/20 border border-white/20 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm backdrop-blur-md transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit Profil
                </a>

                @if(Route::has('dokter.schedules.index'))
                <a href="{{ route('dokter.schedules.index') }}" class="group bg-white text-red-900 px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:shadow-xl hover:bg-gray-50 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <div class="bg-red-100 p-0.5 rounded-full group-hover:bg-red-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    Atur Jadwal
                </a>
                @endif
            </div>
        </div>

        <!-- 2. STATS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Pasien Hari Ini -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-blue-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-blue-50 text-blue-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pasien Hari Ini</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $todayAppointments ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <!-- Card 2: Menunggu Konfirmasi -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-orange-100 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-orange-400"></div>
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-orange-50 text-orange-500 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Perlu Validasi</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $myPendingCount ?? 0 }}</h3>
                    </div>
                </div>
                @if(($myPendingCount ?? 0) > 0)
                    <a href="{{ route('dokter.appointments.index') }}" class="absolute top-6 right-6 h-8 w-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-orange-500 hover:text-white transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                @endif
            </div>

            <!-- Card 3: Pasien Selesai -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-emerald-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Selesai</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $totalRecords ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <!-- Card 4: Revenue -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-purple-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-purple-50 text-purple-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Estimasi Revenue</p>
                        <h3 class="text-2xl font-extrabold text-gray-900">Rp{{ number_format(($totalRevenue ?? 0)/1000, 0, ',', '.') }}k</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. MAIN CONTENT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- KOLOM KIRI (2/3): TABEL & AKTIVITAS -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Tabel Permintaan Janji Temu -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                        <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                            </span>
                            Permintaan Janji Temu
                        </h3>
                        <a href="{{ route('dokter.appointments.index') }}" class="text-xs font-bold text-red-800 hover:text-red-900 hover:underline">Lihat Semua</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-50">
                                <tr>
                                    <th class="px-8 py-4">Pasien</th>
                                    <th class="px-6 py-4">Waktu Booking</th>
                                    <th class="px-6 py-4">Keluhan</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-sm">
                                @if(isset($appointments))
                                    @forelse($appointments->where('status', 'Pending')->take(5) as $appt)
                                    <tr class="hover:bg-orange-50/30 transition duration-200 group">
                                        <td class="px-8 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold text-xs border border-gray-200 shadow-sm">
                                                    {{ substr($appt->pasien->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900 text-sm">{{ $appt->pasien->name }}</p>
                                                    <p class="text-[10px] text-gray-400 font-medium">#PAT-{{ $appt->pasien->id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($appt->tanggal_booking)->format('d M') }}</span>
                                                <span class="text-xs text-gray-400">{{ $appt->schedule->jam_mulai ?? '' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="max-w-[150px] truncate text-gray-500 italic bg-gray-50 px-2 py-1 rounded border border-gray-100">
                                                "{{ $appt->keluhan }}"
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-orange-50 text-orange-600 text-xs font-bold border border-orange-100">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('dokter.appointments.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition border border-red-100">
                                                Proses <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm italic">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <div class="bg-gray-50 p-3 rounded-full">
                                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                                Tidak ada permintaan baru.
                                            </div>
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
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
                            Jadwal Praktik Hari Ini
                        </h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-50">
                                <tr>
                                    <th class="px-8 py-4">Pasien</th>
                                    <th class="px-6 py-4">Jam</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-sm">
                                @if(isset($appointments))
                                    @forelse($appointments->where('status', 'Approved')->where('tanggal_booking', '>=', now()->toDateString())->take(5) as $appt)
                                    <tr class="hover:bg-blue-50/30 transition duration-200">
                                        <td class="px-8 py-4 font-bold text-gray-800">
                                            {{ $appt->pasien->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold border border-blue-100">
                                                {{ $appt->schedule->jam_mulai ?? '-' }} WIB
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-green-50 text-green-600 text-xs font-bold border border-green-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Siap
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if(Route::has('dokter.medical-records.create'))
                                            <a href="{{ route('dokter.medical-records.create', ['appointment_id' => $appt->id]) }}" class="inline-block px-4 py-2 bg-gradient-to-r from-red-800 to-red-900 text-white text-xs font-bold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all">
                                                Periksa
                                            </a>
                                            @else
                                            <span class="text-gray-400 text-xs italic">Tunggu</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm italic">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <div class="bg-gray-50 p-3 rounded-full">
                                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </div>
                                                Tidak ada pasien terjadwal hari ini.
                                            </div>
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
            <div class="lg:col-span-1 space-y-8">
                
                <!-- Widget Grafik -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-6">
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <h3 class="font-bold text-gray-800 text-base">Aktivitas Pasien</h3>
                            <p class="text-[10px] text-gray-400 font-medium mt-0.5">Tren 6 bulan terakhir</p>
                        </div>
                        <div class="bg-red-50 p-1.5 rounded-lg text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        </div>
                    </div>
                    <div class="h-48 w-full relative">
                        <canvas id="patientChart"></canvas>
                    </div>
                </div>

                <!-- Widget Pasien Terakhir -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-6">
                    <h3 class="font-bold text-gray-800 text-base mb-4 border-b border-gray-100 pb-3 flex items-center justify-between">
                        Riwayat Pemeriksaan
                        <span class="text-[10px] text-gray-400 font-normal">Terbaru</span>
                    </h3>
                    <div class="space-y-4">
                        @if(isset($lastPatients))
                            @forelse($lastPatients as $record)
                            <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-2xl transition group cursor-pointer border border-transparent hover:border-gray-100">
                                <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm">
                                    {{ substr($record->pasien->name, 0, 1) }}
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <h4 class="font-bold text-gray-800 text-sm truncate">{{ $record->pasien->name }}</h4>
                                    <p class="text-[10px] text-gray-400 truncate">{{ Str::limit($record->diagnosis, 25) }}</p>
                                </div>
                                <span class="text-[10px] font-bold text-gray-300 group-hover:text-emerald-500 transition">{{ \Carbon\Carbon::parse($record->tanggal)->format('d/m') }}</span>
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

    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gunakan json_encode untuk memastikan data array PHP dirender dengan aman ke JavaScript
            const labels = {!! json_encode($bulan ?? []) !!};
            const dataPeriksa = {!! json_encode($data_periksa ?? []) !!};
            
            const canvas = document.getElementById('patientChart');
            if (canvas) {
                const ctx = canvas.getContext('2d');
                
                // Gradient Fill
                const gradientFill = ctx.createLinearGradient(0, 0, 0, 200);
                gradientFill.addColorStop(0, 'rgba(153, 27, 27, 0.1)'); // Red-800 with opacity
                gradientFill.addColorStop(1, 'rgba(153, 27, 27, 0)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Selesai',
                            data: dataPeriksa,
                            borderColor: '#991B1B', // Red-800
                            backgroundColor: gradientFill,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#FFFFFF',
                            pointBorderColor: '#991B1B',
                            pointBorderWidth: 2,
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
                                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                                titleColor: '#1f2937',
                                bodyColor: '#991B1B',
                                titleFont: { size: 13, weight: 'bold' },
                                bodyFont: { size: 12, weight: 'bold' },
                                borderColor: '#e5e7eb',
                                borderWidth: 1,
                                padding: 10,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + ' Pasien';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: { 
                                display: false, 
                                beginAtZero: true 
                            },
                            x: { 
                                grid: { display: false }, 
                                ticks: { 
                                    font: { size: 9 }, 
                                    color: '#9ca3af' 
                                } 
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>