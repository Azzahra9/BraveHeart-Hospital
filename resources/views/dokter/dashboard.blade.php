<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Dokter') }}
    </x-slot>

    <!-- GRID UTAMA: STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Card 1: Pasien Hari Ini -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-lg transition">
            <div>
                <h3 class="text-4xl font-bold text-gray-900 mb-1">{{ $todayAppointments }}</h3>
                <p class="text-sm text-gray-500 font-medium">Pasien Hari Ini (Approved)</p>
            </div>
            <div class="h-14 w-14 bg-red-50 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <!-- Card 2: Menunggu Konfirmasi -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-lg transition">
            <div>
                <h3 class="text-4xl font-bold text-gray-900 mb-1">{{ $myPendingCount }}</h3>
                <p class="text-sm text-gray-500 font-medium">Menunggu Konfirmasi</p>
            </div>
            <div class="h-14 w-14 bg-yellow-50 rounded-2xl flex items-center justify-center text-yellow-600 group-hover:bg-yellow-500 group-hover:text-white transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Card 3: Operasi/Tindakan Selesai (REAL) -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-lg transition">
            <div>
                <h3 class="text-4xl font-bold text-gray-900 mb-1">{{ $totalRecords }}</h3> 
                <p class="text-sm text-gray-500 font-medium">Operasi/Tindakan Selesai</p>
            </div>
            <div class="h-14 w-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
        </div>

        <!-- Card 4: Total Revenue (REAL) -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-lg transition">
            <div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p class="text-sm text-gray-500 font-medium">Total Revenue (Asumsi)</p>
            </div>
            <div class="h-14 w-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- GRID KEDUA: GRAFIK REAL & PROFIL DOKTER -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        
        <!-- BAGIAN GRAFIK (Kiri - Lebar) -->
        <div class="lg:col-span-2 bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Tren Aktivitas Pasien</h3>
                <span class="text-sm text-gray-500">6 Bulan Terakhir</span>
            </div>

            <!-- Canvas untuk Chart.js -->
            <div class="relative h-72 w-full">
                <canvas id="patientChart"></canvas>
            </div>

            <div class="flex justify-center gap-6 mt-6">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-primary rounded-full"></span>
                    <span class="text-sm text-gray-500">Pasien Diperiksa (Selesai)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-sky-400 rounded-full"></span>
                    <span class="text-sm text-gray-500">Permintaan Baru (Pending/Approved)</span>
                </div>
            </div>
        </div>

        <!-- BAGIAN PROFIL DOKTER (Kanan - Card Maroon) -->
        <div class="bg-gradient-to-b from-primary to-red-900 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-xl flex flex-col items-center text-center">
            
            <div class="relative z-10">
                <p class="text-red-200 text-xs font-bold uppercase tracking-widest mb-6">Profil Dokter</p>
                
                <!-- Avatar Besar -->
                <div class="w-24 h-24 bg-white p-1 rounded-full mx-auto mb-4 shadow-2xl">
                    <img src="{{ asset('images/dokter-' . Auth::id() . '.jpeg') }}" 
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&size=128'"
                         class="w-full h-full object-cover rounded-full" 
                         alt="Foto Profil">
                </div>
                
                <h3 class="text-2xl font-bold">{{ Auth::user()->name }}</h3>
                <p class="text-red-200 text-sm mt-1">{{ Auth::user()->poli->nama_poli ?? 'Dokter Umum' }}</p>
                <p class="text-white/60 text-xs mt-1">{{ Auth::user()->email }}</p>

                <!-- Statistik Kecil -->
                <div class="grid grid-cols-2 gap-4 mt-8 w-full">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-3">
                        <p class="text-2xl font-bold">{{ $todayAppointments ?? 0 }}</p>
                        <p class="text-xs text-red-200">Pasien Hari Ini</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-3">
                        <p class="text-2xl font-bold">{{ $myPendingCount ?? 0 }}</p>
                        <p class="text-xs text-red-200">Pending</p>
                    </div>
                </div>

                <!-- Tombol Edit Profil Bawaan Breeze -->
                <a href="{{ route('profile.edit') }}" class="mt-8 inline-block w-full py-3 bg-white text-primary font-bold rounded-xl hover:bg-red-50 transition shadow-lg">
                    Edit Profil Saya
                </a>
            </div>
        </div>

    </div>

    <!-- GRID KETIGA: TABEL PERMINTAAN (Appointment Request) & PASIEN TERBARU -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Tabel Permintaan Janji Temu (Lebar) -->
        <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900">Permintaan Janji Temu Terbaru</h3>
                <a href="{{ route('dokter.appointments.index') }}" class="text-sm font-bold text-primary hover:underline">Lihat Semua</a>
            </div>
            
            <div class="flex-1 overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50/50 text-gray-400 font-medium text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-8 py-4">Pasien</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($appointments->take(5) as $appt)
                        <tr class="hover:bg-red-50/30 transition">
                            <td class="px-8 py-4 flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-gray-200 text-gray-700 flex items-center justify-center text-xs font-bold">
                                    {{ substr($appt->pasien->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-gray-700">{{ $appt->pasien->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ \Carbon\Carbon::parse($appt->tanggal_booking)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($appt->status == 'Pending')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span>
                                @elseif($appt->status == 'Approved')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">Approved</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($appt->status == 'Pending')
                                    <a href="{{ route('dokter.appointments.index') }}" class="text-primary hover:underline text-xs font-bold">Validasi</a>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-6 text-gray-400">Tidak ada permintaan baru.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kolom Kanan: Recent Patients (Pasien Terakhir Diperiksa) -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Pasien Terakhir Diperiksa</h3>
            <div class="space-y-4">
                @forelse($lastPatients as $record)
                <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-xl transition cursor-pointer">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 text-white flex items-center justify-center font-bold">
                        {{ substr($record->pasien->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-800 text-sm">{{ $record->pasien->name }}</h4>
                        <p class="text-xs text-gray-400 truncate">{{ Str::limit($record->diagnosis, 25) }}</p>
                    </div>
                    <span class="text-xs font-bold text-gray-300">{{ \Carbon\Carbon::parse($record->tanggal)->format('d M') }}</span>
                </div>
                @empty
                <p class="text-gray-400 text-center text-sm py-4">Belum ada riwayat pemeriksaan.</p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Script Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dikirim dari Route PHP
            const labels = @json($bulan); 
            const dataPeriksa = @json($data_periksa); 
            const dataPending = @json($data_pending);

            const ctx = document.getElementById('patientChart').getContext('2d');
            
            const primaryColor = '#991B1B'; // Maroon
            const secondaryColor = '#38BDF8'; // Sky Blue (Aksen)

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pasien Diperiksa (Selesai)',
                        data: dataPeriksa,
                        borderColor: primaryColor,
                        backgroundColor: 'rgba(153, 27, 27, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: primaryColor,
                        pointRadius: 4,
                        borderWidth: 3,
                    },
                    {
                        label: 'Permintaan Baru (Pending/Approved)',
                        data: dataPending,
                        borderColor: secondaryColor,
                        backgroundColor: 'rgba(56, 189, 242, 0.1)',
                        tension: 0.4,
                        fill: false,
                        pointBackgroundColor: secondaryColor,
                        pointRadius: 4,
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false 
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6' 
                            },
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            }
                        },
                        x: {
                            grid: {
                                display: false 
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>