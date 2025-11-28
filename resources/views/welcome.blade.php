<x-guest-master>
    <x-slot name="header">
        <nav x-data="{ open: false, scrolled: false }"
             @scroll.window="scrolled = (window.pageYOffset > 20)"
             class="fixed top-0 w-full z-50 pointer-events-none pt-4 sm:pt-6 px-4 transition-all duration-300">
            <div :class="{ 'bg-white/95 shadow-md backdrop-blur-md': scrolled, 'bg-white/70 shadow-sm backdrop-blur-sm border border-white/40': !scrolled }"
                 class="max-w-7xl mx-auto rounded-full pointer-events-auto transition-all duration-500 ease-in-out">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16 lg:h-[4.5rem] transition-all duration-300">
                        <div class="flex-shrink-0 flex items-center gap-2">
                            <div class="bg-red-600 p-1.5 rounded-full shadow-sm">
                                 <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            </div>
                            <span class="font-bold text-xl tracking-tight text-gray-900">BraveHeart</span>
                        </div>
                        <div class="hidden md:flex space-x-1">
                            <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-red-600 rounded-full hover:bg-red-50 transition-all">Beranda</a>
                            <a href="{{ route('guest.polis') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-red-600 rounded-full hover:bg-red-50 transition-all">Layanan</a>
                            <a href="{{ route('guest.dokter') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-red-600 rounded-full hover:bg-red-50 transition-all">Dokter</a>
                            <a href="#contact" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-red-600 rounded-full hover:bg-red-50 transition-all">Kontak</a>
                        </div>
                        <div class="hidden md:flex items-center gap-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-red-600 text-white text-sm font-bold rounded-full hover:bg-red-700 transition shadow-sm">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 text-gray-600 hover:text-red-600 text-sm font-bold transition rounded-full hover:bg-red-50">Masuk</a>
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-red-600 text-white text-sm font-bold rounded-full hover:bg-red-700 transition shadow-lg shadow-red-100 hover:-translate-y-0.5">Buat Janji Temu</a>
                            @endauth
                        </div>
                        <div class="-mr-2 flex items-center md:hidden">
                            <button @click="open = ! open" class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100 focus:outline-none transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="open" x-transition class="md:hidden mt-2 pointer-events-auto px-2" style="display: none;">
                <div class="bg-white/95 backdrop-blur-md rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden p-4 space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-xl transition">Beranda</a>
                    <a href="{{ route('guest.polis') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-xl transition">Layanan</a>
                    <a href="{{ route('guest.dokter') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-600 hover:bg-red-50 rounded-xl transition">Dokter</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full mt-4 px-4 py-3 bg-red-600 text-white font-bold rounded-xl text-center shadow-md">Dashboard</a>
                    @else
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <a href="{{ route('login') }}" class="block w-full px-4 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl text-center hover:bg-gray-200 transition">Masuk</a>
                            <a href="{{ route('register') }}" class="block w-full px-4 py-3 bg-red-600 text-white font-bold rounded-xl text-center shadow-md hover:bg-red-700 transition">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
    </x-slot>

    <div x-data="{ videoOpen: false }" class="relative pt-36 pb-20 lg:pt-44 lg:pb-28 bg-gradient-to-br from-red-50 via-white to-white overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
             <div class="absolute -top-[20%] -left-[10%] w-[70%] h-[70%] bg-red-100/40 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8 animate-fade-in-up">
                    <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">Perawatan Premium untuk <br><span class="text-red-700">Gaya Hidup Sehat</span></h1>
                    <p class="text-xl text-gray-600 leading-relaxed max-w-lg font-light">Majukan arsitektur kesehatan yang dapat diskalakan dengan strategi pertumbuhan masa depan. Implementasikan proses berisiko rendah dan hasil tinggi secara efisien.</p>
                    <div class="flex items-center gap-4 pt-2">
                        <button @click="videoOpen = true" class="inline-flex items-center gap-3 px-8 py-4 bg-red-700 text-white font-bold rounded-full hover:bg-red-800 transition shadow-xl shadow-red-200 group text-lg hover:-translate-y-1">
                            Lihat Rumah Sakit
                            <span class="bg-white/20 rounded-full p-1.5 group-hover:bg-white/30 transition"><svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></span>
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-100 mt-8">
                        <div><p class="text-3xl font-bold text-gray-900">4500+</p><p class="text-xs text-gray-500 font-bold uppercase tracking-wide mt-1">Pasien Senang</p></div>
                        <div><p class="text-3xl font-bold text-gray-900">200</p><p class="text-xs text-gray-500 font-bold uppercase tracking-wide mt-1">Kamar Rawat</p></div>
                        <div><p class="text-3xl font-bold text-gray-900">500+</p><p class="text-xs text-gray-500 font-bold uppercase tracking-wide mt-1">Penghargaan</p></div>
                    </div>
                </div>
                <div class="relative h-[500px] lg:h-[650px] flex items-center justify-center animate-fade-in-right mt-10 lg:mt-0">
                    <div class="absolute w-[90%] h-[90%] bg-red-50 rounded-[4rem] rotate-3 -z-10 border border-red-100"></div>
                    <img src="{{ asset('images/hero.jpeg') }}" class="relative h-[95%] w-auto object-contain drop-shadow-2xl rounded-[3rem] z-10" alt="Dokter Ramah">
                    <a href="{{ route('guest.polis') }}" class="absolute top-1/4 -left-4 lg:-left-8 bg-white p-4 rounded-2xl shadow-xl border-l-4 border-red-600 flex items-center gap-4 max-w-xs z-20 animate-bounce" style="animation-duration: 3s;">
                        <div class="bg-gray-900 text-white p-3 rounded-xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
                        <div><p class="text-sm font-bold text-gray-900">Cari Layanan Medis</p><p class="text-[10px] text-gray-400">Opsi perawatan lengkap</p></div>
                    </a>
                    <div class="absolute bottom-10 right-4 lg:-right-4 bg-white px-5 py-3 rounded-full shadow-lg border border-gray-50 flex items-center gap-3 z-20">
                        <span class="relative flex h-3 w-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span></span>
                        <p class="text-sm font-bold text-gray-800">2500+ Dokter Online</p>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="videoOpen" style="display: none;" x-transition class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/80 backdrop-blur-sm">
            <div class="relative w-full max-w-4xl bg-black rounded-2xl overflow-hidden shadow-2xl" @click.outside="videoOpen = false">
                <button @click="videoOpen = false" class="absolute top-4 right-4 text-white/70 hover:text-white z-10 bg-black/50 rounded-full p-2 transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <div class="aspect-w-16 aspect-h-9 relative" style="padding-bottom: 56.25%;"><iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/DEjMEUQwSMk?autoplay=0" frameborder="0" allowfullscreen></iframe></div>
            </div>
        </div>
    </div>

    <div class="relative -mt-16 z-20 max-w-6xl mx-auto px-6">
        <div class="bg-red-900 rounded-2xl p-4 shadow-2xl flex flex-col md:flex-row gap-2 items-center border border-red-700">
             <div class="flex-1 w-full"><select class="w-full bg-red-800/50 text-white border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-400 text-sm"><option class="text-gray-900">Pilih Departemen</option>@foreach($polis as $p) <option class="text-gray-900">{{ $p->nama_poli }}</option> @endforeach</select></div>
             <div class="flex-1 w-full"><select class="w-full bg-red-800/50 text-white border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-400 text-sm"><option class="text-gray-900">Pilih Dokter</option>@foreach($dokters as $d) <option class="text-gray-900">{{ $d->name }}</option> @endforeach</select></div>
             <div class="flex-1 w-full"><input type="date" class="w-full bg-red-800/50 text-white border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-400 text-sm placeholder-red-200"></div>
             <button class="w-full md:w-auto bg-white text-red-900 px-8 py-3 rounded-xl font-bold text-sm hover:bg-gray-100 transition flex items-center justify-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Cari</button>
        </div>
    </div>

    <section class="py-32 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">Poli & Spesialisasi Kami</h2>
            <p class="text-gray-500 text-lg mb-16 max-w-2xl mx-auto">Pilihan layanan medis terbaik dengan fasilitas modern untuk kesehatan jantung Anda.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($polis->take(6) as $poli)
                <a href="{{ route('guest.poli.show', $poli->id) }}" class="group relative p-8 bg-white rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col items-center text-center overflow-hidden border border-gray-100">
                    <div class="absolute inset-0 bg-gradient-to-b from-red-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center shadow-inner group-hover:bg-red-600 group-hover:text-white transition-all duration-500 transform group-hover:rotate-3"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-red-700 transition-colors">{{ $poli->nama_poli }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6">{{ $poli->deskripsi }}</p>
                        <div class="inline-flex items-center text-sm font-bold text-red-600 group-hover:underline decoration-2 underline-offset-4 transition-all">Selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-28 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div class="relative z-30">
                <h2 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight mb-8">
                    Layanan Kesehatan <br> <span class="text-rose-800">Kelas Dunia.</span>
                </h2>
                
                <p class="text-gray-600 text-xl mb-10 font-light leading-relaxed max-w-3xl">
                    Kami menyediakan fasilitas medis terlengkap dengan standar internasional. Prioritas kami adalah memberikan kenyamanan, keselamatan, dan penanganan cepat bagi Anda dan keluarga.
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-rose-200 hover:shadow-lg transition-all group">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 bg-rose-100 rounded-xl flex items-center justify-center text-rose-700 shrink-0 group-hover:scale-110 transition-transform"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg></div>
                            <div><h3 class="font-bold text-xl text-gray-900">Farmasi Lengkap</h3><p class="text-sm text-gray-500 mt-1">Tersedia 24 jam non-stop.</p></div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all group">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 shrink-0 group-hover:scale-110 transition-transform"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
                            <div><h3 class="font-bold text-xl text-gray-900">Rekam Medis</h3><p class="text-sm text-gray-500 mt-1">Terintegrasi & Aman.</p></div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('guest.polis') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-gray-900 text-white rounded-full text-lg font-bold hover:bg-rose-800 transition shadow-xl hover:shadow-2xl transform hover:-translate-y-1">Lihat Tim Dokter <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            </div>

            <div class="relative z-0 h-[550px] lg:h-[650px] flex items-end justify-center mt-12 lg:mt-0">
                <img src="{{ asset('images/andijingga.png') }}" class="absolute left-0 lg:-left-24 bottom-0 w-auto h-[92%] object-contain z-10 transition-transform duration-300 hover:scale-105 drop-shadow-glow" alt="Dokter Kiri">
                <img src="{{ asset('images/kak_aliyah.png') }}" class="absolute right-0 lg:right-4 bottom-0 w-auto h-[92%] object-contain z-20 transition-transform duration-300 hover:scale-105 drop-shadow-glow" alt="Dokter Kanan">
                <div class="absolute bottom-12 -right-2 lg:-right-8 z-30 flex flex-col gap-4 items-end">
                    <div class="bg-white p-3 rounded-xl shadow-lg border border-red-50 flex items-center gap-3 animate-bounce" style="animation-duration: 4s;">
                        <div class="bg-yellow-100 p-2 rounded-full text-yellow-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg></div>
                        <div><p class="text-xs text-gray-500 font-semibold">Kepuasan Pasien</p><p class="text-sm font-bold text-gray-900">4.9/5.0 ⭐</p></div>
                    </div>
                    <div class="bg-white/95 backdrop-blur-sm px-6 py-4 rounded-2xl shadow-xl border-l-4 border-rose-800">
                        <div class="flex items-center gap-3">
                             <div class="flex -space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white overflow-hidden"><img src="https://i.pravatar.cc/100?img=1" class="w-full h-full object-cover"></div>
                                <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white overflow-hidden"><img src="https://i.pravatar.cc/100?img=5" class="w-full h-full object-cover"></div>
                                <div class="w-10 h-10 rounded-full bg-rose-100 border-2 border-white flex items-center justify-center text-xs font-bold text-rose-700">+12</div>
                            </div>
                            <div><p class="text-base font-bold text-gray-900">Tim Dokter Spesialis</p><p class="text-xs text-rose-700 font-medium">Siap Melayani 24/7</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dokter" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div class="text-left">
                    <span class="text-red-800 font-bold tracking-widest text-xs uppercase bg-red-50 px-3 py-1 rounded-full">Tim Ahli</span>
                    <h2 class="text-4xl lg:text-6xl font-bold text-gray-900 mt-4 leading-tight">Dokter Spesialis Kami</h2>
                </div>
                <a href="{{ route('guest.dokter') }}" class="inline-flex items-center gap-2 text-red-700 font-bold hover:underline transition">
                    Lihat Semua Dokter 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($dokters as $dokter)
                <div class="group relative bg-gray-50 rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="{{ $dokter->profile_photo_url }}" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=random&size=500&color=fff'" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="{{ $dokter->name }}">
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md p-3 m-2 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-center mb-2">
                            <h3 class="text-base font-bold text-gray-900 line-clamp-1">{{ $dokter->name }}</h3>
                            <p class="text-xs text-red-600 font-medium">{{ $dokter->poli->nama_poli ?? 'Spesialis' }}</p>
                        </div>
                        <div class="flex items-center gap-2 border-t border-gray-100 pt-2">
                            <a href="#" class="flex-1 bg-red-800 hover:bg-red-900 text-white text-[11px] font-bold py-2 rounded-lg transition-colors duration-300 flex items-center justify-center gap-1.5 shadow-sm group-hover:shadow-md">
                                Buat Janji <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-lg bg-gray-50 hover:bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 hover:text-white text-gray-400 flex items-center justify-center transition-all duration-300 border border-gray-100" title="Instagram">
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

    <section x-data="{ showStory: false }" class="relative py-32 bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/cerita.jpeg') }}" alt="Background Cerita" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 items-center">
            <div class="space-y-8">
                <p class="text-red-500 font-bold tracking-[0.2em] text-sm uppercase">#CERITABRAVEHEART</p>
                <h2 class="text-4xl lg:text-6xl font-bold text-white leading-tight">Perjuangan Hendra <br> Melawan <br> <span class="text-red-600">Penyakit Ginjal</span> <br> <span class="text-red-600">Turunan.</span></h2>
                <div class="inline-flex items-center gap-4 bg-white/10 backdrop-blur-md border border-white/10 p-3 pr-6 rounded-full">
                    <img src="{{ asset('images/kak_aliyah.png') }}" class="w-12 h-12 rounded-full object-cover border-2 border-red-600 bg-white" alt="Dokter">
                    <div><p class="text-white font-bold text-sm">Prof. Dr. dr. Aliyah Handayani, SpPD-KGH</p><p class="text-gray-400 text-xs">Spesialis Penyakit Dalam</p></div>
                </div>
                <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-red-600 pl-6 italic">"Penyakit ini pernah dialami oleh Hendra Johari (45). Setelah mengalami penurunan fungsi ginjal akibat ginjal polikistik, ia memutuskan untuk menjalani transplantasi ginjal di BraveHeart Hospital."</p>
                <button @click="showStory = true" class="group inline-flex items-center gap-2 text-white font-bold border-b-2 border-red-600 pb-1 hover:text-red-500 transition-colors">Baca Selengkapnya <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </div>
        </div>
        <div x-show="showStory" style="display: none;" x-transition class="fixed inset-0 z-[60] flex items-center justify-center px-4 bg-black/80 backdrop-blur-sm">
            <div class="bg-white w-full max-w-2xl rounded-3xl p-8 relative max-h-[90vh] overflow-y-auto" @click.outside="showStory = false">
                <button @click="showStory = false" class="absolute top-4 right-4 text-gray-400 hover:text-red-600 transition"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <span class="text-red-600 font-bold tracking-widest text-xs uppercase bg-red-50 px-3 py-1 rounded-full mb-4 inline-block">Kisah Inspiratif</span>
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Perjuangan Hendra Melawan Penyakit Ginjal Turunan</h3>
                <div class="prose prose-red max-w-none text-gray-600 space-y-4">
                    <p>Hendra Johari (45) tak pernah menyangka bahwa kelelahan yang sering ia rasakan adalah tanda dari penyakit serius. "Awalnya saya pikir hanya kurang istirahat karena pekerjaan," ujarnya.</p>
                    <p>Setelah pemeriksaan mendalam di BraveHeart Hospital, Hendra didiagnosis menderita <strong>Ginjal Polikistik</strong>, sebuah kondisi genetik yang menyebabkan tumbuh kista di dalam ginjal.</p>
                    <p>Di bawah penanganan <strong>Prof. Dr. dr. Aliyah Handayani</strong>, tim medis memutuskan langkah terbaik adalah transplantasi ginjal. "Keputusan yang berat, tapi dokter menjelaskan dengan sangat detail dan menenangkan," kenang Hendra.</p>
                    <p>Operasi berjalan selama 6 jam dengan sukses. Kini, 6 bulan pasca operasi, Hendra kembali menjalani aktivitasnya dengan normal. "BraveHeart memberikan saya kesempatan kedua," tutupnya dengan senyum.</p>
                </div>
                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end"><button @click="showStory = false" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold rounded-full transition">Tutup Cerita</button></div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-red-800 font-bold tracking-widest text-xs uppercase">Edukasi & Berita</span>
                    <h2 class="text-4xl lg:text-6xl font-bold text-gray-900 mt-2">Artikel Kesehatan Terbaru</h2>
                </div>
                <a href="#" class="hidden md:flex items-center gap-2 text-red-700 font-bold hover:underline">Lihat Semua Artikel <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <a href="https://www.halodoc.com/kesehatan/penyakit-jantung" target="_blank" class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-10 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500" alt="Jantung">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3 text-xs font-bold text-red-600 uppercase tracking-wider"><span>Jantung</span><span class="w-1 h-1 rounded-full bg-gray-300"></span><span>28 Nov 2025</span></div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-700 transition">5 Tanda Awal Penyakit Jantung yang Sering Diabaikan</h3>
                        <div class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-red-600 transition mt-2">Baca Artikel <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></div>
                    </div>
                </a>

                <a href="https://www.alodokter.com/check-up-kesehatan-penting-dilakukan-secara-rutin" target="_blank" class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-10 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500" alt="Tips Sehat">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3 text-xs font-bold text-blue-600 uppercase tracking-wider"><span>Tips Sehat</span><span class="w-1 h-1 rounded-full bg-gray-300"></span><span>25 Nov 2025</span></div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-700 transition">Pentingnya Medical Check-Up Rutin Usia 40 Tahun</h3>
                        <div class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-red-600 transition mt-2">Baca Artikel <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></div>
                    </div>
                </a>

                <a href="https://www.klikdokter.com/penyakit/masalah-jantung-dan-pembuluh-darah/kateterisasi-jantung" target="_blank" class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-10 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500" alt="Teknologi">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3 text-xs font-bold text-purple-600 uppercase tracking-wider"><span>Teknologi</span><span class="w-1 h-1 rounded-full bg-gray-300"></span><span>20 Nov 2025</span></div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-700 transition">Mengenal Kateterisasi Jantung: Prosedur & Manfaat</h3>
                        <div class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-red-600 transition mt-2">Baca Artikel <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></div>
                    </div>
                </a>

                <a href="https://www.halodoc.com/artikel/makanan-sehat-untuk-jantung" target="_blank" class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-10 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500" alt="Gaya Hidup">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3 text-xs font-bold text-green-600 uppercase tracking-wider"><span>Gaya Hidup</span><span class="w-1 h-1 rounded-full bg-gray-300"></span><span>15 Nov 2025</span></div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-700 transition">7 Makanan Super untuk Menjaga Kesehatan Jantung</h3>
                        <div class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-red-600 transition mt-2">Baca Artikel <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></div>
                    </div>
                </a>
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="#" class="inline-block text-red-700 font-bold border-b border-red-700 pb-1">Lihat Semua Artikel</a>
            </div>
        </div>
    </section>

    <section class="py-28 bg-white relative">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-8 leading-tight">Kesehatan Jantung Anda,<br><span class="text-red-800">Prioritas Utama Kami.</span></h2>
            <p class="text-gray-600 mb-12 text-xl font-light leading-relaxed max-w-3xl mx-auto">Jangan tunda kesehatan Anda. Konsultasikan kondisi Anda dengan ahli jantung terbaik kami hari ini untuk masa depan yang lebih sehat dan bahagia.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-5">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-4 bg-red-800 text-white font-bold text-base rounded-full transition-all shadow-lg hover:bg-red-900 hover:shadow-xl hover:-translate-y-1">Buat Janji Sekarang</a>
                <a href="#contact" class="inline-flex items-center justify-center px-10 py-4 bg-white border-2 border-gray-200 text-gray-700 font-bold text-base rounded-full transition-all hover:border-red-800 hover:text-red-800 hover:-translate-y-1">Hubungi Kami</a>
            </div>
        </div>
    </section>

    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .drop-shadow-glow { filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.5)); }
        [x-cloak] { display: none !important; }
    </style>
    @endpush
</x-guest-master>