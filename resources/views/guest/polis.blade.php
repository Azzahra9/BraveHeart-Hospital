<x-guest-master>
    
    <!-- HERO SECTION (Clean White & Red Accents) -->
    <div class="relative bg-white pt-32 pb-24 overflow-hidden rounded-b-[3rem] shadow-sm border-b border-gray-100">
        <!-- Decorative Elements (Subtle) -->
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] bg-[radial-gradient(#991b1b_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-red-50 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-orange-50 rounded-full blur-3xl opacity-60"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-50 border border-red-100 text-red-800 text-xs font-bold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
                Layanan Unggulan
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight leading-tight">
                Pusat Keunggulan <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-700 to-red-900">Medis & Spesialis</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto font-light leading-relaxed">
                Kami menghadirkan layanan kesehatan terpadu dengan teknologi terkini dan tim dokter spesialis terbaik untuk kesehatan Anda dan keluarga.
            </p>
        </div>
    </div>

    <!-- LIST POLI SECTION -->
    <section class="py-20 bg-gray-50 relative">
        <!-- Background Decoration -->
        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-full max-w-7xl h-full pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-50 rounded-full blur-3xl opacity-40 mix-blend-multiply"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-red-50 rounded-full blur-3xl opacity-40 mix-blend-multiply"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            
            @if($polis->isEmpty())
                <div class="text-center py-16 bg-white rounded-[2rem] shadow-sm border border-dashed border-gray-300">
                    <div class="inline-flex p-4 rounded-full bg-gray-50 mb-4 text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Layanan Belum Tersedia</h3>
                    <p class="text-gray-500">Saat ini belum ada poli yang ditambahkan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($polis as $poli)
                    <div class="group relative bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden">
                        
                        <!-- Decorative Gradient Border Bottom -->
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-orange-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        
                        <!-- Icon Container -->
                        <div class="mb-6 relative">
                            <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-colors duration-300 shadow-sm border border-red-100 group-hover:border-red-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-red-700 transition-colors">{{ $poli->nama_poli }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3 group-hover:text-gray-600">
                                {{ $poli->deskripsi ?? 'Layanan medis spesialis dengan standar pelayanan terbaik untuk kesehatan Anda.' }}
                            </p>
                        </div>
                        
                        <!-- Action -->
                        <div class="pt-6 mt-auto border-t border-gray-50 flex items-center justify-between">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Spesialis</span>
                            
                            @if(Route::has('guest.poli.show'))
                            <a href="{{ route('guest.poli.show', $poli->id) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 text-gray-600 group-hover:bg-red-600 group-hover:text-white transition-all duration-300 transform group-hover:rotate-45">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"></path></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination (Jika ada) -->
                <div class="mt-12 flex justify-center">
                    <!-- (Opsional) Tambahkan pagination links jika data banyak -->
                </div>
            @endif

        </div>
    </section>

</x-guest-master>