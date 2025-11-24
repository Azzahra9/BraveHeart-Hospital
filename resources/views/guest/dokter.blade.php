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
    <main class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <!-- Formulir Pencarian Lanjutan -->
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100 -mt-24 relative z-10 mb-12">
                <form action="{{ route('guest.dokter') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        
                        <!-- 1. Pencarian Nama -->
                        <div>
                            <label for="search" class="block text-xs font-bold text-gray-500 mb-1">Nama Dokter</label>
                            <input type="search" name="search" value="{{ $search }}" placeholder="Cari nama..."
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-red-200 p-3 text-sm">
                        </div>

                        <!-- 2. Filter Poli -->
                        <div>
                            <label for="poli_id" class="block text-xs font-bold text-gray-500 mb-1">Poli/Spesialisasi</label>
                            <select name="poli_id" id="poli_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-red-200 p-3 text-sm">
                                <option value="">Semua Poli</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}" {{ $poliId == $poli->id ? 'selected' : '' }}>
                                        {{ $poli->nama_poli }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- 3. Filter Hari -->
                        <div>
                            <label for="hari" class="block text-xs font-bold text-gray-500 mb-1">Hari Praktik</label>
                            <select name="hari" id="hari" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-red-200 p-3 text-sm">
                                <option value="">Semua Hari</option>
                                @foreach($listHari as $h)
                                    <option value="{{ $h }}" {{ $hari == $h ? 'selected' : '' }}>
                                        {{ $h }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- 4. Tombol Aksi -->
                        <div class="flex items-end space-x-3">
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg text-white bg-primary hover:bg-red-800 transition transform hover:scale-[1.02]">
                                Cari Dokter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Bagian Daftar Dokter --}}
            @if ($dokters->isEmpty())
                <div class="text-center py-20 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-xl font-bold text-gray-900">Tidak Ada Dokter Ditemukan</h3>
                    <p class="mt-1 text-gray-500">
                        Coba sesuaikan filter pencarian atau kata kunci.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($dokters as $dokter)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100">
                            {{-- Placeholder/Gambar Dokter --}}
                            <div class="h-48 bg-red-100 flex items-center justify-center p-4 relative">
                                <img src="{{ asset('images/dokter-' . $dokter->id . '.jpeg') }}" 
                                     alt="Foto Dokter {{ $dokter->name }}" 
                                     class="h-full w-full object-cover opacity-90"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x300/fecaca/9f1239?text=Dokter+Jantung';">
                                
                                {{-- Badge Poli --}}
                                <div class="absolute bottom-3 left-3">
                                    <span class="inline-flex items-center rounded-full bg-primary px-3 py-1 text-xs font-bold text-white shadow-md">
                                        {{ $dokter->poli->nama_poli ?? 'Spesialis Umum' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                {{-- Nama Dokter --}}
                                <h2 class="text-xl font-bold text-gray-900 truncate" title="{{ $dokter->name }}">
                                    {{ $dokter->name }}
                                </h2>

                                {{-- Informasi Tambahan --}}
                                <div class="mt-3 space-y-2 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span class="font-medium">Jadwal:</span> {{ $dokter->schedules->count() > 0 ? $dokter->schedules->pluck('hari')->unique()->join(', ') : 'Belum Ada' }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" /></svg>
                                        <span>Pengalaman: 10+ Tahun</span>
                                    </div>
                                </div>
                                
                                {{-- Call to Action --}}
                                <div class="mt-6">
                                    @if(Auth::check() && Auth::user()->role === 'pasien')
                                        <a href="{{ route('pasien.appointments.create', ['dokter_id' => $dokter->id]) }}" 
                                           class="w-full inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-bold rounded-xl shadow-lg text-white bg-primary hover:bg-red-700 transition">
                                            Buat Janji Temu
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="w-full inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-bold rounded-xl shadow-sm text-white bg-gray-500 hover:bg-gray-600 transition">
                                            Login untuk Booking
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination Links --}}
                <div class="mt-10">
                    {{ $dokters->links() }}
                </div>
            @endif
        </div>
    </main>

</x-guest-master>