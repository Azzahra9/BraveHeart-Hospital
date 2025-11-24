<x-app-layout>
    <x-slot name="header">
        {{ __('Overview Rumah Sakit') }}
    </x-slot>

    <!-- 1. HEADER SECTION & PROFILE CARD (Grid 3 Kolom) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- Kolom Kiri (2/3): Welcome Banner -->
        <div class="lg:col-span-2">
            <div class="relative bg-gradient-to-r from-primary to-red-900 rounded-3xl p-6 text-white shadow-xl overflow-hidden min-h-[160px] md:min-h-full flex items-center">
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold mb-1 tracking-tight">Halo, Administrator {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-red-100 text-md font-light max-w-2xl">Pusat kendali operasional dan manajemen sistem BraveHeart Hospital.</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan (1/3): Profile Mini Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 flex items-center gap-4">
                <!-- Avatar dari Breeze (dengan foto atau inisial) -->
                <div class="flex-shrink-0">
                    <img class="h-16 w-16 rounded-full object-cover border-2 border-primary" 
                         src="{{ Auth::user()->profile_photo_url }}" 
                         alt="{{ Auth::user()->name }}">
                </div>
                
                <!-- Detail Profil -->
                <div class="flex-grow">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Profil Saya</p>
                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500 mb-2 truncate">{{ Auth::user()->email }}</p>

                    <!-- Tombol Edit Profil Bawaan Breeze -->
                    <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-primary hover:text-red-700 transition flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-7-5a2 2 0 012-2h1a2 2 0 012 2v1m-4 0h-1m1 0h1m-1 0v-1m4 1h-1m1 0v-1m-1 0v1h1"></path></svg>
                        Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header & Profile Mini Card -->

    <!-- 2. KARTU STATISTIK (4 Kolom) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Card 1: Pasien -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-400 mb-1">Total Pasien</p>
            <h3 class="text-3xl font-bold text-gray-900">{{ $total_pasien }}</h3>
        </div>

        <!-- Card 2: Dokter -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-red-50 rounded-2xl text-primary">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-400 mb-1">Total Dokter</p>
            <h3 class="text-3xl font-bold text-gray-900">{{ $total_dokter }}</h3>
        </div>

        <!-- Card 3: Pending Appointment -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group border-l-4 border-yellow-400">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-yellow-50 rounded-2xl text-yellow-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-400 mb-1">Menunggu Validasi</p>
            <h3 class="text-3xl font-bold text-gray-900">{{ $pending_appointments }}</h3>
            <a href="{{ route('admin.appointments.index') }}" class="mt-2 text-xs font-bold text-yellow-600 hover:underline">Proses Sekarang</a>
        </div>

        <!-- Card 4: Jadwal Hari Ini -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-green-50 rounded-2xl text-green-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-400 mb-1">Jadwal Hari Ini</p>
            <h3 class="text-3xl font-bold text-gray-900">{{ $today_appointments }}</h3>
        </div>
    </div>
    <!-- End Kartu Statistik -->
    
    <!-- 3. TABEL AKTIVITAS & QUICK ACCESS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Kolom Kiri (Lebar): Tabel Appointment Terbaru -->
        <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Permintaan Janji Temu Terbaru</h3>
                    <p class="text-sm text-gray-400 mt-1">5 Pasien terakhir yang mengajukan janji temu.</p>
                </div>
                <a href="{{ route('admin.appointments.index') }}" class="text-sm font-bold text-primary hover:underline">Lihat Semua</a>
            </div>
            
            <div class="flex-1 overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50/50 text-gray-400 font-medium text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-8 py-4">Pasien</th>
                            <th class="px-6 py-4">Dokter Tujuan</th>
                            <th class="px-6 py-4">Tanggal & Waktu</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($latest_appointments as $appointment)
                        <tr class="hover:bg-red-50/30 transition group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 text-white flex items-center justify-center font-bold shadow-sm">
                                        {{ substr($appointment->pasien->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $appointment->pasien->name }}</p>
                                        <p class="text-xs text-gray-400">ID: #{{ $appointment->pasien->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600 font-medium">
                                <div class="flex items-center gap-2">
                                    <div class="h-6 w-6 rounded-full bg-red-100 text-primary flex items-center justify-center text-xs font-bold">Dr</div>
                                    {{ $appointment->dokter->name }}
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-500">
                                {{ \Carbon\Carbon::parse($appointment->tanggal_booking)->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-5">
                                @if($appointment->status == 'Pending')
                                    <span class="inline-block px-3 py-1 rounded-full bg-yellow-50 text-yellow-600 text-xs font-bold border border-yellow-100">Pending</span>
                                @elseif($appointment->status == 'Approved')
                                    <span class="inline-block px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-bold border border-green-100">Confirmed</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-bold">{{ $appointment->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center">
                                 @if($appointment->status == 'Pending')
                                    <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-primary hover:underline">Validasi</a>
                                 @else
                                    <span class="text-xs text-gray-400">-</span>
                                 @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kolom Kanan: Quick Access -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 h-fit">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Aksi Cepat</h3>
            <p class="text-sm text-gray-500 mb-6">Pintasan untuk tugas-tugas administratif rutin.</p>

            <div class="space-y-3">
                <a href="{{ route('admin.users.create') }}" class="flex items-center gap-4 p-4 bg-red-50 rounded-xl hover:bg-red-100 transition border border-red-100 group">
                    <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center shadow-md group-hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <span class="font-bold text-gray-700 group-hover:text-primary">Tambah Dokter/Staf</span>
                </a>

                <a href="{{ route('admin.polis.create') }}" class="flex items-center gap-4 p-4 bg-red-50 rounded-xl hover:bg-red-100 transition border border-red-100 group">
                    <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center shadow-md group-hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-bold text-gray-700 group-hover:text-primary">Tambah Poli Baru</span>
                </a>
                
                <a href="{{ route('admin.medicines.create') }}" class="flex items-center gap-4 p-4 bg-red-50 rounded-xl hover:bg-red-100 transition border border-red-100 group">
                    <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center shadow-md group-hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <span class="font-bold text-gray-700 group-hover:text-primary">Input Stok Obat</span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>