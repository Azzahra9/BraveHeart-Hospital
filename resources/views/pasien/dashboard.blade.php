<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Pasien') }}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- 0. NOTIFIKASI SECTION (Clean Aesthetic Panel) -->
        @if(auth()->user()->unreadNotifications->count() > 0)
            <div class="bg-white rounded-[2rem] shadow-xl shadow-red-900/5 border border-white p-6 relative overflow-hidden">
                <!-- Hiasan Background -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>

                <div class="flex items-center justify-between mb-4 relative z-10">
                    <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-red-600"></span>
                        </span>
                        Pemberitahuan Baru
                    </h3>
                    <span class="text-xs font-bold text-red-600 bg-red-50 px-3 py-1 rounded-full border border-red-100">
                        {{ auth()->user()->unreadNotifications->count() }} Pesan
                    </span>
                </div>
                
                <div class="space-y-3 relative z-10">
                    @foreach(auth()->user()->unreadNotifications as $notification)
                        <div class="p-4 bg-gray-50/50 rounded-2xl border border-gray-100 hover:border-red-100 transition-colors flex flex-col md:flex-row justify-between md:items-center gap-4">
                            <div class="flex gap-4 items-start">
                                <div class="h-10 w-10 rounded-full bg-white text-red-600 flex items-center justify-center flex-shrink-0 border border-gray-100 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">
                                        {{ $notification->data['title'] ?? 'Pemberitahuan Sistem' }}
                                    </h4>
                                    <p class="text-sm text-gray-500 mt-0.5 leading-relaxed">
                                        {{ $notification->data['message'] ?? 'Anda memiliki pembaruan status baru.' }}
                                    </p>
                                    <p class="text-[10px] text-gray-400 mt-1 font-medium">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            <a href="{{ route('notifications.markAsRead', $notification->id) }}" 
                               class="group flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 text-xs font-bold text-gray-600 hover:text-red-700 rounded-xl transition shadow-sm whitespace-nowrap justify-center">
                                <span class="group-hover:hidden">Tandai Dibaca</span>
                                <span class="hidden group-hover:inline">Sudah Dibaca</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- 1. WELCOME BANNER (Gradient Maroon & Texture) - VERSI LEBIH SLIM -->
        <!-- Update: padding dikurangi menjadi py-6 px-8, rounded dikurangi, avatar diperkecil -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2rem] py-6 px-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6">
            <!-- Texture Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <!-- Info Pasien -->
            <div class="relative z-10 flex items-center gap-5 w-full md:w-auto">
                <div class="group relative">
                    <!-- Avatar diperkecil dari h-20 menjadi h-16 agar lebih slim -->
                    <div class="h-16 w-16 rounded-full p-1 bg-white/10 backdrop-blur-sm border border-white/20">
                        <img class="h-full w-full object-cover rounded-full" 
                            src="{{ Auth::user()->profile_photo_url }}" 
                            alt="{{ Auth::user()->name }}"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random'">
                    </div>
                </div>
                
                <div>
                    <h2 class="text-2xl font-bold tracking-tight mb-0.5">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-red-100 text-xs sm:text-sm font-medium opacity-90">Selamat datang kembali di Portal Pasien Heart Hospital.</p>
                </div>
            </div>

            <!-- Aksi Cepat -->
            <div class="relative z-10 flex flex-wrap gap-3 w-full md:w-auto justify-start md:justify-end">
                <!-- Tombol Edit Profil Dikembalikan -->
                <a href="{{ route('profile.edit') }}" class="group bg-white/10 hover:bg-white/20 border border-white/20 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm backdrop-blur-md transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit Profil
                </a>

                <a href="{{ route('pasien.appointments.create') }}" class="group bg-white text-red-900 px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg hover:shadow-xl hover:bg-gray-50 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <div class="bg-red-100 p-0.5 rounded-full group-hover:bg-red-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    Buat Janji Baru
                </a>
            </div>
        </div>

        <!-- 2. STATS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-blue-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-blue-50 text-blue-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Janji Temu</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $total_appointment ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-orange-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-orange-50 text-orange-500 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Menunggu Konfirmasi</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $pending_count ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white hover:border-green-100 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 flex items-center justify-center bg-green-50 text-green-600 rounded-2xl group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Riwayat Selesai</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $medical_records_count ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. DOKTER TERSEDIA -->
        <div>
            <div class="flex justify-between items-end mb-6 px-2">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Dokter Tersedia</h3>
                    <p class="text-sm text-gray-500 mt-1">Pilih dokter spesialis untuk konsultasi Anda.</p>
                </div>
                <a href="{{ route('pasien.appointments.create') }}" class="text-sm font-bold text-red-800 hover:text-red-900 hover:underline flex items-center gap-1">
                    Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(isset($availableDoctors))
                    @foreach($availableDoctors as $dokter)
                    <div class="bg-white rounded-[2rem] border border-white shadow-lg shadow-gray-200/50 p-6 hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                        <!-- Background Hover Effect -->
                        <div class="absolute inset-0 bg-gradient-to-b from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div class="h-20 w-20 rounded-full p-1 bg-white border border-gray-100 shadow-md mb-4">
                                <img src="{{ $dokter->profile_photo_url }}" 
                                     alt="{{ $dokter->name }}" 
                                     class="h-full w-full object-cover rounded-full"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=E5E7EB&color=374151'">
                            </div>
                            
                            <h4 class="font-bold text-gray-900 text-sm mb-1 line-clamp-1">{{ $dokter->name }}</h4>
                            <span class="inline-block px-3 py-1 rounded-full bg-red-50 text-red-800 text-[10px] font-bold uppercase tracking-wide mb-4 border border-red-100">
                                {{ $dokter->poli->nama_poli ?? 'Umum' }}
                            </span>

                            <a href="{{ route('pasien.appointments.create', ['dokter_id' => $dokter->id]) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-white border border-gray-200 text-gray-700 text-xs font-bold rounded-xl group-hover:bg-red-800 group-hover:text-white group-hover:border-red-800 transition-all shadow-sm">
                                Buat Janji
                            </a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- 4. MAIN CONTENT (Search & Table) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- KOLOM KIRI (2/3): TABEL RIWAYAT -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Toolbar Pencarian -->
                <div class="bg-white p-5 rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white">
                    <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col md:flex-row gap-3">
                        <div class="w-full md:w-1/3 relative">
                            <select name="poli_id" class="w-full appearance-none pl-4 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-600 bg-gray-50 font-medium">
                                <option value="">Semua Poli</option>
                                @if(isset($polis))
                                    @foreach($polis as $poli)
                                        <option value="{{ $poli->id }}" {{ (isset($poliId) && $poliId == $poli->id) ? 'selected' : '' }}>
                                            {{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>

                        <div class="relative w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari riwayat dokter atau diagnosa..." 
                                   class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/50 text-sm bg-gray-50 font-medium placeholder-gray-400">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>

                        <button type="submit" class="bg-red-800 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-red-900 transition shadow-lg shadow-red-900/20 hover:shadow-red-900/40">
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Tabel Riwayat -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white flex flex-col overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30">
                        <h3 class="font-bold text-gray-900 text-lg">Riwayat Janji Temu</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-white text-gray-400 font-bold text-[10px] uppercase tracking-wider border-b border-gray-50">
                                <tr>
                                    <th class="px-8 py-4">Dokter</th>
                                    <th class="px-6 py-4">Jadwal</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-sm">
                                @if(isset($appointments))
                                    @forelse($appointments as $appt)
                                    <tr class="hover:bg-red-50/30 transition duration-200 group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 rounded-full bg-red-50 text-red-800 flex items-center justify-center font-bold text-xs border border-red-100 shadow-sm group-hover:scale-110 transition-transform">
                                                    Dr
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900 text-sm">{{ $appt->dokter->name }}</p>
                                                    <p class="text-[10px] text-gray-500 font-medium mt-0.5">
                                                        {{ $appt->dokter->poli->nama_poli ?? 'Umum' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($appt->tanggal_booking)->format('d M Y') }}</span>
                                                <span class="text-xs text-gray-500 font-medium mt-1 bg-gray-100 px-2 py-0.5 rounded w-max">{{ $appt->schedule->jam_mulai ?? '-' }} WIB</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($appt->status == 'Pending')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-orange-50 text-orange-600 text-xs font-bold border border-orange-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Menunggu
                                                </span>
                                            @elseif($appt->status == 'Approved')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-600 text-xs font-bold border border-blue-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Disetujui
                                                </span>
                                            @elseif($appt->status == 'Selesai')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-green-50 text-green-600 text-xs font-bold border border-green-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-red-50 text-red-600 text-xs font-bold border border-red-100">
                                                    {{ $appt->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            @if($appt->status == 'Selesai')
                                                <a href="{{ route('pasien.medical-records.index') }}" class="inline-flex items-center gap-1 text-red-800 hover:text-red-900 font-bold text-xs bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                                    Lihat Hasil <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                                </a>
                                            @elseif($appt->status == 'Approved')
                                                <span class="text-gray-400 text-xs italic">Datang Tepat Waktu</span>
                                            @else
                                                <span class="text-gray-300 text-xs">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm">
                                            <div class="flex flex-col items-center justify-center gap-3">
                                                <div class="bg-gray-50 p-3 rounded-full">
                                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                                </div>
                                                <p>Belum ada riwayat janji temu.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="p-6 border-t border-gray-100 bg-gray-50/30">
                        @if(isset($appointments))
                            {{ $appointments->links() }}
                        @endif
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN (1/3): INFO STATUS TERAKHIR -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Widget Status Terakhir -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8 relative overflow-hidden group">
                    <!-- Decor Blobs -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110 duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-20 h-20 bg-gray-50 rounded-tr-full -ml-6 -mb-6"></div>
                    
                    <h3 class="font-bold text-gray-900 text-lg mb-6 relative z-10">Status Terakhir</h3>
                    
                    @if(isset($last_appointment))
                        <div class="space-y-5 relative z-10">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wide font-bold">Dokter</p>
                                    <p class="font-bold text-gray-900 text-sm">{{ $last_appointment->dokter->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wide font-bold">Jadwal</p>
                                    <p class="font-medium text-gray-700 text-sm">{{ \Carbon\Carbon::parse($last_appointment->tanggal_booking)->format('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-400 uppercase tracking-wide font-bold mb-2">Status Saat Ini</p>
                                @if($last_appointment->status == 'Pending')
                                    <div class="w-full bg-orange-50 text-orange-700 py-2 rounded-xl text-center text-xs font-bold border border-orange-100">
                                        Sedang Diproses
                                    </div>
                                @elseif($last_appointment->status == 'Approved')
                                    <div class="w-full bg-blue-50 text-blue-700 py-2 rounded-xl text-center text-xs font-bold border border-blue-100">
                                        Disetujui
                                    </div>
                                @else
                                    <div class="w-full bg-gray-50 text-gray-700 py-2 rounded-xl text-center text-xs font-bold border border-gray-200">
                                        {{ $last_appointment->status }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-gray-400 text-xs italic">Belum ada aktivitas terbaru.</p>
                            <div class="mt-4">
                                <a href="{{ route('pasien.appointments.create') }}" class="text-red-800 text-xs font-bold hover:underline">Buat Janji Sekarang &rarr;</a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Widget Informasi -->
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-[2rem] shadow-lg shadow-blue-50/50 border border-blue-100 p-8">
                    <h3 class="font-bold text-blue-900 text-sm mb-3 flex items-center gap-2">
                        <div class="p-1.5 bg-blue-100 rounded-lg text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        Informasi Penting
                    </h3>
                    <p class="text-xs text-blue-700 leading-relaxed font-medium">
                        Mohon hadir <strong>15 menit</strong> sebelum jadwal konsultasi. <br><br>
                        Jika status janji temu <span class="bg-blue-100 text-blue-800 px-1 rounded">Disetujui</span>, silakan langsung menuju meja registrasi ulang di lobi utama.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>