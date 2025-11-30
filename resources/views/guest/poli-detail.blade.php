<x-guest-master>
    
    <!-- HERO SECTION (Clean & Neutral White Background) -->
    <div class="relative bg-white pt-32 pb-20 overflow-hidden border-b border-gray-100">
        
        <!-- Decorative Elements (Subtle Grey) -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-gray-50 rounded-full blur-3xl opacity-40 mix-blend-multiply"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-gray-50 rounded-full blur-3xl opacity-40 mix-blend-multiply"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-gray-200 text-red-700 text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    Layanan Spesialis
                </div>
                
                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight leading-tight">
                    {{ $poli->nama_poli }}
                </h1>
                
                <!-- Subtitle -->
                <p class="text-lg text-gray-600 font-light leading-relaxed">
                    Informasi lengkap mengenai layanan unggulan, fasilitas modern, dan tim dokter spesialis terbaik kami di bidang {{ strtolower($poli->nama_poli) }}.
                </p>
            </div>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 bg-gray-50/50">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Kolom Kiri: Deskripsi & Fasilitas -->
            <div class="lg:col-span-2 space-y-10">
                
                <!-- Deskripsi -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                    <!-- Decor -->
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gray-50 rounded-bl-full -mr-4 -mt-4 opacity-60"></div>
                    
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shadow-sm border border-red-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            Tentang Layanan
                        </h2>
                        <div class="prose text-gray-600 leading-relaxed text-base">
                            <p>{{ $poli->deskripsi }}</p>
                            <p class="mt-4 bg-gray-50 p-4 rounded-xl border-l-4 border-red-400 italic text-gray-500">
                                "Layanan {{ $poli->nama_poli }} di BraveHeart Hospital didukung oleh teknologi medis terkini untuk memastikan diagnosis yang akurat dan penanganan yang tepat bagi setiap pasien."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Daftar Dokter -->
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Dokter Spesialis</h2>
                        <span class="text-sm font-medium text-gray-500 bg-white border border-gray-200 px-3 py-1 rounded-full">{{ $dokters->count() }} Dokter</span>
                    </div>
                    
                    @if($dokters->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($dokters as $dokter)
                            <div class="group flex items-center gap-5 bg-white p-5 rounded-[1.5rem] border border-gray-100 shadow-sm hover:shadow-lg hover:border-red-100 transition-all duration-300 cursor-default">
                                <div class="relative flex-shrink-0">
                                    <img src="{{ $dokter->profile_photo_url }}" 
                                         alt="{{ $dokter->name }}" 
                                         class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-md group-hover:scale-105 transition-transform duration-300"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=random'">
                                    <!-- Dot Status -->
                                    <span class="absolute bottom-1 right-1 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-gray-900 text-lg mb-1 truncate group-hover:text-red-700 transition-colors">{{ $dokter->name }}</h3>
                                    <p class="text-xs text-red-600 font-bold uppercase tracking-wide bg-red-50 inline-block px-2 py-1 rounded-lg border border-red-100">
                                        Spesialis {{ $poli->nama_poli }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-[2rem] p-12 text-center border border-dashed border-gray-300">
                            <div class="inline-block p-4 rounded-full bg-gray-50 shadow-sm mb-3 text-gray-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada dokter yang terdaftar di poli ini.</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Kolom Kanan: Sidebar Info -->
            <div class="space-y-8">
                
                <!-- Jadwal Operasional -->
                <div class="bg-gradient-to-br from-red-900 to-red-800 text-white rounded-[2rem] p-8 shadow-xl shadow-red-900/20 relative overflow-hidden group">
                    <!-- Background Patterns -->
                    <div class="absolute top-0 right-0 -mt-6 -mr-6 w-32 h-32 bg-white opacity-10 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                    <div class="absolute bottom-0 left-0 -ml-6 -mb-6 w-24 h-24 bg-white opacity-5 rounded-full"></div>

                    <h3 class="text-xl font-bold mb-6 border-b border-white/20 pb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Jam Operasional
                    </h3>
                    <ul class="space-y-4 text-sm font-medium">
                        <li class="flex justify-between items-center">
                            <span class="text-red-100">Senin - Jumat</span>
                            <span class="bg-white/20 px-3 py-1 rounded-lg backdrop-blur-sm">08:00 - 20:00</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="text-red-100">Sabtu</span>
                            <span class="bg-white/20 px-3 py-1 rounded-lg backdrop-blur-sm">08:00 - 14:00</span>
                        </li>
                        <li class="flex justify-between items-center pt-2 border-t border-white/10">
                            <span class="text-red-200">Minggu / Libur</span>
                            <span class="text-red-200 font-bold uppercase text-xs tracking-wider">Tutup</span>
                        </li>
                    </ul>
                </div>

                <!-- CTA -->
                <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-lg shadow-gray-200/50 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-red-500 to-orange-500"></div>
                    
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 text-red-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Butuh Konsultasi?</h3>
                    <p class="text-sm text-gray-500 mb-8 leading-relaxed">Jangan tunda kesehatan Anda. Buat janji temu dengan dokter spesialis kami sekarang.</p>
                    
                    <a href="{{ route('register') }}" class="block w-full py-3.5 bg-gray-900 text-white font-bold rounded-xl shadow-lg hover:bg-gray-800 hover:shadow-gray-900/30 transition transform hover:-translate-y-1">
                        Buat Janji Sekarang
                    </a>
                </div>

            </div>
        </div>
    </div>

</x-guest-master>