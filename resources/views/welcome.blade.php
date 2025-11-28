<x-guest-master>
    <x-slot name="header">
        <!-- NAVBAR (Tetap Clean & Minimalis) -->
        <nav x-data="{ open: false, scrolled: false }" 
             @scroll.window="scrolled = (window.pageYOffset > 20)"
             :class="{ 'bg-white shadow-sm': scrolled, 'bg-transparent': !scrolled }"
             class="fixed top-0 w-full z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <div class="bg-red-600 p-1.5 rounded-lg">
                             <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                        <span :class="{ 'text-gray-900': scrolled, 'text-gray-800': !scrolled }" class="font-bold text-xl tracking-tight">BraveHeart</span>
                    </div>

                    <!-- Menu Tengah -->
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('home') }}" :class="{ 'text-gray-600 hover:text-red-600': scrolled, 'text-gray-600 hover:text-red-600': !scrolled }" class="text-sm font-medium transition-colors">Beranda</a>
                        <a href="{{ route('guest.polis') }}" :class="{ 'text-gray-600 hover:text-red-600': scrolled, 'text-gray-600 hover:text-red-600': !scrolled }" class="text-sm font-medium transition-colors">Layanan</a>
                        <a href="{{ route('guest.dokter') }}" :class="{ 'text-gray-600 hover:text-red-600': scrolled, 'text-gray-600 hover:text-red-600': !scrolled }" class="text-sm font-medium transition-colors">Dokter</a>
                        <a href="#contact" :class="{ 'text-gray-600 hover:text-red-600': scrolled, 'text-gray-600 hover:text-red-600': !scrolled }" class="text-sm font-medium transition-colors">Kontak</a>
                    </div>

                    <!-- Tombol Kanan -->
                    <div class="hidden md:flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-red-600 text-white text-sm font-bold rounded-full hover:bg-red-700 transition shadow-sm">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-red-600 text-sm font-bold transition">Masuk</a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-red-600 text-white text-sm font-bold rounded-full hover:bg-red-700 transition shadow-lg shadow-red-200">Buat Janji Temu</a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="-mr-2 flex items-center md:hidden">
                        <button @click="open = ! open" class="text-gray-500 hover:text-gray-700 p-2 rounded-md focus:outline-none">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-100">
                <div class="pt-2 pb-3 space-y-1 px-4">
                    <a href="{{ route('home') }}" class="block py-2 text-base font-medium text-gray-700 hover:text-red-600">Beranda</a>
                    <a href="{{ route('guest.polis') }}" class="block py-2 text-base font-medium text-gray-700 hover:text-red-600">Layanan</a>
                    <a href="{{ route('guest.dokter') }}" class="block py-2 text-base font-medium text-gray-700 hover:text-red-600">Dokter</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full mt-4 px-4 py-2 bg-red-600 text-white font-bold rounded-full text-center">Dashboard</a>
                    @else
                        <div class="mt-4 flex flex-col gap-2">
                            <a href="{{ route('login') }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-700 font-bold rounded-full text-center">Masuk</a>
                            <a href="{{ route('register') }}" class="block w-full px-4 py-2 bg-red-600 text-white font-bold rounded-full text-center">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
    </x-slot>

    <!-- 1. HERO SECTION -->
    <div x-data="{ videoOpen: false }" class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 bg-gradient-to-br from-red-50 via-white to-white overflow-hidden">
        
        <!-- Background Shape Abstrak -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
             <div class="absolute -top-[20%] -left-[10%] w-[70%] h-[70%] bg-red-100/40 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <!-- Kiri: Teks Hero -->
                <div class="space-y-6 animate-fade-in-up">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                        Perawatan Premium untuk <br>
                        <span class="text-red-700 relative">
                            Gaya Hidup Sehat
                            <svg class="absolute w-full h-3 -bottom-1 left-0 text-red-200 -z-10" viewBox="0 0 100 10" preserveAspectRatio="none">
                                <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none" />
                            </svg>
                        </span>
                    </h1>
                    
                    <p class="text-lg text-gray-500 leading-relaxed max-w-lg">
                        Majukan arsitektur kesehatan yang dapat diskalakan dengan strategi pertumbuhan masa depan. Implementasikan proses berisiko rendah dan hasil tinggi secara efisien.
                    </p>
                    
                    <!-- Tombol CTA -->
                    <div class="flex items-center gap-4 pt-2">
                        <button @click="videoOpen = true" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white font-semibold rounded-full hover:bg-red-700 transition shadow-lg shadow-red-200 group">
                            Lihat Rumah Sakit
                            <span class="bg-white/20 rounded-full p-1 group-hover:bg-white/30 transition">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                        </button>
                    </div>

                    <!-- Statistik -->
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-100 mt-8">
                        <div>
                            <p class="text-2xl font-bold text-gray-900">4500+</p>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Pasien Senang</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">200</p>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Kamar Rawat</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">500+</p>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Penghargaan</p>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Gambar & Kartu Melayang -->
                <div class="relative lg:h-[600px] flex items-end justify-center lg:justify-end animate-fade-in-right">
                    <div class="absolute top-10 right-0 w-[90%] h-[90%] bg-red-100 rounded-tl-[100px] rounded-br-[100px] rounded-tr-[50px] rounded-bl-[50px] -z-10"></div>
                    
                    <img src="{{ asset('images/hero.jpeg') }}" 
                         class="relative w-full max-w-md object-cover rounded-b-[50px] z-0" 
                         alt="Dokter Ramah">

                    <!-- Kartu Link -->
                    <a href="{{ route('guest.polis') }}" class="absolute top-1/3 -left-6 bg-white p-4 rounded-2xl shadow-xl border border-gray-50 flex items-center gap-4 max-w-xs z-20 animate-bounce-slow hover:scale-105 transition cursor-pointer group">
                        <div class="bg-black text-white p-3 rounded-xl group-hover:bg-red-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 group-hover:text-red-600 transition-colors">Cari Layanan Medis</p>
                            <p class="text-[10px] text-gray-400">Opsi perawatan lengkap</p>
                        </div>
                    </a>

                    <div class="absolute top-10 right-10 bg-white px-4 py-2 rounded-full shadow-lg border border-gray-50 flex items-center gap-2 z-20">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        <p class="text-xs font-bold text-gray-700">2500+ Dokter Online</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- VIDEO MODAL -->
        <div x-show="videoOpen" style="display: none;" x-transition class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/80 backdrop-blur-sm">
            <div class="relative w-full max-w-4xl bg-black rounded-2xl overflow-hidden shadow-2xl" @click.outside="videoOpen = false">
                <button @click="videoOpen = false" class="absolute top-4 right-4 text-white/70 hover:text-white z-10 bg-black/50 rounded-full p-2 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <div class="aspect-w-16 aspect-h-9 relative" style="padding-bottom: 56.25%;">
                    <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/DEjMEUQwSMk?autoplay=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. SEARCH BAR -->
    <div class="relative -mt-16 z-20 max-w-6xl mx-auto px-6">
        <div class="bg-red-900 rounded-2xl p-4 shadow-2xl flex flex-col md:flex-row gap-2 items-center">
             <div class="flex-1 w-full">
                 <select class="w-full bg-red-800/50 text-white border-none rounded-xl px-4 py-3 focus:ring-0 text-sm">
                     <option>Pilih Departemen</option>
                     @foreach($polis as $p) <option>{{ $p->nama_poli }}</option> @endforeach
                 </select>
             </div>
             <div class="flex-1 w-full">
                 <select class="w-full bg-red-800/50 text-white border-none rounded-xl px-4 py-3 focus:ring-0 text-sm">
                     <option>Pilih Dokter</option>
                     @foreach($dokters as $d) <option>{{ $d->name }}</option> @endforeach
                 </select>
             </div>
             <div class="flex-1 w-full">
                 <input type="date" class="w-full bg-red-800/50 text-white border-none rounded-xl px-4 py-3 focus:ring-0 text-sm placeholder-red-200">
             </div>
             <button class="w-full md:w-auto bg-white text-red-900 px-8 py-3 rounded-xl font-bold text-sm hover:bg-gray-100 transition flex items-center justify-center gap-2">
                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                 Cari
             </button>
        </div>
    </div>

    <!-- 3. PILIHAN POLI (REVISI: MODERN, MENYATU, LEBIH KEREN) -->
    <section class="py-32 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <!-- Judul Section (Updated Text & Size) -->
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                Poli & Spesialisasi Kami
            </h2>
            <p class="text-gray-500 text-lg mb-16 max-w-2xl mx-auto">
                Pilihan layanan medis terbaik dengan fasilitas modern untuk kesehatan jantung Anda.
            </p>

            <!-- Grid Poli (Desain Modern Glassmorphism) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($polis->take(6) as $poli)
                <a href="{{ route('guest.poli.show', $poli->id) }}" class="group relative p-8 bg-white rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col items-center text-center overflow-hidden border border-gray-100">
                    
                    <!-- Efek Hover Halus -->
                    <div class="absolute inset-0 bg-gradient-to-b from-red-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative z-10">
                        <!-- Icon Container (Besar & Stylish) -->
                        <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center shadow-inner group-hover:bg-red-600 group-hover:text-white transition-all duration-500 transform group-hover:rotate-3">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-red-700 transition-colors">{{ $poli->nama_poli }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6">{{ $poli->deskripsi }}</p>
                        
                        <!-- Tombol Kecil -->
                        <div class="inline-flex items-center text-sm font-bold text-red-600 group-hover:underline decoration-2 underline-offset-4 transition-all">
                            Selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    <section class="py-28 bg-white relative overflow-hidden">

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        
        <div class="relative z-10">
            
            <h2 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight mb-8">
                Layanan Kesehatan <br> <span class="text-rose-800">Kelas Dunia.</span>
            </h2>
            
            <p class="text-gray-600 text-xl mb-10 font-light leading-relaxed max-w-3xl">
                Kami menyediakan fasilitas medis terlengkap dengan standar internasional. Prioritas kami adalah memberikan kenyamanan, keselamatan, dan penanganan cepat bagi Anda dan keluarga.
            </p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-rose-200 hover:shadow-lg transition-all group">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-rose-100 rounded-xl flex items-center justify-center text-rose-700 shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-gray-900">Farmasi Lengkap</h3>
                            <p class="text-sm text-gray-500 mt-1">Tersedia 24 jam non-stop.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all group">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-gray-900">Rekam Medis</h3>
                            <p class="text-sm text-gray-500 mt-1">Terintegrasi & Aman.</p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('guest.polis') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-gray-900 text-white rounded-full text-lg font-bold hover:bg-rose-800 transition shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                Lihat Tim Dokter 
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="relative h-[550px] lg:h-[650px] flex items-end justify-center mt-12 lg:mt-0">
            
            <div class="absolute bottom-0 w-[100%] h-[95%] bg-gradient-to-t from-rose-950 via-rose-900 to-rose-800 rounded-t-[12rem] border-4 border-white shadow-2xl -z-20"></div>

            <img src="{{ asset('images/andijingga.png') }}" 
                 class="absolute left-0 lg:-left-24 bottom-0 w-auto h-[92%] object-contain z-10 transition-transform duration-300 hover:scale-105 drop-shadow-glow" 
                 alt="Dokter Kiri">

            <img src="{{ asset('images/kak_aliyah.png') }}" 
                 class="absolute right-0 lg:right-4 bottom-0 w-auto h-[92%] object-contain z-20 transition-transform duration-300 hover:scale-105 drop-shadow-glow" 
                 alt="Dokter Kanan">


            <div class="absolute bottom-12 -right-2 lg:-right-8 z-30 flex flex-col gap-4 items-end">
                <div class="bg-white p-3 rounded-xl shadow-lg border border-red-50 flex items-center gap-3 animate-bounce" style="animation-duration: 4s;">
                    <div class="bg-yellow-100 p-2 rounded-full text-yellow-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">Kepuasan Pasien</p>
                        <p class="text-sm font-bold text-gray-900">4.9/5.0 ⭐</p>
                    </div>
                </div>
                <div class="bg-white/95 backdrop-blur-sm px-6 py-4 rounded-2xl shadow-xl border-l-4 border-rose-800">
                    <div class="flex items-center gap-3">
                         <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white overflow-hidden"><img src="https://i.pravatar.cc/100?img=1" class="w-full h-full object-cover"></div>
                            <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white overflow-hidden"><img src="https://i.pravatar.cc/100?img=5" class="w-full h-full object-cover"></div>
                            <div class="w-10 h-10 rounded-full bg-rose-100 border-2 border-white flex items-center justify-center text-xs font-bold text-rose-700">+12</div>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-900">Tim Dokter Spesialis</p>
                            <p class="text-xs text-rose-700 font-medium">Siap Melayani 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<style>
    .drop-shadow-glow {
        filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.5));
    }
</style>

    <!-- 5. DOKTER SECTION (UPDATED: INSTAGRAM ICON) -->
    <section id="dokter" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-red-600 font-bold tracking-widest text-xs uppercase bg-red-50 px-3 py-1 rounded-full">Tim Ahli</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-4">Dokter Spesialis Kami</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($dokters as $dokter)
                <div class="group relative bg-gray-50 rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="{{ $dokter->profile_photo_url }}" 
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=random&size=500&color=fff'" 
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-105" 
                             alt="{{ $dokter->name }}">
                    </div>
                    
                    <div class="absolute bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md p-4 m-4 rounded-2xl shadow-sm text-center border border-gray-100">
                        <h3 class="text-base font-bold text-gray-900 line-clamp-1">{{ $dokter->name }}</h3>
                        <p class="text-xs text-red-600 font-medium mb-3">{{ $dokter->poli->nama_poli ?? 'Spesialis' }}</p>
                        
                        <!-- INSTAGRAM ICON (Di Tengah) -->
                        <div class="flex justify-center border-t border-gray-100 pt-3">
                            <a href="#" class="w-8 h-8 rounded-full bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 flex items-center justify-center text-white hover:scale-110 transition transform shadow-md" title="Instagram">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center text-gray-500 py-12 text-sm">Data dokter belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 6. FOOTER CTA (REVISI: TEKS SEDANG, BACKGROUND PUTIH/ABU) -->
    <section class="py-20 bg-gray-50 border-t border-gray-200">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                Kesehatan Jantung Anda,<br>
                <span class="text-red-600">Prioritas Utama Kami.</span>
            </h2>
            
            <p class="text-gray-600 mb-10 text-lg leading-relaxed max-w-2xl mx-auto">
                Konsultasikan kondisi Anda dengan ahli jantung terbaik kami hari ini untuk masa depan yang lebih sehat.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-red-600 text-white font-bold text-sm rounded-full transition-all shadow-lg hover:bg-red-700 hover:-translate-y-0.5">
                    Buat Janji Sekarang
                </a>
                 <a href="#contact" class="inline-block px-8 py-3 bg-white border border-gray-300 text-gray-700 font-bold text-sm rounded-full transition-all hover:border-red-600 hover:text-red-600 hover:-translate-y-0.5">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    @endpush

</x-guest-master>