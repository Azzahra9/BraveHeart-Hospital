<x-app-layout>
    <x-slot name="header">
        {{ __('Pemeriksaan Pasien') }}
    </x-slot>

    <!-- HEADER DEKORATIF (Slim) -->
    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-5xl mx-auto relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white mb-1">Pemeriksaan Medis</h1>
                <p class="text-red-100 text-sm">Isi hasil diagnosa dan resep obat untuk pasien.</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-2xl text-right hidden md:block">
                <p class="text-[10px] text-red-200 uppercase tracking-wider font-bold">Tanggal Kunjungan</p>
                <p class="text-white font-bold">{{ \Carbon\Carbon::parse($appointment->tanggal_booking)->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 pb-12">
        
        <form method="POST" action="{{ route('dokter.medical-records.store') }}">
            @csrf
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

            <div class="space-y-6">
                
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 rounded-full p-1 bg-red-50 border border-red-100">
                                <img src="{{ $appointment->pasien->profile_photo_url }}" 
                                     alt="{{ $appointment->pasien->name }}" 
                                     class="w-full h-full object-cover rounded-full"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($appointment->pasien->name) }}&background=E5E7EB&color=374151'">
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">{{ $appointment->pasien->name }}</h2>
                                    <p class="text-gray-500 text-sm">Pasien Umum • #PAT-{{ $appointment->pasien->id }}</p>
                                </div>
                                <span class="px-4 py-1.5 bg-orange-50 text-orange-600 rounded-full text-xs font-bold border border-orange-100 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                                    Sedang Diperiksa
                                </span>
                            </div>
                            <div class="bg-red-50/50 rounded-2xl p-5 border border-red-100">
                                <p class="text-xs font-bold text-red-400 uppercase tracking-wider mb-1">Keluhan Utama</p>
                                <p class="text-gray-800 font-medium text-lg leading-relaxed">"{{ $appointment->keluhan }}"</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                        <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        Hasil Pemeriksaan
                    </h3>

                    <div class="space-y-6">
                        <!-- Diagnosis -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Diagnosis Dokter <span class="text-red-500">*</span></label>
                            <textarea name="diagnosis" rows="3" class="w-full border-gray-200 rounded-xl focus:ring-red-500 focus:border-red-500 bg-gray-50/50 text-sm placeholder-gray-400 p-4 transition shadow-sm" placeholder="Contoh: Hipertensi tingkat 1, Infeksi saluran pernapasan..." required></textarea>
                        </div>

                        <!-- Tindakan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tindakan Medis <span class="text-red-500">*</span></label>
                            <textarea name="tindakan" rows="3" class="w-full border-gray-200 rounded-xl focus:ring-red-500 focus:border-red-500 bg-gray-50/50 text-sm placeholder-gray-400 p-4 transition shadow-sm" placeholder="Contoh: Pemberian obat penurun darah tinggi, edukasi pola makan..." required></textarea>
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                            <div class="relative">
                                <textarea name="catatan" rows="2" class="w-full border-gray-200 rounded-xl focus:ring-red-500 focus:border-red-500 bg-gray-50/50 text-sm placeholder-gray-400 p-4 transition shadow-sm" placeholder="Catatan khusus untuk pasien..."></textarea>
                                <div class="absolute top-4 right-4 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. RESEP OBAT -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            Resep Obat
                        </h3>
                        <button type="button" onclick="addMedicineRow()" class="group flex items-center gap-1.5 px-4 py-2 bg-green-50 text-green-700 text-xs font-bold rounded-xl border border-green-200 hover:bg-green-100 transition shadow-sm">
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Obat
                        </button>
                    </div>

                    <div class="bg-gray-50/50 rounded-2xl p-5 border border-gray-200/60">
                        <div id="medicine-container" class="space-y-3">
                            <!-- Baris Obat Default -->
                            <div class="grid grid-cols-12 gap-3 medicine-row items-start">
                                <div class="col-span-8 sm:col-span-8">
                                    <div class="relative">
                                        <select name="medicines[]" class="w-full pl-4 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-white shadow-sm appearance-none cursor-pointer">
                                            <option value="">-- Pilih Obat --</option>
                                            @foreach($medicines as $medicine)
                                                <option value="{{ $medicine->id }}">{{ $medicine->nama }} (Stok: {{ $medicine->stok }})</option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <input type="number" name="quantities[]" placeholder="Qty" min="1" class="w-full py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-white shadow-sm text-center">
                                </div>
                                <div class="col-span-1 flex items-center justify-center pt-2">
                                    <button type="button" onclick="removeRow(this)" class="w-8 h-8 flex items-center justify-center rounded-full bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-4 italic flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Biarkan kosong jika pasien tidak memerlukan resep obat.
                        </p>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('dokter.appointments.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-bold rounded-xl shadow-lg shadow-red-900/20 hover:shadow-red-900/40 hover:-translate-y-0.5 transition-all transform flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan & Selesai
                    </button>
                </div>

            </div>
        </form>
    </div>

    <script>
        function addMedicineRow() {
            const container = document.getElementById('medicine-container');
            const row = document.querySelector('.medicine-row').cloneNode(true);
            
            row.querySelector('select').value = "";
            row.querySelector('input').value = "";
            
            container.appendChild(row);
        }

        function removeRow(btn) {
            const row = btn.closest('.medicine-row');
            if (document.querySelectorAll('.medicine-row').length > 1) {
                row.remove();
            } else {
                row.querySelector('select').value = "";
                row.querySelector('input').value = "";
            }
        }
    </script>
</x-app-layout>