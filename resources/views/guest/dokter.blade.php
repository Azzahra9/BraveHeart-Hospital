<x-guest-master>

    <!-- HEADER BANNER -->
    <div class="relative bg-gradient-to-br from-red-50 via-white to-white py-20 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-red-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-red-50 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-primary text-sm font-bold mb-6">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                Tim Medis Profesional
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Temui Dokter Kami</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Didukung oleh tim dokter spesialis jantung berpengalaman yang siap memberikan pelayanan terbaik dengan sepenuh hati.</p>
        </div>
    </div>

    <!-- LIST DOKTER -->
    <section class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($dokters as $dokter)
                <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <!-- Foto Dokter -->
                    <div class="h-72 overflow-hidden relative bg-gray-200">
                        <img src="{{ asset('images/dokter-' . $dokter->id . '.jpeg') }}" 
                             onerror="this.onerror=null; this.src='https://placehold.co/400x600?text=Foto+Dokter'" 
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-700" 
                             alt="{{ $dokter->name }}">
                        
                        <!-- Overlay Jadwal Simple -->
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-4 pt-12">
                            <div class="flex items-center gap-2 text-white/90 text-xs font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Senin - Jumat</span>
                            </div>
                        </div>
                    </div>

                    <!-- Info Dokter -->
                    <div class="p-6">
                        <div class="mb-2">
                            <span class="inline-block px-2 py-1 text-[10px] font-bold text-primary bg-red-50 rounded uppercase tracking-wider">
                                {{ $dokter->poli->nama_poli ?? 'Spesialis Umum' }}
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ $dokter->name }}</h3>
                        <p class="text-sm text-gray-500 mb-4">Berpengalaman lebih dari 10 tahun dalam penanganan kasus jantung.</p>
                        
                        <a href="{{ route('register') }}" class="block w-full text-center py-2.5 rounded-lg bg-white border-2 border-primary text-primary hover:bg-primary hover:text-white font-bold text-sm transition-colors">
                            Buat Janji Temu
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center py-20">
                    <div class="inline-block p-6 rounded-full bg-gray-50 mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Belum Ada Dokter</h3>
                    <p class="text-gray-500">Silakan hubungi admin untuk informasi lebih lanjut.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

</x-guest-master>