<x-guest-master>
    
    <!-- HEADER BANNER -->
    <div class="relative bg-gradient-to-br from-red-50 via-white to-white py-20 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-red-100 rounded-full blur-3xl opacity-50"></div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-primary text-sm font-bold mb-6">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                Layanan Spesialis
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">{{ $poli->nama_poli }}</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Informasi lengkap mengenai layanan, fasilitas, dan dokter spesialis kami.</p>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Kolom Kiri: Deskripsi & Fasilitas -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Deskripsi -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        Tentang Layanan
                    </h2>
                    <div class="prose text-gray-600 leading-relaxed">
                        <p>{{ $poli->deskripsi }}</p>
                        <p class="mt-4">
                            Layanan {{ $poli->nama_poli }} di BraveHeart Hospital didukung oleh teknologi medis terkini untuk memastikan diagnosis yang akurat dan penanganan yang tepat bagi setiap pasien.
                        </p>
                    </div>
                </div>

                <!-- Daftar Dokter di Poli Ini -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Dokter Spesialis {{ $poli->nama_poli }}</h2>
                    
                    @if($dokters->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($dokters as $dokter)
                            <div class="flex items-center gap-4 bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition">
                                <img src="{{ asset('img/dokter-' . $dokter->id . '.jpg') }}" 
                                     onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image'" 
                                     class="w-20 h-20 rounded-full object-cover border-2 border-red-50">
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $dokter->name }}</h3>
                                    <p class="text-xs text-primary font-bold bg-red-50 px-2 py-1 rounded inline-block mt-1">Spesialis {{ $poli->nama_poli }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-xl p-6 text-center text-gray-500 border border-dashed border-gray-300">
                            Belum ada dokter yang terdaftar di poli ini.
                        </div>
                    @endif
                </div>

            </div>

            <!-- Kolom Kanan: Sidebar Info -->
            <div class="space-y-8">
                
                <!-- Jadwal Operasional (Dummy) -->
                <div class="bg-primary text-white rounded-2xl p-8 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                    <h3 class="text-xl font-bold mb-6 border-b border-white/20 pb-4">Jam Operasional</h3>
                    <ul class="space-y-4 text-sm">
                        <li class="flex justify-between">
                            <span>Senin - Jumat</span>
                            <span class="font-bold">08:00 - 20:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sabtu</span>
                            <span class="font-bold">08:00 - 14:00</span>
                        </li>
                        <li class="flex justify-between text-red-200">
                            <span>Minggu / Libur</span>
                            <span class="font-bold">Tutup</span>
                        </li>
                    </ul>
                </div>

                <!-- CTA -->
                <div class="bg-white rounded-2xl p-8 border border-gray-200 text-center">
                    <h3 class="font-bold text-gray-900 mb-2">Butuh Konsultasi?</h3>
                    <p class="text-sm text-gray-500 mb-6">Segera buat janji temu dengan dokter spesialis kami.</p>
                    <a href="{{ route('register') }}" class="block w-full py-3 bg-primary hover:bg-red-700 text-white font-bold rounded-lg transition shadow-lg shadow-red-900/30">
                        Buat Janji Sekarang
                    </a>
                </div>

            </div>
        </div>
    </div>

</x-guest-master>