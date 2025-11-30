<x-guest-master>

    <!-- HERO SECTION (Clean White Background) -->
    <div class="relative bg-white pt-32 pb-28 overflow-hidden">
        
        <!-- Subtle Texture Pattern (Optional, very light) -->
        <div class="absolute inset-0 opacity-[0.02] bg-[radial-gradient(#991b1b_1px,transparent_1px)] [background-size:16px_16px]"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-gray-200 text-red-800 text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
                    Tim Medis Profesional
                </div>
                
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight leading-tight">
                    Temui <span class="text-red-800">Dokter Spesialis</span> Kami
                </h1>
                
                <p class="text-lg text-gray-500 font-light leading-relaxed">
                    Didukung oleh tim dokter spesialis jantung berpengalaman yang siap memberikan pelayanan terbaik dengan sepenuh hati untuk kesehatan Anda.
                </p>
            </div>
        </div>
    </div>

    <!-- SEARCH & LIST SECTION -->
    <main class="pb-20 bg-gray-50 relative z-20 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <!-- Floating Search Card -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white -mt-16 relative z-30 mb-16">
                <form action="{{ route('guest.dokter') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                        
                        <!-- 1. Pencarian Nama -->
                        <div class="md:col-span-4">
                            <label for="search" class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Nama Dokter</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </span>
                                <input type="search" name="search" value="{{ $search }}" placeholder="Cari nama dokter..."
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-red-800 focus:ring-red-800 text-sm transition shadow-sm">
                            </div>
                        </div>

                        <!-- 2. Filter Poli -->
                        <div class="md:col-span-3">
                            <label for="poli_id" class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Spesialisasi</label>
                            <div class="relative">
                                <select name="poli_id" id="poli_id" class="w-full pl-4 pr-10 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-red-800 focus:ring-red-800 text-sm appearance-none transition shadow-sm cursor-pointer">
                                    <option value="">Semua Poli</option>
                                    @foreach($polis as $poli)
                                        <option value="{{ $poli->id }}" {{ $poliId == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 3. Filter Hari -->
                        <div class="md:col-span-3">
                            <label for="hari" class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Hari Praktik</label>
                            <div class="relative">
                                <select name="hari" id="hari" class="w-full pl-4 pr-10 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-red-800 focus:ring-red-800 text-sm appearance-none transition shadow-sm cursor-pointer">
                                    <option value="">Semua Hari</option>
                                    @foreach($listHari as $h)
                                        <option value="{{ $h }}" {{ $hari == $h ? 'selected' : '' }}>
                                            {{ $h }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 4. Tombol Aksi -->
                        <div class="md:col-span-2">
                            <button type="submit"
                                class="w-full h-[46px] inline-flex items-center justify-center px-6 bg-red-800 hover:bg-red-900 text-white font-bold text-sm rounded-xl shadow-lg shadow-red-900/20 transition-all transform hover:-translate-y-0.5">
                                Terapkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- HASIL PENCARIAN -->
            @if ($dokters->isEmpty())
                <div class="text-center py-16 bg-white rounded-[2rem] border border-dashed border-gray-300">
                    <div class="inline-flex p-4 rounded-full bg-gray-50 mb-4 text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Dokter Ditemukan</h3>
                    <p class="text-gray-500">Coba ubah kata kunci atau filter pencarian Anda.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($dokters as $dokter)
                        <div class="group bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:border-red-100 transition-all duration-300 flex flex-col items-center text-center relative overflow-hidden">
                            
                            <!-- Simple Hover Effect -->
                            <div class="absolute top-0 left-0 w-full h-1 bg-red-800 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>

                            <!-- Foto Profil -->
                            <div class="relative z-10 mb-5 mt-2">
                                <div class="w-24 h-24 rounded-full p-1 bg-white border-2 border-gray-100 shadow-md group-hover:border-red-200 transition-colors duration-300 mx-auto">
                                    <img src="{{ $dokter->profile_photo_url }}" 
                                         alt="{{ $dokter->name }}" 
                                         class="w-full h-full object-cover rounded-full"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=random&size=400'">
                                </div>
                                <!-- Status Dot -->
                                <div class="absolute bottom-1 right-1 bg-green-500 w-4 h-4 rounded-full border-2 border-white" title="Tersedia"></div>
                            </div>

                            <!-- Info Dokter -->
                            <div class="relative z-10 w-full mb-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 truncate px-2 group-hover:text-red-800 transition-colors" title="{{ $dokter->name }}">
                                    {{ $dokter->name }}
                                </h3>
                                <p class="text-xs font-bold text-red-700 uppercase tracking-wide bg-red-50 inline-block px-3 py-1 rounded-lg border border-red-100">
                                    {{ $dokter->poli->nama_poli ?? 'Umum' }}
                                </p>
                                
                                <!-- Jadwal Singkat -->
                                <div class="mt-4 pt-4 border-t border-gray-50 text-sm text-gray-500 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @if($dokter->schedules->isNotEmpty())
                                        <span>{{ $dokter->schedules->count() }} Hari Praktik</span>
                                    @else
                                        <span class="italic">Jadwal Belum Tersedia</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="relative z-10 w-full mt-auto">
                                @if(auth()->check() && auth()->user()->role === 'pasien')
                                    <a href="{{ route('pasien.appointments.create', ['dokter_id' => $dokter->id]) }}" 
                                       class="block w-full py-2.5 bg-white border border-gray-200 text-gray-700 font-bold text-sm rounded-xl group-hover:bg-red-800 group-hover:text-white group-hover:border-red-800 transition-all shadow-sm">
                                        Buat Janji
                                    </a>
                                @elseif(!auth()->check())
                                    <a href="{{ route('login') }}" 
                                       class="block w-full py-2.5 bg-gray-50 border border-gray-200 text-gray-500 font-bold text-sm rounded-xl hover:bg-gray-100 transition">
                                        Login untuk Booking
                                    </a>
                                @else
                                    <button disabled class="block w-full py-2.5 bg-gray-100 text-gray-400 font-bold text-sm rounded-xl cursor-not-allowed">
                                        Khusus Pasien
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($dokters->hasPages())
                    <div class="mt-12 p-4 bg-white rounded-2xl border border-gray-100 flex justify-center shadow-sm">
                        {{ $dokters->withQueryString()->links() }}
                    </div>
                @endif
            @endif
        </div>
    </main>

</x-guest-master>