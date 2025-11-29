<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Jadwal') }}
    </x-slot>

    <!-- HEADER DEKORATIF (Slim) -->
    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-2xl mx-auto relative z-10 text-center">
            <h1 class="text-2xl font-bold text-white mb-1">Jadwal Praktik Baru</h1>
            <p class="text-red-100 text-sm">Tentukan ketersediaan waktu Anda untuk melayani pasien.</p>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 pb-12">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8 relative overflow-hidden">
            
            <!-- Texture Pattern Background -->
            <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>

            <form method="POST" action="{{ route('dokter.schedules.store') }}" class="relative z-10">
                @csrf

                <!-- Hari -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Hari Praktik</label>
                    <div class="relative">
                        <select name="hari" class="w-full appearance-none pl-4 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-700 bg-gray-50 font-medium transition shadow-sm cursor-pointer hover:bg-gray-100">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <!-- Jam Mulai -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jam Mulai</label>
                        <div class="relative">
                            <input type="time" name="jam_mulai" class="w-full pl-10 pr-4 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100" required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1 ml-1">Format 24 Jam (Contoh: 09:00)</p>
                    </div>

                    <!-- Durasi -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Durasi Per Pasien</label>
                        <div class="relative">
                            <input type="number" name="durasi" value="30" min="15" max="120" class="w-full pl-4 pr-16 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100" required>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-xs font-bold uppercase bg-gray-200 px-2 py-1 rounded">Menit</span>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1 ml-1">Estimasi waktu per konsultasi.</p>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <a href="{{ route('dokter.schedules.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-500 hover:text-red-700 hover:bg-red-50 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-bold rounded-xl shadow-lg shadow-red-900/20 hover:shadow-red-900/40 hover:-translate-y-0.5 transition-all transform flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>