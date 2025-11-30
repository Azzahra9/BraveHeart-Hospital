<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Admin') }}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- 1. WELCOME BANNER (Gradient Maroon & Texture) - VERSI LEBIH SLIM -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2rem] py-6 px-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6">
            <!-- Texture Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <!-- Info Admin -->
            <div class="relative z-10 flex items-center gap-5 w-full md:w-auto">
                <div class="group relative">
                    <!-- Avatar diperkecil (h-16 w-16) agar lebih slim -->
                    <div class="h-16 w-16 rounded-full p-1 bg-white/10 backdrop-blur-sm border border-white/20">
                        <img class="h-full w-full object-cover rounded-full" 
                            src="{{ Auth::user()->profile_photo_url }}" 
                            alt="{{ Auth::user()->name }}"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random'">
                    </div>
                    <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-red-900"></div>
                </div>
                
                <div>
                    <h2 class="text-2xl font-bold tracking-tight mb-0.5">Halo, {{ Auth::user()->name }}!</h2>
                    <p class="text-red-100 text-xs sm:text-sm font-medium opacity-90">Selamat datang di Panel Administrator Heart Hospital.</p>
                </div>
            </div>

            <!-- Tanggal & Edit Profil -->
            <div class="relative z-10 flex flex-wrap gap-3 w-full md:w-auto justify-start md:justify-end">
                <div class="hidden sm:flex flex-col items-end mr-4">
                    <p class="text-[10px] text-red-200 uppercase tracking-wider font-bold">Hari Ini</p>
                    <p class="font-bold text-base leading-tight">{{ now()->translatedFormat('d M Y') }}</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="group bg-white/10 hover:bg-white/20 border border-white/20 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-sm backdrop-blur-md transition flex items-center gap-2 h-fit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit Profil
                </a>
            </div>
        </div>

        <!-- 2. STATS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Total Pasien -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-blue-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-blue-50 text-blue-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pasien</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $total_pasien }}</h3>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Dokter -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-red-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-red-50 text-primary rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Dokter</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $total_dokter }}</h3>
                    </div>
                </div>
            </div>

            <!-- Card 3: Menunggu Validasi -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-orange-100 transition-all group relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-orange-400"></div>
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-orange-50 text-orange-500 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Menunggu Validasi</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $pending_appointments }}</h3>
                    </div>
                </div>
                @if($pending_appointments > 0)
                    <a href="{{ route('admin.appointments.index') }}" class="absolute top-6 right-6 h-8 w-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-orange-500 hover:text-white transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                @endif
            </div>

            <!-- Card 4: Jadwal Hari Ini -->
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-emerald-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jadwal Hari Ini</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $today_appointments }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. MAIN CONTENT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- KOLOM KIRI (2/3): TABEL TERBARU -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                        <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                            <span class="w-2.5 h-2.5 bg-red-800 rounded-full"></span>
                            Permintaan Terbaru
                        </h3>
                        <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-red-800 hover:text-red-900 hover:underline">Lihat Semua</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-50">
                                <tr>
                                    <th class="px-8 py-4">Pasien</th>
                                    <th class="px-6 py-4">Dokter</th>
                                    <th class="px-6 py-4">Waktu</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-sm">
                                @forelse($latest_appointments as $appointment)
                                <tr class="hover:bg-red-50/30 transition duration-200 group">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-full bg-red-50 text-red-800 flex items-center justify-center font-bold text-xs border border-red-100 shadow-sm">
                                                {{ substr($appointment->pasien->name, 0, 1) }}
                                            </div>
                                            <span class="font-bold text-gray-800">{{ $appointment->pasien->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $appointment->dokter->name }}</td>
                                    <td class="px-6 py-4 text-gray-500 text-xs">
                                        {{ \Carbon\Carbon::parse($appointment->tanggal_booking)->format('d M, H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($appointment->status == 'Pending')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-orange-50 text-orange-600 text-[10px] font-bold border border-orange-100 uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Pending
                                            </span>
                                        @elseif($appointment->status == 'Approved')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-600 text-[10px] font-bold border border-blue-100 uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Approved
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gray-100 text-gray-600 text-[10px] font-bold border border-gray-200 uppercase tracking-wide">
                                                {{ $appointment->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($appointment->status == 'Pending')
                                            <a href="{{ route('admin.appointments.index') }}" class="text-red-800 hover:text-red-900 font-bold text-xs underline decoration-red-200 hover:decoration-red-800 transition">Validasi</a>
                                        @else
                                            <span class="text-gray-300 text-xs">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm italic">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <div class="bg-gray-50 p-3 rounded-full">
                                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                            </div>
                                            Belum ada data janji temu.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN (1/3): AKSI CEPAT & SERVER -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Card Aksi Cepat -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-6 relative overflow-hidden">
                    <!-- Decor -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-red-50 rounded-bl-full -mr-6 -mt-6"></div>
                    
                    <h3 class="font-bold text-gray-800 mb-6 text-sm uppercase tracking-wide flex items-center gap-2 relative z-10">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Aksi Cepat
                    </h3>
                    
                    <div class="space-y-3 relative z-10">
                        <!-- Add User -->
                        <a href="{{ route('admin.users.create') }}" class="flex items-center gap-4 p-3 rounded-2xl bg-gray-50 hover:bg-red-50 border border-transparent hover:border-red-100 transition-all group">
                            <div class="h-10 w-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-gray-400 group-hover:text-red-600 group-hover:shadow-md transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-gray-700 group-hover:text-red-800">Tambah User</span>
                                <span class="text-[10px] text-gray-400">Dokter atau Admin baru</span>
                            </div>
                        </a>

                        <!-- Add Poli -->
                        <a href="{{ route('admin.polis.create') }}" class="flex items-center gap-4 p-3 rounded-2xl bg-gray-50 hover:bg-red-50 border border-transparent hover:border-red-100 transition-all group">
                            <div class="h-10 w-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-gray-400 group-hover:text-red-600 group-hover:shadow-md transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-gray-700 group-hover:text-red-800">Tambah Poli</span>
                                <span class="text-[10px] text-gray-400">Layanan medis baru</span>
                            </div>
                        </a>

                        <!-- Add Medicine -->
                        <a href="{{ route('admin.medicines.create') }}" class="flex items-center gap-4 p-3 rounded-2xl bg-gray-50 hover:bg-red-50 border border-transparent hover:border-red-100 transition-all group">
                            <div class="h-10 w-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-gray-400 group-hover:text-red-600 group-hover:shadow-md transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-gray-700 group-hover:text-red-800">Stok Obat</span>
                                <span class="text-[10px] text-gray-400">Update inventaris farmasi</span>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Server Status -->
                <div class="bg-gradient-to-br from-red-900 to-red-800 rounded-[2rem] p-6 text-white text-center shadow-lg shadow-red-900/30">
                    <p class="text-[10px] text-red-200 mb-2 uppercase tracking-widest font-bold">Server Status</p>
                    <div class="flex items-center justify-center gap-2 bg-black/20 py-2 px-4 rounded-full w-fit mx-auto backdrop-blur-sm border border-white/10">
                        <span class="relative flex h-2.5 w-2.5">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                        </span>
                        <span class="font-bold text-sm tracking-wide">System Online</span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>