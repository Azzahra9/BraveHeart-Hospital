<x-guest-master>
    
    <!-- 1. HERO SECTION REDESIGNED (Full Width Image + Overlay + Heart Illustration) -->
    <!-- Pastikan Anda memiliki gambar hero yang lebar dan berkualitas tinggi. Ganti 'images/hero-wide.jpg' dengan gambar Anda. -->
    <div class="relative min-h-[850px] flex items-center bg-cover bg-center bg-no-repeat bg-fixed" 
         style="background-image: url('{{ asset('images/hero.jpeg') }}');">
        
        <!-- Overlay Gradasi Maroon agar teks terbaca -->
        <div class="absolute inset-0 bg-gradient-to-r from-red-950/90 via-red-900/70 to-white/10"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Kolom Kiri: Teks & CTAs -->
            <div class="space-y-8 animate-fade-in-up">
                <!-- Badge Kecil -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-800/50 border border-red-400/30 backdrop-blur-md text-white text-sm font-bold">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                    Rumah Sakit Jantung Terpercaya #1
                </div>
                
                <div class="relative">
                    <!-- ILUSTRASI JANTUNG MELAYANG (SVG) -->
                    <div class="absolute -top-20 -right-10 md:-right-20 w-32 h-32 md:w-40 md:h-40 opacity-80 animate-pulse-slow hidden sm:block pointer-events-none">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-2xl text-red-500">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="currentColor"/>
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" stroke="white" stroke-opacity="0.3" stroke-width="0.5"/>
                        </svg>
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-extrabold text-white leading-tight tracking-tight drop-shadow-sm">
                        Kami Merawat <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-200 to-white">
                            Detak Jantung Anda.
                        </span>
                    </h1>
                </div>
                
                <p class="text-xl text-red-100 leading-relaxed max-w-xl font-light">
                    Layanan jantung terpadu dengan teknologi medis modern dan sentuhan personal dari ahli terbaik.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('register') }}" class="group px-8 py-4 bg-white text-primary font-bold rounded-full shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        Buat Janji Temu
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="#dokter" class="px-8 py-4 bg-red-900/40 text-white font-bold rounded-full border-2 border-white/30 hover:bg-red-900/60 hover:border-white transition-all duration-300 flex items-center justify-center backdrop-blur-sm">
                        Lihat Dokter
                    </a>
                </div>
            </div>

             <!-- Kolom Kanan: Statistik Melayang (Mirip Referensi) -->
             <div class="hidden lg:flex justify-end animate-fade-in-right relative">
                 <!-- Placeholder agar layout seimbang, bisa dikosongkan atau diisi elemen lain -->
                 <div class="h-[400px]"></div>

                 <!-- KARTU STATISTIK MELAYANG -->
                 <div class="absolute bottom-10 -left-20 bg-white p-6 rounded-[2rem] shadow-[0_20px_50px_rgba(153,27,27,0.3)] border border-red-50 flex items-center gap-5 animate-bounce-slow z-20 max-w-sm">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name=Dokter+Braveheart&background=991B1B&color=fff&rounded=true&bold=true" class="w-12 h-12 rounded-full border-2 border-white shadow-sm" alt="Avatar Icons">
                    </div>
                     <div>
                         <div class="flex -space-x-2 mb-2">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=A&background=random" alt="">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=B&background=random" alt="">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=C&background=random" alt="">
                            <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">+12</div>
                        </div>
                         <p class="text-2xl font-extrabold text-gray-900">15+ Dokter</p>
                         <p class="text-sm text-gray-500 font-medium">Spesialis Jantung Aktif</p>
                     </div>
                 </div>
            </div>
        </div>
        
        <!-- Gelombang Bawah -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-auto text-white fill-current" viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <!-- 2. KENAPA MEMILIH KAMI (Revamp Poli Section - Gaya Referensi 1) -->
    <section class="py-24 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-primary font-bold tracking-widest text-sm uppercase bg-red-50 px-4 py-2 rounded-full mb-4 inline-block">Pusat Keunggulan</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 leading-tight">Layanan Jantung Terpadu</h2>
                <p class="text-gray-600 text-xl mt-6 leading-relaxed font-light">Kami menyediakan pendekatan holistik untuk kesehatan jantung Anda, dari pencegahan hingga pemulihan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @forelse($polis as $index => $poli)
                <!-- Card Gaya Baru (Bersih & Ikon Besar) -->
                <div class="group bg-white p-8 rounded-[2.5rem] hover:shadow-2xl transition-all duration-500 text-center border border-transparent hover:border-red-100 relative relative overflow-hidden">
                     <!-- Dekorasi Hover -->
                     <div class="absolute inset-0 bg-gradient-to-b from-red-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[2.5rem]"></div>

                    <div class="relative z-10 flex flex-col items-center">
                        <!-- Ikon dalam Lingkaran Besar -->
                        <div class="w-28 h-28 bg-red-50 rounded-full flex items-center justify-center text-primary mb-8 group-hover:bg-primary group-hover:text-white transition-colors duration-500 shadow-md group-hover:shadow-lg group-hover:scale-110 transform">
                            {{-- Anda bisa mengganti SVG ini dengan ikon spesifik per poli jika ada di database --}}
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary transition">{{ $poli->nama_poli }}</h3>
                        <p class="text-gray-500 leading-relaxed mb-8 line-clamp-3">{{ $poli->deskripsi }}</p>
                        
                        @if(Route::has('guest.poli.show'))
                            <a href="{{ route('guest.poli.show', $poli->id) }}" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-red-50 text-primary font-bold text-sm group-hover:bg-primary group-hover:text-white transition-all">
                                Detail Layanan
                            </a>
                        @else
                             <a href="#" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-red-50 text-primary font-bold text-sm group-hover:bg-primary group-hover:text-white transition-all">
                                Detail Layanan
                            </a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-10 text-gray-400">Belum ada data poli.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 3. SECTION CERITA (Tetap Dipertahankan untuk Nilai Emosional) -->
    <section class="relative py-28 bg-gray-900 text-white overflow-hidden" x-data="{ openStory: false }">
        <div class="absolute inset-0">
            <img src="{{ asset('images/cerita.jpeg') }}" 
                 onerror="this.style.display='none'; this.parentElement.style.backgroundColor='#111'"
                 class="w-full h-full object-cover opacity-30 scale-105" alt="Background Cerita">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-950 via-gray-900/90 to-primary/20"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-red-400 font-bold tracking-wider mb-4 block uppercase text-sm">#KisahInspiratif</span>
                <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-8">
                    "Saya Pikir Itu Akhir, Ternyata <span class="text-red-500">Awal yang Baru.</span>"
                </h2>
                
                <div class="flex items-center gap-5 mb-10 p-5 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 max-w-md">
                    <img src="https://ui-avatars.com/api/?name=Hendra+Johari&background=random&color=fff" 
                         class="w-16 h-16 rounded-full border-2 border-red-500/50 object-cover shadow-lg">
                    <div>
                        <p class="font-bold text-white text-lg">Hendra Johari (45)</p>
                        <p class="text-sm text-red-300">Penyintas Penyakit Jantung</p>
                    </div>
                </div>

                <p class="text-gray-300 text-xl mb-10 leading-relaxed font-light italic">
                    "Diagnosis gagal jantung terasa seperti vonis mati. Namun, tim di BraveHeart tidak hanya mengobati jantung saya, mereka mengembalikan harapan saya."
                </p>

                <button @click="openStory = true" class="group inline-flex items-center gap-3 px-8 py-4 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition shadow-lg hover:shadow-red-900/30">
                    Baca Kisah Lengkap Hendra
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
            <!-- Bisa ditambahkan gambar ilustrasi pasien di kolom kanan jika ada -->
        </div>

        <!-- MODAL POP-UP CERITA (Isi sama seperti sebelumnya) -->
        <div x-show="openStory" style="display: none;" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-6">
            <div class="fixed inset-0 bg-black/90 backdrop-blur-sm" @click="openStory = false"></div>
            <div class="relative bg-white text-gray-900 rounded-3xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto p-8 md:p-12" @click.stop>
                <button @click="openStory = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-800 transition bg-gray-100 rounded-full p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <span class="text-primary font-bold tracking-wide text-sm uppercase mb-3 block">Kisah Inspiratif BraveHeart</span>
                <h3 class="text-3xl font-bold text-gray-900 mb-8">Kesempatan Kedua: Perjalanan Baru Hendra</h3>
                <div class="prose prose-lg text-gray-600 prose-red leading-relaxed">
                    <!-- (Isi cerita sama seperti sebelumnya) -->
                     <p class="mb-4 leading-relaxed">Hendra Johari (45) adalah seorang ayah yang penuh semangat. Namun, ia tidak menyangka bahwa rasa lelah yang sering ia rasakan adalah tanda awal penyakit jantung serius. Diagnosis di BraveHeart Hospital bagaikan petir: fungsi jantungnya menurun drastis.</p>
                    <p class="mb-4 leading-relaxed">Dunia Hendra seakan runtuh. Ia takut tidak bisa melihat anak-anaknya tumbuh dewasa. Namun, tim dokter spesialis di BraveHeart Hospital memberikan harapan melalui rencana perawatan yang komprehensif dan tindakan medis yang presisi.</p>
                    <p class="mb-6 leading-relaxed font-semibold text-gray-800 border-l-4 border-primary pl-6 italic bg-red-50/50 p-6 rounded-r-2xl">"Pasca tindakan, rasanya seperti menghirup udara segar untuk pertama kalinya. Rasa lelah kronis itu hilang. Saya kembali memiliki energi untuk bermain dengan anak saya," ujar Hendra dengan mata berbinar.</p>
                    <p class="leading-relaxed">Kini, Hendra menjalani hidup barunya dengan penuh apresiasi. BraveHeart Hospital bangga menjadi bagian dari perjalanan kesembuhannya. Setiap detak jantung adalah cerita berharga yang harus diperjuangkan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. DOKTER SECTION REDESIGNED (Card Bersih + SOSIAL MEDIA) -->
    <section id="dokter" class="py-24 bg-gradient-to-b from-red-50/50 to-white relative">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <span class="text-primary font-bold tracking-widest text-sm uppercase mb-2 block">Tim Ahli Kami</span>
                    <h2 class="text-4xl font-bold text-gray-900 leading-tight">Bertemu Dokter Spesialis</h2>
                    <p class="text-gray-600 mt-4 text-xl font-light max-w-2xl">Berpengalaman menangani kasus jantung kompleks dengan pendekatan personal.</p>
                </div>
                <a href="{{ route('guest.dokter') }}" class="px-8 py-4 bg-white border-2 border-red-100 text-primary rounded-full hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 font-bold shadow-sm flex items-center gap-2">
                    Lihat Semua Dokter
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                @forelse($dokters as $dokter)
                <!-- Doctor Card Gaya Baru (Minimalis & Ada Sosmed) -->
                <div class="group bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col">
                    <div class="h-80 overflow-hidden relative bg-red-50">
                        <img src="{{ $dokter->profile_photo_url }}" 
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=random&size=500&color=fff'" 
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-700 filter grayscale group-hover:grayscale-0" 
                             alt="{{ $dokter->name }}">
                         <!-- Overlay gradasi halus di bawah gambar -->
                        <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-white via-white/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    
                    <div class="p-8 flex flex-col flex-grow text-center relative z-10 -mt-6 pt-0">
                        <span class="inline-block mx-auto px-4 py-1.5 rounded-full bg-red-100 text-primary text-xs font-bold uppercase tracking-wider mb-4 border border-red-200 shadow-sm bg-white relative top-[-1.5rem]">
                            {{ $dokter->poli->nama_poli ?? 'Spesialis Jantung' }}
                        </span>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2 leading-tight">{{ $dokter->name }}</h3>
                        
                        <!-- === FITUR BARU: SOCIAL MEDIA ICONS === -->
                        <!-- Ikon-ikon ini bisa ditautkan ke profil asli dokter jika datanya ada -->
                        <div class="flex justify-center gap-4 my-5">
                            <!-- LinkedIn -->
                            <a href="#" class="text-gray-400 hover:text-[#0077b5] transition hover:scale-110 transform p-2 bg-gray-50 rounded-full hover:bg-blue-50">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                            <!-- X (Twitter) -->
                            <a href="#" class="text-gray-400 hover:text-black transition hover:scale-110 transform p-2 bg-gray-50 rounded-full hover:bg-gray-100">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            <!-- Facebook -->
                            <a href="#" class="text-gray-400 hover:text-[#1877f2] transition hover:scale-110 transform p-2 bg-gray-50 rounded-full hover:bg-blue-50">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                            </a>
                        </div>
                        <!-- ===================================== -->

                        <div class="mt-auto">
                            <a href="{{ route('register') }}" class="block w-full py-4 rounded-full bg-primary text-white font-bold text-sm hover:bg-red-800 transition-all shadow-md hover:shadow-xl hover:-translate-y-1">
                                Buat Janji Konsultasi
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center text-gray-500 py-12 font-light text-xl">Data dokter belum tersedia saat ini.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. ARTIKEL & BERITA (Tetap Dipertahankan) -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">Wawasan Kesehatan</h2>
                    <p class="text-gray-600 text-xl font-light max-w-xl">Artikel terbaru seputar kesehatan jantung dan gaya hidup sehat.</p>
                </div>
                <a href="#" class="text-primary font-bold hover:underline flex items-center gap-2 text-lg">Lihat Semua Artikel <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Artikel 1 -->
                <a href="#" target="_blank" class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-100 flex flex-col">
                    <div class="h-64 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?q=80&w=800" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Artikel 1">
                        <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold text-primary shadow-sm tracking-wider uppercase">Tips Sehat</div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="font-bold text-2xl mt-2 mb-4 group-hover:text-primary transition leading-snug">5 Makanan Super Penurun Kolesterol Alami</h3>
                        <p class="text-gray-500 mb-8 line-clamp-3 font-light leading-relaxed flex-grow">Menjaga pola makan adalah kunci utama dalam mengelola kadar kolesterol dalam darah secara efektif tanpa obat.</p>
                        <span class="text-primary font-bold group-hover:text-red-800 transition flex items-center gap-2 mt-auto">Baca Selengkapnya <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
                    </div>
                </a>
                <!-- Artikel 2 & 3 (Struktur Sama) -->
                <!-- ... (Kode artikel 2 & 3 dipertahankan seperti sebelumnya untuk keringkasan, hanya class yang disesuaikan) ... -->
                 <a href="#" target="_blank" class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-100 flex flex-col">
                    <div class="h-64 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Artikel 2">
                        <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold text-primary shadow-sm tracking-wider uppercase">Edukasi</div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="font-bold text-2xl mt-2 mb-4 group-hover:text-primary transition leading-snug">Kenali Gejala Dini Serangan Jantung Senyap</h3>
                        <p class="text-gray-500 mb-8 line-clamp-3 font-light leading-relaxed flex-grow">Tidak semua serangan jantung terasa nyeri hebat. Kenali tanda-tanda halus sebelum terlambat.</p>
                        <span class="text-primary font-bold group-hover:text-red-800 transition flex items-center gap-2 mt-auto">Baca Selengkapnya <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
                    </div>
                </a>
                <a href="#" target="_blank" class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-gray-100 flex flex-col">
                    <div class="h-64 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1530026405186-ed1f139313f8?q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Artikel 3">
                         <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold text-primary shadow-sm tracking-wider uppercase">Teknologi</div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="font-bold text-2xl mt-2 mb-4 group-hover:text-primary transition leading-snug">Inovasi Terbaru Operasi Bypass Jantung</h3>
                        <p class="text-gray-500 mb-8 line-clamp-3 font-light leading-relaxed flex-grow">Teknologi robotik dan minim sayatan memungkinkan pemulihan pasien yang jauh lebih cepat.</p>
                        <span class="text-primary font-bold group-hover:text-red-800 transition flex items-center gap-2 mt-auto">Baca Selengkapnya <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section (Desain Baru yang Lebih Bersih) -->
    <section class="py-24 bg-primary relative overflow-hidden">
        <!-- Dekorasi Background Abstrak -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10 pointer-events-none">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="absolute h-full w-full text-white fill-current top-0 left-0 origin-top-left scale-[2]">
                <path d="M0 0 L50 100 L100 0 Z" opacity="0.5"></path>
                 <path d="M0 100 L50 0 L100 100 Z" opacity="0.3" transform="translate(50,0)"></path>
            </svg>
        </div>

        <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-6xl font-extrabold text-white mb-8 leading-tight tracking-tight">
                Kesehatan Jantung Anda,<br>Prioritas Utama Kami.
            </h2>
            <p class="text-red-100 mb-12 text-xl leading-relaxed font-light max-w-3xl mx-auto">
                Jangan tunda. Konsultasikan kondisi Anda dengan ahli jantung terbaik kami hari ini untuk masa depan yang lebih sehat.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('register') }}" class="inline-block px-12 py-5 bg-white text-primary font-bold text-lg rounded-full transition-all shadow-xl hover:shadow-2xl hover:scale-105 transform hover:bg-red-50">
                    Daftar & Buat Janji Sekarang
                </a>
                 <a href="#contact" class="inline-block px-12 py-5 bg-transparent border-2 border-red-200 text-white font-bold text-lg rounded-full transition-all hover:bg-white/10 hover:border-white">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

</x-guest-master>