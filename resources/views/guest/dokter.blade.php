@extends('layouts.guest')

@section('title', 'Cari Dokter Jantung Terbaik')

@section('content')

    <header class="bg-gray-50 pt-16 pb-10 border-b border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                Dokter Spesialis Jantung
            </h1>
            <p class="mt-4 text-xl text-gray-600 max-w-3xl">
                Temukan dokter spesialis jantung yang paling sesuai dengan kebutuhan Anda. Lihat jadwal dan buat janji temu dengan mudah.
            </p>

            {{-- Formulir Pencarian (Sederhana) --}}
            <form action="{{ route('guest.dokter') }}" method="GET" class="mt-8 max-w-xl">
                <div class="flex space-x-3">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan Nama atau Poli..."
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm p-3">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </header>

    <main class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Bagian Daftar Dokter --}}
            @if ($dokters->isEmpty())
                <div class="text-center py-20">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1-3 3h18l-3-3zm-6 0h6m-3-3v6m-9 1-3 3h18l-3-3z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak Ada Dokter Ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Coba perbesar radius pencarian atau gunakan kata kunci lain.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($dokters as $dokter)
                        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100">
                            {{-- Placeholder/Gambar Dokter --}}
                            <div class="h-48 bg-red-100 flex items-center justify-center p-4">
                                {{-- Gunakan gambar default yang konsisten --}}
                                <img src="{{ asset('img/doctor-placeholder.png') }}" 
                                     alt="Foto Dokter {{ $dokter->name }}" 
                                     class="h-full w-full object-cover rounded-md opacity-80"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x300/fecaca/9f1239?text=Dokter+Jantung';">
                            </div>
                            
                            <div class="p-6">
                                {{-- Nama Dokter --}}
                                <h2 class="text-xl font-bold text-gray-900 truncate" title="{{ $dokter->name }}">
                                    {{ $dokter->name }}
                                </h2>

                                {{-- Poli/Spesialisasi --}}
                                <p class="mt-1">
                                    <span class="inline-flex items-center rounded-full bg-red-50 px-3 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                        {{ $dokter->poli->nama_poli ?? 'Spesialis Jantung Umum' }}
                                    </span>
                                </p>

                                {{-- Informasi Tambahan (Opsional) --}}
                                <div class="mt-4 space-y-2 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span class="font-medium">Jadwal Tersedia:</span> Hari Kerja
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" /></svg>
                                        <span>Pengalaman: 10+ Tahun</span>
                                    </div>
                                </div>
                                
                                {{-- Call to Action --}}
                                <div class="mt-6">
                                    @if(Auth::check() && Auth::user()->role === 'pasien')
                                        <a href="{{ route('pasien.appointments.create', ['dokter_id' => $dokter->id]) }}" 
                                           class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                                            Buat Janji Temu
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition duration-150 ease-in-out">
                                            Login untuk Buat Janji
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

@endsection