<x-app-layout>
    <x-slot name="header">
        {{ __('Riwayat Medis Saya') }}
    </x-slot>

    <!-- HEADER DEKORATIF (Slim & Aesthetic) -->
    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-5xl mx-auto relative z-10">
            <h1 class="text-2xl font-bold text-white mb-1">Riwayat Kesehatan</h1>
            <p class="text-red-100 text-sm">Arsip digital pemeriksaan, diagnosis, dan resep obat Anda.</p>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-10 pb-12">
        
        @if($medicalRecords->isEmpty())
            <!-- EMPTY STATE -->
            <div class="bg-white rounded-3xl p-12 text-center shadow-xl shadow-gray-200/50 border border-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-6 text-red-800">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Riwayat Medis Kosong</h3>
                    <p class="text-gray-500 mb-8 max-w-md">Belum ada catatan medis yang tersimpan. Mulai perjalanan kesehatan Anda dengan membuat janji temu.</p>
                    <a href="{{ route('pasien.appointments.create') }}" class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-bold rounded-xl shadow-lg shadow-red-900/20 hover:shadow-red-900/40 hover:-translate-y-1 transition-all duration-300">
                        Buat Janji Temu Sekarang
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-8">
                @foreach($medicalRecords as $record)
                <!-- CARD REKAM MEDIS -->
                <div class="group bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-white hover:border-red-100 transition-all duration-300 overflow-hidden relative">
                    
                    <!-- Decorative Side Line -->
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-red-600 to-red-900"></div>

                    <!-- Header Card -->
                    <div class="p-6 sm:p-8 border-b border-gray-100 bg-gray-50/30">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <img class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md" 
                                         src="{{ $record->dokter->profile_photo_url }}" 
                                         alt="{{ $record->dokter->name }}"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($record->dokter->name) }}&background=E5E7EB&color=374151'">
                                    <div class="absolute -bottom-1 -right-1 bg-red-600 text-white p-1 rounded-full border-2 border-white">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Dokter Pemeriksa</p>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $record->dokter->name }}</h3>
                                    <p class="text-sm text-red-700 font-medium">{{ $record->dokter->poli->nama_poli ?? 'Spesialis' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex flex-col items-end">
                                <span class="px-4 py-1.5 rounded-full bg-green-50 text-green-700 text-xs font-bold border border-green-100 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                    Selesai
                                </span>
                                <div class="mt-2 text-right">
                                    <p class="text-xl font-extrabold text-gray-800">{{ \Carbon\Carbon::parse($record->tanggal)->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-400">ID: #MR-{{ $record->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Kolom Diagnosa -->
                        <div class="space-y-6">
                            <div class="relative pl-4 border-l-2 border-red-100">
                                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1">Diagnosa Medis</h4>
                                <p class="text-lg font-bold text-gray-800 leading-relaxed">{{ $record->diagnosis }}</p>
                            </div>
                            
                            <div class="relative pl-4 border-l-2 border-blue-100">
                                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wide mb-1">Tindakan / Catatan</h4>
                                <p class="text-base text-gray-600 leading-relaxed">{{ $record->tindakan }}</p>
                            </div>
                        </div>

                        <!-- Kolom Resep -->
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <div class="flex items-center justify-between mb-4 border-b border-gray-200 pb-2">
                                <h4 class="font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                    Resep Obat
                                </h4>
                                <span class="text-xs font-bold bg-white px-2 py-1 rounded border border-gray-200">{{ $record->prescriptions->count() }} Item</span>
                            </div>

                            @if($record->prescriptions->count() > 0)
                                <ul class="space-y-3">
                                    @foreach($record->prescriptions as $prescription)
                                    <li class="flex items-start justify-between text-sm group/item">
                                        <div class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-300 mt-1.5 group-hover/item:bg-red-600 transition-colors"></span>
                                            <span class="text-gray-700 font-medium">{{ $prescription->medicine->nama }}</span>
                                        </div>
                                        <span class="font-bold text-gray-900 bg-white px-2 py-0.5 rounded border border-gray-100 shadow-sm">{{ $prescription->jumlah }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-xs text-gray-400 italic">Tidak ada resep obat.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="px-6 sm:px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                        <a href="{{ route('pasien.medical-records.show', $record->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-red-800 hover:text-red-900 group/link">
                            Lihat Detail Lengkap
                            <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $medicalRecords->links() }}
            </div>
        @endif
    </div>
</x-app-layout>