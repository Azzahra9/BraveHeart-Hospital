<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Resep') }}
    </x-slot>

    <div class="max-w-xl mx-auto space-y-8">
        
        <!-- Header & Info Kunjungan -->
        <div class="bg-gradient-to-r from-primary to-red-900 rounded-3xl p-8 text-white shadow-xl">
            <p class="text-red-200 text-sm uppercase tracking-wider font-bold mb-1">Kunjungan Tanggal</p>
            <h2 class="text-3xl font-extrabold mb-2">{{ \Carbon\Carbon::parse($record->tanggal)->format('d F Y') }}</h2>
            <p class="text-red-100">Dokter: {{ $record->dokter->name }} ({{ $record->dokter->poli->nama_poli ?? 'Umum' }})</p>
        </div>

        <!-- Detail Diagnosa -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-red-50 text-primary flex items-center justify-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></span>
                Diagnosa Dokter
            </h3>
            
            <div class="space-y-4 pt-4 border-t border-gray-100">
                <div>
                    <span class="text-xs font-bold text-gray-500 block uppercase">Diagnosa Utama:</span>
                    <p class="text-gray-900 font-medium mt-1">{{ $record->diagnosis }}</p>
                </div>
                <div>
                    <span class="text-xs font-bold text-gray-500 block uppercase">Tindakan:</span>
                    <p class="text-gray-900 font-medium mt-1">{{ $record->tindakan }}</p>
                </div>
                @if($record->catatan)
                <div>
                    <span class="text-xs font-bold text-gray-500 block uppercase">Catatan Tambahan:</span>
                    <p class="text-gray-600 italic mt-1">{{ $record->catatan }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Detail Resep Obat -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg></span>
                Resep Obat
            </h3>
            
            @if($record->prescriptions->count() > 0)
                <ul class="space-y-3 pt-4 border-t border-gray-100">
                    @foreach($record->prescriptions as $prescription)
                        <li class="flex justify-between items-center bg-gray-50 p-3 rounded-xl">
                            <div>
                                <span class="font-bold text-gray-900">{{ $prescription->medicine->nama }}</span>
                                <p class="text-xs text-gray-500">{{ $prescription->medicine->tipe }}</p>
                            </div>
                            <span class="text-2xl font-extrabold text-primary">{{ $prescription->jumlah }} Pcs</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm italic pt-4 border-t border-gray-100">Tidak ada resep obat yang diberikan.</p>
            @endif
        </div>

        <div class="flex justify-start pt-4">
            <a href="{{ route('pasien.medical-records.index') }}" class="text-gray-600 hover:text-primary font-bold transition flex items-center gap-1">
                ← Kembali ke Riwayat
            </a>
        </div>
    </div>

</x-app-layout>