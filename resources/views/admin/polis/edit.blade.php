<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Poli') }}
    </x-slot>

    <!-- HEADER DEKORATIF (Slim) -->
    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-2xl mx-auto relative z-10 text-center">
            <h1 class="text-2xl font-bold text-white mb-1">Perbarui Informasi Poli</h1>
            <p class="text-red-100 text-sm">Edit detail layanan dan deskripsi poli.</p>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 pb-12">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8 relative overflow-hidden">
            
            <!-- Texture Pattern Background -->
            <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>

            <form method="POST" action="{{ route('admin.polis.update', $poli->id) }}" class="relative z-10 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Poli -->
                <div>
                    <label for="nama_poli" class="block text-sm font-bold text-gray-700 mb-2">Nama Poli</label>
                    <input type="text" id="nama_poli" name="nama_poli" value="{{ old('nama_poli', $poli->nama_poli) }}" 
                           class="w-full px-4 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100 placeholder-gray-400" 
                           placeholder="Contoh: Poli Jantung" required>
                    @error('nama_poli') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" 
                              class="w-full px-4 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100 placeholder-gray-400 leading-relaxed" 
                              placeholder="Jelaskan layanan utama poli ini..." required>{{ old('deskripsi', $poli->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-6">
                    <a href="{{ route('admin.polis.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-500 hover:text-red-700 hover:bg-red-50 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-bold rounded-xl shadow-lg shadow-red-900/20 hover:shadow-red-900/40 hover:-translate-y-0.5 transition-all transform flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Update Poli
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>