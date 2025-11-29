<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Pemeriksaan') }}
    </x-slot>

    <!-- HEADER DEKORATIF (Slim) -->
    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-4xl mx-auto relative z-10">
            <h1 class="text-2xl font-bold text-white mb-1">Hasil Pemeriksaan</h1>
            <p class="text-red-100 text-sm">Rincian diagnosis, tindakan, dan resep obat dari dokter.</p>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-10 pb-12">
        
        <div class="space-y-6">
            
            <!-- 1. KARTU INFORMASI UTAMA (Dokter & Tanggal) -->
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-white p-6 sm:p-8 relative overflow-hidden">
                <!-- Background Pattern Halus -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-full -mr-4 -mt-4 opacity-50 pointer-events-none"></div>

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative z-10">
                    <!-- Info Dokter -->
                    <div class="flex items-center gap-5">
                        <div class="relative">
                            <img class="w-16 h-16 rounded-full object-cover border-4 border-red-50 shadow-sm" 
                                 src="{{ $record->dokter->profile_photo_url }}" 
                                 alt="{{ $record->dokter->name }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($record->dokter->name) }}&background=E5E7EB&color=374151'">
                            <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-red-600 uppercase tracking-wider mb-1">Dokter Pemeriksa</p>
                            <h2 class="text-xl font-bold text-gray-900 leading-tight">{{ $record->dokter->name }}</h2>
                            <p class="text-gray-500 text-sm">{{ $record->dokter->poli->nama_poli ?? 'Dokter Umum' }}</p>
                        </div>
                    </div>

                    <!-- Info Tanggal -->
                    <div class="text-left md:text-right bg-gray-50 md:bg-transparent p-4 md:p-0 rounded-xl md:rounded-none w-full md:w-auto">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tanggal Kunjungan</p>
                        <p class="text-2xl font-extrabold text-gray-800">{{ \Carbon\Carbon::parse($record->tanggal)->format('d M Y') }}</p>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($record->tanggal)->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- 2. DIAGNOSIS & TINDAKAN (Kiri 2/3) -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-white p-6 sm:p-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            Hasil Pemeriksaan
                        </h3>

                        <div class="space-y-8">
                            <!-- Diagnosa -->
                            <div class="relative pl-6 border-l-2 border-red-200">
                                <span class="absolute -left-[5px] top-0 w-2.5 h-2.5 rounded-full bg-red-500 border-2 border-white ring-1 ring-red-200"></span>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Diagnosa Medis</h4>
                                <div class="bg-red-50/50 p-4 rounded-xl border border-red-100">
                                    <p class="text-gray-900 font-medium text-lg leading-relaxed">{{ $record->diagnosis }}</p>
                                </div>
                            </div>

                            <!-- Tindakan -->
                            <div class="relative pl-6 border-l-2 border-blue-200">
                                <span class="absolute -left-[5px] top-0 w-2.5 h-2.5 rounded-full bg-blue-500 border-2 border-white ring-1 ring-blue-200"></span>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Tindakan Dokter</h4>
                                <p class="text-gray-700 leading-relaxed">{{ $record->tindakan }}</p>
                            </div>

                            <!-- Catatan -->
                            @if($record->catatan)
                            <div class="pt-6 border-t border-gray-100">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Catatan Tambahan</h4>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <p class="text-gray-600 italic text-sm">"{{ $record->catatan }}"</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 3. RESEP OBAT (Kanan 1/3) -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-white p-6 h-full flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            Resep Obat
                        </h3>

                        @if($record->prescriptions->count() > 0)
                            <div class="space-y-3 flex-1">
                                @foreach($record->prescriptions as $prescription)
                                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 border border-gray-100 hover:border-green-200 transition-colors group">
                                        <div>
                                            <p class="font-bold text-gray-800 text-sm group-hover:text-green-700 transition-colors">{{ $prescription->medicine->nama }}</p>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-wide">{{ $prescription->medicine->tipe ?? 'Obat' }}</p>
                                        </div>
                                        <span class="text-lg font-extrabold text-green-600">{{ $prescription->jumlah }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 p-4 bg-green-50 rounded-xl text-center border border-green-100">
                                <p class="text-xs text-green-800 font-bold mb-1">Status: Perlu Ditebus</p>
                                <p class="text-[10px] text-green-600">Tunjukkan halaman ini ke Farmasi.</p>
                            </div>
                        @else
                            <div class="text-center py-8 flex-1 flex flex-col justify-center">
                                <div class="bg-gray-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <p class="text-sm text-gray-400">Tidak ada resep obat.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Footer: Tombol Kembali -->
            <div class="flex justify-start pt-4">
                <a href="{{ route('pasien.medical-records.index') }}" class="group flex items-center gap-2 px-6 py-3 bg-white text-gray-600 font-bold rounded-xl border border-gray-200 shadow-sm hover:border-red-200 hover:text-red-700 hover:shadow-md transition-all">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Riwayat
                </a>
            </div>

        </div>
    </div>
</x-app-layout>