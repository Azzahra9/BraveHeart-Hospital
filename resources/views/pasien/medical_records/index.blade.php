<x-app-layout>
    <x-slot name="header">
        {{ __('Riwayat Medis Saya') }}
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        
        <!-- Header Info -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Riwayat Kesehatan</h2>
            <p class="text-gray-500">Akses semua catatan pemeriksaan, diagnosa, dan resep yang diberikan oleh dokter Anda.</p>
        </div>

        @forelse($medicalRecords as $record)
        <!-- CARD REKAM MEDIS -->
        <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-all duration-300">
            
            <div class="flex justify-between items-start border-b border-gray-100 pb-4 mb-4">
                <!-- Kiri: Tanggal & Dokter -->
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Tanggal Kunjungan</span>
                    <!-- Link yang mengarah ke halaman detail resep -->
                    <a href="{{ route('pasien.medical-records.show', $record->id) }}" class="text-xl font-extrabold text-primary hover:underline transition block">
                        {{ \Carbon\Carbon::parse($record->tanggal)->format('d F Y') }}
                    </a>
                    <p class="text-sm text-gray-600 mt-1">Oleh Dr. {{ $record->dokter->name }}</p>
                </div>
                <!-- Kanan: Status -->
                <div class="text-right">
                    <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold border border-green-100">
                        Selesai
                    </span>
                    <p class="text-xs text-gray-400 mt-2">ID Kunjungan: #{{ $record->appointment_id }}</p>
                </div>
            </div>

            <!-- Detail Diagnosa -->
            <div class="mb-6 space-y-4">
                <h3 class="text-lg font-bold text-gray-800 border-b border-red-50/50 pb-2">Diagnosa & Tindakan</h3>
                
                <!-- Diagnosa -->
                <div>
                    <span class="text-xs font-bold text-gray-500 block uppercase">Diagnosa Utama:</span>
                    <p class="text-gray-900 font-medium mt-1">{{ $record->diagnosis }}</p>
                </div>

                <!-- Tindakan -->
                <div>
                    <span class="text-xs font-bold text-gray-500 block uppercase">Tindakan:</span>
                    <p class="text-gray-900 font-medium mt-1">{{ $record->tindakan }}</p>
                </div>
            </div>

            <!-- Detail Resep Obat -->
            @if($record->prescriptions->count() > 0)
                <div class="pt-4 border-t border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Resep Dokter ({{ $record->prescriptions->count() }} Jenis)
                    </h3>
                    
                    <ul class="space-y-2 text-sm bg-gray-50 p-4 rounded-xl border border-gray-100">
                        @foreach($record->prescriptions as $prescription)
                            <li class="flex justify-between items-center border-b border-gray-200 pb-2 last:border-b-0 last:pb-0">
                                <span class="font-medium text-gray-900">{{ $prescription->medicine->nama }}</span>
                                <span class="text-primary font-extrabold">{{ $prescription->jumlah }} Pcs</span>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Link ke Detail Resep (Halaman Show) -->
                    <div class="mt-4 text-right">
                         <a href="{{ route('pasien.medical-records.show', $record->id) }}" class="text-sm font-bold text-primary hover:underline">
                             Lihat Detail Resep &rarr;
                         </a>
                    </div>
                </div>
            @else
                <div class="pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-400 italic">Tidak ada resep obat yang diberikan pada kunjungan ini.</p>
                </div>
            @endif

        </div>
        @empty
        <!-- Jika Belum Ada Rekam Medis -->
        <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-dashed border-gray-300">
            <div class="inline-block p-4 rounded-full bg-red-50 mb-3 text-primary">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Riwayat Medis Anda Kosong</h3>
            <p class="text-gray-500 mb-6">Mulai catat riwayat kesehatan Anda dengan membuat janji temu pertama.</p>
            <a href="{{ route('pasien.appointments.create') }}" class="px-6 py-3 bg-primary text-white font-bold rounded-xl shadow-lg hover:bg-red-800 transition transform hover:-translate-y-0.5">
                Buat Janji Temu Sekarang
            </a>
        </div>
        @endforelse
        
        <div class="mt-8">
            {{ $medicalRecords->links() }}
        </div>
    </div>

</x-app-layout>