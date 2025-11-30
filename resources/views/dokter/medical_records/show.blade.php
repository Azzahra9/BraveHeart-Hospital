<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Rekam Medis') }}
    </x-slot>

    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-6xl mx-auto relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-white mb-3">Laporan Pemeriksaan</h1>
                
                <div class="flex items-center gap-4 text-red-50 text-sm font-medium">
                    <span class="bg-white/20 px-3 py-1 rounded-lg border border-white/10 tracking-wide">
                        #MR-{{ $medicalRecord->id }}
                    </span>
                    <span>{{ \Carbon\Carbon::parse($medicalRecord->tanggal)->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
            
            <!-- Tombol Kembali -->
            <a href="{{ route('dokter.appointments.index') }}" class="group bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition flex items-center gap-2">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 pb-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- KOLOM KIRI: DATA PASIEN -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-6 relative overflow-hidden">
                    <!-- Decor -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-full -mr-10 -mt-10 pointer-events-none"></div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="h-24 w-24 rounded-full p-1.5 bg-white border border-gray-100 shadow-md mb-4">
                            <img src="{{ $medicalRecord->pasien->profile_photo_url }}" 
                                 alt="{{ $medicalRecord->pasien->name }}" 
                                 class="h-full w-full object-cover rounded-full"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($medicalRecord->pasien->name) }}&background=E5E7EB&color=374151'">
                        </div>
                        
                        <h2 class="text-lg font-bold text-gray-900">{{ $medicalRecord->pasien->name }}</h2>
                        <p class="text-sm text-gray-500 mb-4">{{ $medicalRecord->pasien->email }}</p>

                        <div class="w-full bg-gray-50 rounded-2xl p-5 border border-gray-100 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">ID Pasien</span>
                                <span class="font-bold text-gray-800">#PAT-{{ $medicalRecord->pasien->id }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">No. HP</span>
                                <span class="font-bold text-gray-800">{{ $medicalRecord->pasien->phone ?? '-' }}</span>
                            </div>
                            <div class="pt-3 border-t border-gray-200 mt-2">
                                <p class="text-xs text-gray-400 uppercase tracking-wide mb-2 text-left font-bold">Keluhan Awal</p>
                                <!-- Menghapus italic, memperjelas font -->
                                <p class="text-sm text-gray-800 text-left bg-white p-3 rounded-xl border border-gray-200 leading-relaxed">
                                    {{ $medicalRecord->appointment->keluhan ?? 'Tidak ada data' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Dokter (Card Kecil) -->
                <div class="bg-white rounded-[2rem] shadow-lg shadow-gray-200/50 border border-white p-6 flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-bold">Pemeriksa</p>
                        <p class="font-bold text-gray-900 text-sm">Dr. {{ $medicalRecord->dokter->name }}</p>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: HASIL MEDIS & RESEP -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- 1. DIAGNOSIS & TINDAKAN -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                        <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        Hasil Pemeriksaan
                    </h3>

                    <div class="space-y-8">
                        <!-- Diagnosa -->
                        <div class="relative pl-6 border-l-2 border-red-200">
                            <span class="absolute -left-[5px] top-0 w-2.5 h-2.5 rounded-full bg-red-500 border-2 border-white ring-1 ring-red-200"></span>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Diagnosa Dokter</h4>
                            <div class="bg-red-50/50 p-5 rounded-2xl border border-red-100">
                                <p class="text-gray-900 font-medium text-base leading-relaxed">{{ $medicalRecord->diagnosis }}</p>
                            </div>
                        </div>

                        <!-- Tindakan -->
                        <div class="relative pl-6 border-l-2 border-blue-200">
                            <span class="absolute -left-[5px] top-0 w-2.5 h-2.5 rounded-full bg-blue-500 border-2 border-white ring-1 ring-blue-200"></span>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Tindakan Medis</h4>
                            <p class="text-gray-700 leading-relaxed text-sm">{{ $medicalRecord->tindakan }}</p>
                        </div>

                        <!-- Catatan -->
                        @if($medicalRecord->catatan)
                        <div class="pt-4 mt-2">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Catatan Tambahan</h4>
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 relative">
                                <svg class="absolute top-4 left-3 w-4 h-4 text-gray-300 transform -scale-x-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9C9.93813 16.2352 11.2658 16.9081 12.2925 18.2323C12.9298 19.0539 13.5284 20.0078 14.017 21ZM5 21C5.48855 20.0078 6.08717 19.0539 6.72449 18.2323C7.75122 16.9081 9.07887 16.2352 10.017 16H7.017C5.91243 16 5.017 16.8954 5.017 18L5 21ZM19 21C18.5115 20.0078 17.9128 19.0539 17.2755 18.2323C16.2488 16.9081 14.9211 16.2352 13.983 16H16.983C18.0876 16 18.983 16.8954 18.983 18L19 21Z"></path></svg>
                                <!-- Menghapus italic -->
                                <p class="text-gray-700 text-sm pl-6">{{ $medicalRecord->catatan }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- 2. RESEP OBAT -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                        <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        Resep Obat
                        <span class="ml-auto text-xs font-bold bg-green-50 text-green-700 px-3 py-1 rounded-full border border-green-100">{{ $medicalRecord->prescriptions->count() }} Item</span>
                    </h3>

                    @if($medicalRecord->prescriptions->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400 text-sm">Tidak ada resep obat untuk pemeriksaan ini.</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($medicalRecord->prescriptions as $resep)
                                <div class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 border border-gray-100 hover:border-green-200 transition-colors group">
                                    <div>
                                        <p class="font-bold text-gray-900 text-sm group-hover:text-green-700 transition-colors">{{ $resep->medicine->nama ?? 'Obat Terhapus' }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[10px] uppercase tracking-wide font-bold text-gray-500 bg-white px-2 py-0.5 rounded border border-gray-200">{{ $resep->medicine->tipe ?? '-' }}</span>
                                            @if(!$resep->medicine)
                                                <span class="text-[10px] text-red-500">Data obat tidak ditemukan</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="block text-base font-bold text-green-600">{{ $resep->jumlah }}</span>
                                        <span class="text-[10px] text-gray-400 font-medium">Qty</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 text-center">
                            <p class="text-[10px] text-gray-400 font-medium">Pastikan pasien menebus resep di instalasi farmasi.</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>