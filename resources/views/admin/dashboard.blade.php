<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="relative bg-gradient-to-r from-[#7F1D1D] to-[#991B1B] rounded-2xl p-6 text-white shadow-lg mb-6 flex flex-col md:flex-row justify-between items-center overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        
        <div class="relative z-10 flex items-center gap-4 w-full md:w-auto">
            <img class="h-14 w-14 rounded-full border-2 border-red-200/50 object-cover shadow-sm" 
                 src="{{ Auth::user()->profile_photo_url }}" 
                 alt="{{ Auth::user()->name }}">
            
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Halo, {{ Auth::user()->name }}!</h2>
                <p class="text-red-100 text-sm font-light">Selamat datang kembali di panel admin.</p>
            </div>
        </div>

        <div class="relative z-10 mt-4 md:mt-0 flex gap-3 w-full md:w-auto justify-start md:justify-end">
            <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/10 text-center hidden sm:block">
                <p class="text-[10px] text-red-200 uppercase tracking-wider">Hari Ini</p>
                <p class="font-bold text-sm">{{ now()->format('d M Y') }}</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="bg-white text-primary px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-50 transition shadow-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Edit Profil
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group h-24">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Total Pasien</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $total_pasien }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group h-24">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 flex items-center justify-center bg-red-50 text-primary rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Total Dokter</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $total_dokter }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group h-24">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 flex items-center justify-center bg-orange-50 text-orange-500 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Menunggu Validasi</p>
                    <h3 class="text-2xl font-bold text-orange-500">{{ $pending_appointments }}</h3>
                </div>
            </div>
            
            @if($pending_appointments > 0)
                <a href="{{ route('admin.appointments.index') }}" class="h-8 w-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-orange-500 hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            @endif
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group h-24">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Jadwal Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $today_appointments }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        
        <div class="lg:col-span-3 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Permintaan Terbaru</h3>
                <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-primary hover:underline">Lihat Semua</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50/50 text-gray-400 font-semibold text-[10px] uppercase">
                        <tr>
                            <th class="px-6 py-3">Pasien</th>
                            <th class="px-4 py-3">Dokter</th>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($latest_appointments as $appointment)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                        {{ substr($appointment->pasien->name, 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $appointment->pasien->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $appointment->dokter->name }}</td>
                            <td class="px-4 py-3 text-gray-500 text-xs">
                                {{ \Carbon\Carbon::parse($appointment->tanggal_booking)->format('d M, H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                @if($appointment->status == 'Pending')
                                    <span class="px-2 py-0.5 rounded bg-orange-100 text-orange-600 text-[10px] font-bold uppercase tracking-wide">Pending</span>
                                @else
                                    <span class="px-2 py-0.5 rounded bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wide">{{ $appointment->status }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($appointment->status == 'Pending')
                                    <a href="{{ route('admin.appointments.index') }}" class="text-primary hover:text-red-800 font-bold text-xs underline">Validasi</a>
                                @else
                                    <span class="text-gray-300 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-sm italic">Belum ada data janji temu.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <h3 class="font-bold text-gray-800 mb-4 text-xs uppercase tracking-wide text-gray-400">Aksi Cepat</h3>
                
                <div class="space-y-2">
                    <a href="{{ route('admin.users.create') }}" class="flex items-center gap-3 p-2.5 rounded-xl bg-gray-50 hover:bg-red-50 hover:text-primary transition group border border-transparent hover:border-red-100">
                        <div class="h-8 w-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-gray-400 group-hover:text-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-600 group-hover:text-primary">Tambah User</span>
                    </a>

                    <a href="{{ route('admin.polis.create') }}" class="flex items-center gap-3 p-2.5 rounded-xl bg-gray-50 hover:bg-red-50 hover:text-primary transition group border border-transparent hover:border-red-100">
                        <div class="h-8 w-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-gray-400 group-hover:text-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-600 group-hover:text-primary">Tambah Poli</span>
                    </a>

                    <a href="{{ route('admin.medicines.create') }}" class="flex items-center gap-3 p-2.5 rounded-xl bg-gray-50 hover:bg-red-50 hover:text-primary transition group border border-transparent hover:border-red-100">
                        <div class="h-8 w-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-gray-400 group-hover:text-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-600 group-hover:text-primary">Stok Obat</span>
                    </a>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-primary to-red-900 rounded-2xl p-5 text-white text-center shadow-lg">
                <p class="text-[10px] text-red-200 mb-1 uppercase tracking-widest">Server Status</p>
                <div class="flex items-center justify-center gap-2">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="font-bold text-sm">Online</span>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>