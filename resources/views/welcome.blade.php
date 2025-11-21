<x-guest-master>
    
    <!-- 1. HERO SECTION (Gradasi Lebih Jelas & Modern) -->
    <!-- Ubah from-red-50 jadi from-red-100, dan tambahkan via-red-50 -->
    <div class="relative bg-gradient-to-br from-red-100 via-white to-white min-h-[750px] flex items-center overflow-hidden">
        
        <!-- Dekorasi Background (Lebih Pekat) -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-red-200 rounded-full blur-3xl opacity-40"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-red-100 rounded-full blur-3xl opacity-60"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Teks Hero -->
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-red-100 shadow-sm text-primary text-sm font-bold animate-fade-in-up">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                    Rumah Sakit Jantung No. #1
                </div>
                
                <h1 class="text-5xl lg:text-7xl font-extrabold text-gray-900 leading-tight tracking-tight">
                    Rawat Jantung,<br>
                    <!-- Gradasi Teks Lebih Kontras -->
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-red-600 to-red-400">
                        Rawat Kehidupan.
                    </span>
                </h1>
                
                <p class="text-lg text-gray-600 leading-relaxed max-w-lg">
                    Teknologi medis terdepan dengan sentuhan personal. Kami hadir untuk memastikan detak jantung Anda tetap berirama indah.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <a href="{{ route('register') }}" class="group px-8 py-4 bg-gradient-to-r from-primary to-red-700 text-white font-bold rounded-full shadow-lg shadow-red-900/30 hover:shadow-red-900/50 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        Buat Janji Temu
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="#dokter" class="px-8 py-4 bg-white text-gray-700 font-bold rounded-full border border-gray-200 hover:border-primary hover:text-primary transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md">
                        Cari Dokter
                    </a>
                </div>

                <!-- Statistik Ringkas -->
                <div class="flex items-center gap-12 pt-6 border-t border-red-100">
                    <div>
                        <p class="text-4xl font-bold text-gray-900">15k+</p>
                        <p class="text-sm text-gray-500 font-medium">Pasien Sembuh</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-gray-900">98%</p>
                        <p class="text-sm text-gray-500 font-medium">Tingkat Kepuasan</p>
                    </div>
                </div>
            </div>

            <!-- Gambar Hero (LOKAL) -->
            <div class="relative hidden lg:block">
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border-[6px] border-white transform rotate-2 hover:rotate-0 transition duration-500">
                    <img src="{{ asset('images/hero.jpeg') }}" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block'"
                         alt="Dokter Ramah" class="w-full h-auto object-cover transform hover:scale-105 transition duration-700">
                    
                    <div style="display:none;" class="w-full h-[600px] bg-gray-200 flex items-center justify-center text-gray-500">
                        Gambar 'images/hero.jpeg' tidak ditemukan.
                    </div>
                </div>

                <!-- Kartu Dokter Bertugas -->
                <div class="absolute -bottom-8 -left-8 bg-white/90 backdrop-blur-sm p-5 rounded-2xl shadow-xl border border-white animate-bounce" style="animation-duration: 4s;">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <img src="{{ asset('images/dr.aliyah.jpeg') }}" 
                                 onerror="this.src='https://ui-avatars.com/api/?name=Dr+Sarah&background=random'"
                                 class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                            <span class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">dr. Aliyah, Sp.JP</p>
                            <p class="text-xs text-green-700 font-bold bg-green-100 px-2 py-0.5 rounded-full inline-block mt-1">Sedang Bertugas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. LAYANAN UNGGULAN (3 Poli) -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-primary font-bold tracking-widest text-xs uppercase bg-red-50 px-3 py-1 rounded-full">Pusat Keunggulan</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-4 mb-4">Layanan Spesialis Jantung</h2>
                <p class="text-gray-500 text-lg">Menangani segala keluhan jantung mulai dari pencegahan, diagnosa, hingga tindakan intervensi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($polis as $index => $poli)
                <div class="group relative bg-white rounded-3xl p-8 border border-gray-100 hover:border-red-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <!-- Gradasi Hover -->
                    <div class="absolute top-0 right-0 bg-gradient-to-bl from-red-100 to-transparent w-32 h-32 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-150 duration-500 opacity-50"></div>
                    
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300 border border-red-50">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $poli->nama_poli }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">{{ $poli->deskripsi }}</p>
                        
                        @if(Route::has('guest.poli.show'))
                            <a href="{{ route('guest.poli.show', $poli->id) }}" class="inline-flex items-center text-primary font-bold text-sm group-hover:translate-x-2 transition-transform">
                                Info Selengkapnya <span class="ml-1">→</span>
                            </a>
                        @else
                             <a href="#" class="inline-flex items-center text-primary font-bold text-sm group-hover:translate-x-2 transition-transform">
                                Info Selengkapnya <span class="ml-1">→</span>
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

    <!-- 3. SECTION CERITA (Background Lebih Gelap & Dramatis) -->
    <section class="relative py-24 bg-gray-900 text-white overflow-hidden" x-data="{ openStory: false }">
        <!-- Background Image (LOKAL) -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/cerita.jpeg') }}" 
                 onerror="this.style.display='none'; this.parentElement.style.backgroundColor='#111'"
                 class="w-full h-full object-cover opacity-40" alt="Background Cerita">
            <!-- Gradasi Overlay Lebih Kuat -->
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 flex flex-col justify-center h-full">
            <div class="max-w-2xl">
                <span class="text-red-400 font-bold tracking-wider mb-3 block uppercase text-sm">#CeritaBraveHeart</span>
                <h2 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    Perjuangan Hendra Melawan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600">Penyakit Ginjal Turunan.</span>
                </h2>
                
                <div class="flex items-center gap-4 mb-8 p-4 bg-white/10 backdrop-blur-md rounded-xl border border-white/10 inline-flex">
                    <img src="{{ asset('images/dr.aliyah.jpeg') }}" 
                         onerror="this.src='https://ui-avatars.com/api/?name=Prof+Endang&background=random'"
                         class="w-12 h-12 rounded-full border-2 border-white/50 object-cover">
                    <div>
                        <p class="font-bold text-white">Prof. Dr. dr. Aliyah Handayani, SpPD-KGH</p>
                        <p class="text-xs text-gray-300">Spesialis Penyakit Dalam</p>
                    </div>
                </div>

                <p class="text-gray-200 text-lg mb-8 leading-relaxed font-light">
                    "Penyakit ini pernah dialami oleh Hendra Johari (45). Setelah mengalami penurunan fungsi ginjal akibat ginjal polikistik, ia memutuskan untuk menjalani transplantasi ginjal di BraveHeart Hospital."
                </p>

                <div>
                    <button @click="openStory = true" class="group inline-flex items-center gap-2 text-white font-bold hover:text-red-400 transition border-b-2 border-red-500 pb-1 cursor-pointer focus:outline-none">
                        Baca Selengkapnya <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL POP-UP AREA -->
        <div x-show="openStory" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-6"
             style="display: none;">
            
            <div class="fixed inset-0 bg-black/90 backdrop-blur-sm" @click="openStory = false"></div>

            <div class="relative bg-white text-gray-900 rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto p-8 md:p-12 transform transition-all" @click.stop>
                <button @click="openStory = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none bg-gray-100 rounded-full p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <span class="text-primary font-bold tracking-wide text-sm uppercase mb-2 block">Kisah Inspiratif</span>
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Kesempatan Kedua: Perjalanan Baru Hendra</h3>
                
                <div class="prose prose-lg text-gray-600">
                    <p class="mb-4 leading-relaxed">
                        Hendra Johari (45) adalah seorang ayah yang penuh semangat dan aktif. Namun, ia tidak pernah menyangka bahwa rasa lelah yang sering ia rasakan bukanlah sekadar kelelahan biasa. Itu adalah tanda-tanda awal dari penyakit ginjal polikistik (PKD), sebuah kelainan genetik yang menyebabkan tumbuhnya banyak kista di ginjal, mengganggu fungsinya secara perlahan namun pasti.
                    </p>
                    <p class="mb-4 leading-relaxed">
                        "Awalnya saya pikir hanya faktor usia atau kurang istirahat karena pekerjaan," kenang Hendra. Namun, hari demi hari, kondisinya semakin menurun. Wajahnya pucat, tubuhnya bengkak, dan napasnya sering terasa sesak. Diagnosis dokter di BraveHeart Hospital bagaikan petir di siang bolong: fungsi ginjalnya sudah menurun drastis hingga di bawah 15%. Ginjalnya tak lagi mampu menyaring racun dalam tubuhnya.
                    </p>
                    <p class="mb-4 leading-relaxed">
                        Dunia Hendra seakan runtuh. Ia dihadapkan pada dua pilihan berat: menjalani cuci darah (dialisis) seumur hidup atau melakukan transplantasi ginjal. "Saya takut tidak bisa melihat anak-anak saya tumbuh dewasa," ujarnya lirih. Ketakutan akan masa depan menyelimuti dirinya dan keluarganya.
                    </p>
                    <p class="mb-4 leading-relaxed">
                        Prof. Dr. dr. Endang Susalit, SpPD-KGH, spesialis penyakit dalam konsultan ginjal dan hipertensi di BraveHeart Hospital, menyarankan transplantasi sebagai solusi jangka panjang terbaik untuk kualitas hidup Hendra. "Meskipun terdengar menakutkan, tingkat keberhasilan transplantasi saat ini sangat tinggi berkat kemajuan teknologi dan tim medis yang berpengalaman," jelas Prof. Endang, memberikan secercah harapan.
                    </p>
                    <p class="mb-4 leading-relaxed">
                        Proses persiapan pun dimulai. Dukungan keluarga menjadi kekuatan utama Hendra. Setelah melalui serangkaian tes kecocokan yang ketat, donor yang sesuai akhirnya ditemukan. Hari operasi pun tiba. Tim dokter ahli BraveHeart Hospital bekerja dengan presisi tinggi menggunakan teknologi laparoskopi terbaru, meminimalkan sayatan dan mempercepat pemulihan. Operasi yang berlangsung selama 4 jam itu berjalan lancar tanpa komplikasi berarti.
                    </p>
                    <p class="mb-4 leading-relaxed font-semibold text-gray-800 border-l-4 border-primary pl-4 italic bg-red-50 p-4 rounded-r-lg">
                        "Saat saya membuka mata pasca operasi, rasanya seperti menghirup udara segar untuk pertama kalinya setelah sekian lama. Rasa lelah yang kronis itu hilang. Dua minggu kemudian, saya sudah bisa pulang dan bahkan mulai bermain bola ringan dengan anak saya di halaman rumah," ujar Hendra dengan mata berbinar penuh rasa syukur.
                    </p>
                    <p class="leading-relaxed">
                        Kini, Hendra menjalani hidup barunya dengan penuh apresiasi. Ia disiplin menjaga pola makan dan rutin berolahraga. BraveHeart Hospital bangga menjadi bagian dari perjalanan kesembuhan Hendra. Kisahnya adalah bukti nyata bahwa dengan penanganan medis yang tepat dan semangat pantang menyerah, harapan selalu ada. Karena bagi kami, setiap detak jantung adalah sebuah cerita berharga yang harus diperjuangkan.
                    </p>
                </div>
                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                    <button @click="openStory = false" class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-red-700 transition shadow-lg">Tutup Cerita</button>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. DOKTER SECTION (4 Dokter - FOTO LOKAL) -->
    <section id="dokter" class="py-24 bg-gradient-to-b from-white to-red-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <span class="text-primary font-bold tracking-widest text-xs uppercase">Tim Ahli</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Dokter Spesialis Kami</h2>
                    <p class="text-gray-600 mt-2 text-lg">Berpengalaman menangani kasus jantung kompleks.</p>
                </div>
                <a href="{{ route('guest.dokter') }}" class="px-6 py-3 bg-white border border-gray-200 rounded-full hover:border-primary hover:text-primary transition font-bold text-sm shadow-sm">
                    Lihat Semua Dokter
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($dokters as $dokter)
                <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="h-72 overflow-hidden relative bg-gray-100">
                        <img src="{{ asset('images/dokter-' . $dokter->id . '.jpeg') }}" 
                             onerror="this.onerror=null; this.src='https://placehold.co/400x600?text=No+Image'" 
                             class="w-full h-full object-cover object-top group-hover:scale-110 transition duration-700" 
                             alt="{{ $dokter->name }}">
                        
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 pt-16">
                            <div class="flex items-center gap-2 text-white/90 text-xs font-medium">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                <span>Tersedia Hari Ini</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-xs font-bold tracking-wide text-primary uppercase mb-2 bg-red-50 inline-block px-2 py-1 rounded">
                            {{ $dokter->poli->nama_poli ?? 'Spesialis Umum' }}
                        </p>
                        <h3 class="text-lg font-bold mb-4 text-gray-900 leading-tight">{{ $dokter->name }}</h3>
                        <a href="{{ route('register') }}" class="block w-full text-center py-2.5 rounded-lg border-2 border-primary text-primary font-bold text-sm hover:bg-primary hover:text-white transition-colors">
                            Buat Janji
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center text-gray-500 py-12">Data dokter belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. ARTIKEL & BERITA (GAMBAR URL INTERNET) -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Artikel Kesehatan</h2>
                <a href="#" class="text-primary font-bold hover:underline flex items-center gap-1">Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Artikel 1 -->
                <a href="#" target="_blank" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-gray-100">
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?q=80&w=800" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Artikel 1">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary shadow-sm">Tips Sehat</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mt-1 mb-3 group-hover:text-primary transition leading-snug">5 Makanan Penurun Kolesterol Alami</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">Menjaga pola makan adalah kunci utama dalam mengelola kadar kolesterol dalam darah.</p>
                        <span class="text-sm font-bold text-gray-400 group-hover:text-primary transition flex items-center gap-1">Baca Selengkapnya <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></span>
                    </div>
                </a>
                <!-- Artikel 2 -->
                <a href="#" target="_blank" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-gray-100">
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=800" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Artikel 2">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary shadow-sm">Edukasi</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mt-1 mb-3 group-hover:text-primary transition leading-snug">Gejala Awal Serangan Jantung</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">Kenali tanda-tanda dini seperti nyeri dada, sesak napas, dan keringat dingin sebelum terlambat.</p>
                        <span class="text-sm font-bold text-gray-400 group-hover:text-primary transition flex items-center gap-1">Baca Selengkapnya <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></span>
                    </div>
                </a>
                <!-- Artikel 3 -->
                <a href="#" target="_blank" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-gray-100">
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1530026405186-ed1f139313f8?q=80&w=800" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Artikel 3">
                         <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary shadow-sm">Teknologi</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mt-1 mb-3 group-hover:text-primary transition leading-snug">Operasi Bypass Minim Sayatan</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">Teknologi terbaru memungkinkan pemulihan yang jauh lebih cepat dan rasa sakit yang minimal.</p>
                        <span class="text-sm font-bold text-gray-400 group-hover:text-primary transition flex items-center gap-1">Baca Selengkapnya <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden shadow-2xl">
                <!-- Dekorasi -->
                <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -ml-20 -mt-20"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-primary opacity-20 rounded-full -mr-20 -mb-20 blur-3xl"></div>

                <div class="relative z-10 max-w-3xl mx-auto">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6">Jangan Tunggu Sampai Terlambat</h2>
                    <p class="text-gray-300 mb-8 text-lg leading-relaxed">Kesehatan jantung adalah investasi terbaik masa depan Anda. Lakukan pemeriksaan rutin sekarang juga dengan mudah melalui website kami.</p>
                    <a href="{{ route('register') }}" class="inline-block px-12 py-4 bg-gradient-to-r from-primary to-red-600 hover:from-red-600 hover:to-red-800 text-white font-bold text-lg rounded-full transition-all shadow-lg shadow-red-900/50 hover:scale-105 transform">
                        Daftar & Buat Janji Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-guest-master>