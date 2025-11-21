<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Pasien') }}
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Kolom Kiri (Lebar): Booking & Doctors List -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-gray-500">Kesehatan Anda prioritas kami. Cari dokter, buat janji, dan kelola riwayat kesehatan Anda di sini.</p>
            </div>
            
            <!-- Jadwal Mendatang & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Status Janji Temu Terbaru -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Status Janji Temu Terbaru</h3>
                    @if($latestAppointment)
                        <div class="space-y-2">
                            <p class="text-lg font-extrabold text-primary">{{ $latestAppointment->dokter->name ?? '-' }}</p>
                            <span class="text-sm font-medium text-gray-500 block">Poli {{ $latestAppointment->dokter->poli->nama_poli ?? 'Tidak Diketahui' }}</span>
                            <span class="text-sm font-medium text-gray-500 block">Tanggal: {{ \Carbon\Carbon::parse($latestAppointment->tanggal_booking)->format('d M Y') }}</span>
                        </div>
                        <div class="mt-4">
                            <span class="px-3 py-1 text-xs font-bold rounded-full 
                                @if($latestAppointment->status == 'Pending') bg-yellow-100 text-yellow-700 @elseif($latestAppointment->status == 'Approved') bg-blue-100 text-blue-700 @else bg-gray-100 text-gray-700 @endif">
                                {{ $latestAppointment->status }}
                            </span>
                        </div>
                    @else
                        <div class="py-6 text-center text-gray-400">
                            <p class="text-sm">Anda belum memiliki janji temu.</p>
                            <a href="{{ route('pasien.appointments.create') }}" class="text-primary font-bold hover:underline mt-2 inline-block">Buat Sekarang &rarr;</a>
                        </div>
                    @endif
                </div>

                <!-- Riwayat Medis Singkat -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kunjungan Terakhir</h3>
                    @if($lastRecord)
                        <div class="space-y-2">
                            <p class="text-lg font-extrabold text-gray-700">{{ $lastRecord->diagnosis }}</p>
                            <span class="text-sm font-medium text-gray-500 block">Dokter {{ $lastRecord->dokter->name }}</span>
                            <span class="text-sm font-medium text-gray-500 block">Tanggal: {{ \Carbon\Carbon::parse($lastRecord->tanggal)->format('d M Y') }}</span>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('pasien.medical-records.index') }}" class="px-4 py-2 bg-primary text-white text-xs font-bold rounded-lg hover:bg-red-800 transition shadow-sm">
                                Lihat Detail Riwayat
                            </a>
                        </div>
                    @else
                        <div class="py-6 text-center text-gray-400">
                            <p class="text-sm">Belum ada riwayat medis.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Rekomendasi Dokter (Booking Section) -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Rekomendasi Dokter Jantung</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($availableDoctors as $dokter)
                    <div class="text-center p-3 border border-gray-100 rounded-xl hover:shadow-md transition group cursor-pointer" onclick="window.location='{{ route('pasien.appointments.create') }}'">
                        <div class="h-16 w-16 rounded-full bg-red-50 text-primary flex items-center justify-center font-bold text-xl mx-auto mb-2 group-hover:scale-105 transition">
                            {{ substr($dokter->name, 0, 1) }}
                        </div>
                        <p class="font-bold text-sm text-gray-800 truncate">{{ $dokter->name }}</p>
                        <p class="text-xs text-gray-500">{{ $dokter->poli->nama_poli ?? 'Umum' }}</p>
                        <a href="{{ route('pasien.appointments.create') }}" class="mt-2 inline-block text-xs font-bold text-primary hover:underline">
                            Booking &rarr;
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        
        <!-- Kolom Kanan: Detail Profil (Mirip Breeze) -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-gradient-to-b from-primary to-red-900 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-xl flex flex-col items-center text-center">
                <div class="relative z-10">
                    <p class="text-red-200 text-xs font-bold uppercase tracking-widest mb-6">Akun Saya</p>
                    
                    <div class="w-24 h-24 bg-white p-1 rounded-full mx-auto mb-4 shadow-2xl">
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 text-white flex items-center justify-center font-bold text-4xl">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                    
                    <h3 class="text-2xl font-bold">{{ Auth::user()->name }}</h3>
                    <p class="text-white/80 text-sm mt-1">{{ Auth::user()->email }}</p>

                    <!-- Info Medis Singkat (PENTING: Perbaiki bagian ini) -->
                    <div class="mt-8 space-y-3 p-4 bg-white/10 rounded-xl border border-white/20">
                        <div class="flex justify-between items-center text-sm border-b border-white/10 pb-2">
                            <span>Golongan Darah</span>
                            <span class="font-bold bg-white/20 px-2 py-0.5 rounded">O+</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span>Kunjungan Terakhir</span>
                            <!-- PERBAIKAN: Gunakan tanda tanya ganda (??) untuk menangani null secara aman -->
                            <span class="font-bold">
                                {{ $lastRecord->tanggal ?? 'Belum Ada' }}
                            </span>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="mt-8 inline-block w-full py-3 bg-white text-primary font-bold rounded-xl hover:bg-red-50 transition shadow-lg">
                        Edit Profil Saya
                    </a>
                </div>
            </div>
            
            <!-- Quick Link Riwayat -->
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-center">
                <a href="{{ route('pasien.medical-records.index') }}" class="text-primary font-bold hover:underline">
                    Lihat Semua Riwayat Medis &rarr;
                </a>
            </div>

        </div>
    </div>

</x-app-layout>
