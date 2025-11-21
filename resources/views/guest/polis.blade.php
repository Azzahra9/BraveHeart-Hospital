<x-guest-master>
    
    <!-- HEADER BANNER -->
    <div class="relative bg-gradient-to-br from-red-50 via-white to-white py-20 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-red-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-red-50 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-primary text-sm font-bold mb-6">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                Layanan Kami
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Pusat Keunggulan Medis</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Jelajahi berbagai layanan spesialis jantung dan pembuluh darah yang kami sediakan untuk kesehatan Anda.</p>
        </div>
    </div>

    <!-- LIST POLI -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($polis as $poli)
                <div class="group relative bg-white rounded-3xl p-8 border border-gray-100 hover:border-red-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <!-- Dekorasi Hover -->
                    <div class="absolute top-0 right-0 bg-red-50 w-32 h-32 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-150 duration-500"></div>
                    
                    <div class="relative z-10">
                        <!-- Icon -->
                        <div class="w-14 h-14 bg-white rounded-2xl shadow-md flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $poli->nama_poli }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">{{ $poli->deskripsi }}</p>
                        
                        @if(Route::has('guest.poli.show'))
                        <a href="{{ route('guest.poli.show', $poli->id) }}" class="inline-flex items-center text-primary font-bold text-sm group-hover:translate-x-2 transition-transform">
                            Info Selengkapnya <span class="ml-1">→</span>
                        </a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-gray-500">Belum ada layanan poli yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

</x-guest-master>