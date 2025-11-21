<x-app-layout>
        <x-slot name="header">
            {{ __('Dashboard Overview') }}
        </x-slot>

        <!-- 1. WELCOME BANNER (Modern Gradient) -->
        <div class="relative bg-gradient-to-r from-primary to-red-800 rounded-3xl p-8 mb-8 text-white overflow-hidden shadow-xl">
            <!-- Dekorasi -->
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-red-400 opacity-20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-red-100 text-lg">Pantau aktivitas rumah sakit dan kelola janji temu dengan mudah hari ini.</p>
                </div>
                <div class="hidden md:block">
                    <span class="bg-white/20 backdrop-blur-md border border-white/30 px-4 py-2 rounded-lg text-sm font-bold">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- 2. STATISTIK CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- Card 1: Pending -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Menunggu Validasi</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1 group-hover:text-yellow-600 transition">
                            {{ $pending_appointments }}
                        </h3>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded-xl text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-yellow-600 mt-4 inline-block hover:underline">Lihat Detail &rarr;</a>
            </div>

            <!-- Card 2: Pasien -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Pasien</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1 group-hover:text-blue-600 transition">
                            {{ $total_pasien }}
                        </h3>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-4">Terdaftar dalam sistem</p>
            </div>

            <!-- Card 3: Dokter -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Dokter Aktif</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1 group-hover:text-green-600 transition">
                            {{ $total_dokter }}
                        </h3>
                    </div>
                    <div class="p-3 bg-green-50 rounded-xl text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-green-600 mt-4 inline-block hover:underline">Kelola Dokter &rarr;</a>
            </div>

            <!-- Card 4: Jadwal Hari Ini -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Jadwal Hari Ini</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 mt-1 group-hover:text-primary transition">
                            {{ $today_appointments }}
                        </h3>
                    </div>
                    <div class="p-3 bg-red-50 rounded-xl text-primary group-hover:bg-primary group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-4">Pasien terjadwal hari ini</p>
            </div>
        </div>

        <!-- 3. TWO COLUMNS (Recent Activity & Quick Actions) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Kolom Kiri: Tabel Janji Temu Terbaru -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">Permintaan Terbaru</h3>
                    <a href="{{ route('admin.appointments.index') }}" class="text-sm font-bold text-primary hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Pasien</th>
                                <th class="px-6 py-3">Dokter</th>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($latest_appointments as $appointment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $appointment->pasien->name }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $appointment->dokter->name }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($appointment->tanggal_booking)->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($appointment->status == 'Pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold">Pending</span>
                                    @elseif($appointment->status == 'Approved')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold">Approved</span>
                                    @elseif($appointment->status == 'Rejected')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold">Rejected</span>
                                    @else
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-bold">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada data terbaru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kolom Kanan: Quick Actions -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.users.create') }}" class="block w-full p-4 rounded-xl border border-gray-100 hover:border-primary hover:bg-red-50 transition group flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-red-100 p-2 rounded-lg text-primary group-hover:bg-primary group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            </div>
                            <span class="font-bold text-gray-700 group-hover:text-primary">Tambah Dokter Baru</span>
                        </div>
                        <span class="text-gray-400 group-hover:text-primary">&rarr;</span>
                    </a>

                    <a href="{{ route('admin.polis.create') }}" class="block w-full p-4 rounded-xl border border-gray-100 hover:border-primary hover:bg-red-50 transition group flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-blue-100 p-2 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <span class="font-bold text-gray-700 group-hover:text-blue-600">Tambah Poli</span>
                        </div>
                        <span class="text-gray-400 group-hover:text-blue-600">&rarr;</span>
                    </a>
                    
                    <a href="{{ route('admin.medicines.create') }}" class="block w-full p-4 rounded-xl border border-gray-100 hover:border-primary hover:bg-red-50 transition group flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-100 p-2 rounded-lg text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <span class="font-bold text-gray-700 group-hover:text-green-600">Input Stok Obat</span>
                        </div>
                        <span class="text-gray-400 group-hover:text-green-600">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

    </x-app-layout>