<x-app-layout>
    <x-slot name="header">
        {{ __('Pemeriksaan Pasien') }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        
        <!-- Info Pasien (Header Card) -->
        <div class="bg-gradient-to-r from-primary to-red-900 rounded-3xl p-8 text-white shadow-xl mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
            
            <div class="relative z-10 flex justify-between items-start">
                <div>
                    <p class="text-red-200 text-sm uppercase tracking-wider font-bold mb-1">Sedang Memeriksa</p>
                    <h2 class="text-3xl font-extrabold">{{ $appointment->pasien->name }}</h2>
                    <p class="text-red-100 mt-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($appointment->tanggal_booking)->translatedFormat('l, d F Y') }}
                    </p>
                </div>
                <div class="text-right bg-white/10 p-4 rounded-2xl backdrop-blur-sm border border-white/10">
                    <p class="text-xs text-red-200 uppercase tracking-wide">Keluhan Utama</p>
                    <p class="font-bold text-lg">"{{ $appointment->keluhan }}"</p>
                </div>
            </div>
        </div>

        <!-- Form Rekam Medis -->
        <form method="POST" action="{{ route('dokter.medical-records.store') }}">
            @csrf
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                
                <!-- 1. Diagnosa & Tindakan -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-red-50 text-primary flex items-center justify-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></span>
                        Hasil Pemeriksaan
                    </h3>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Diagnosis Dokter</label>
                            <textarea name="diagnosis" rows="3" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm" placeholder="Contoh: Hipertensi tingkat 1..." required></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tindakan Medis</label>
                            <textarea name="tindakan" rows="3" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm" placeholder="Contoh: Pemberian obat penurun darah tinggi, edukasi pola makan..." required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                            <textarea name="catatan" rows="2" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm" placeholder="Catatan khusus untuk pasien..."></textarea>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100 mb-8">

                <!-- 2. Resep Obat -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg></span>
                            Resep Obat
                        </h3>
                        <button type="button" onclick="addMedicineRow()" class="text-sm font-bold text-primary hover:bg-red-50 px-3 py-1.5 rounded-lg transition border border-transparent hover:border-red-100">
                            + Tambah Obat
                        </button>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <div id="medicine-container">
                            <!-- Baris Obat Default -->
                            <div class="grid grid-cols-12 gap-4 mb-3 medicine-row">
                                <div class="col-span-8">
                                    <select name="medicines[]" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-red-200 text-sm">
                                        <option value="">-- Pilih Obat --</option>
                                        @foreach($medicines as $medicine)
                                            <option value="{{ $medicine->id }}">{{ $medicine->nama }} (Stok: {{ $medicine->stok }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-3">
                                    <input type="number" name="quantities[]" placeholder="Jml" min="1" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-red-200 text-sm">
                                </div>
                                <div class="col-span-1 flex items-center justify-center">
                                    <button type="button" onclick="removeRow(this)" class="text-gray-400 hover:text-red-500 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2 italic">*Kosongkan jika tidak memberikan obat.</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('dokter.appointments.index') }}" class="px-6 py-3 rounded-xl text-gray-500 hover:bg-gray-50 font-bold text-sm transition">Batal</a>
                    <button type="submit" class="px-8 py-3 bg-primary text-white font-bold rounded-xl shadow-lg hover:bg-red-800 hover:shadow-red-900/30 transition transform hover:-translate-y-0.5">
                        Simpan & Selesai
                    </button>
                </div>

            </div>
        </form>
    </div>

    <!-- JavaScript Sederhana untuk Tambah Row Obat -->
    <script>
        function addMedicineRow() {
            const container = document.getElementById('medicine-container');
            const row = document.querySelector('.medicine-row').cloneNode(true);
            
            // Reset nilai input pada row baru
            row.querySelector('select').value = "";
            row.querySelector('input').value = "";
            
            container.appendChild(row);
        }

        function removeRow(btn) {
            const row = btn.closest('.medicine-row');
            // Jangan hapus jika itu satu-satunya baris
            if (document.querySelectorAll('.medicine-row').length > 1) {
                row.remove();
            } else {
                // Jika satu-satunya, reset saja nilainya
                row.querySelector('select').value = "";
                row.querySelector('input').value = "";
            }
        }
    </script>
</x-app-layout>