<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Obat Baru') }}
    </x-slot>

    <!-- HEADER DEKORATIF (Slim) -->
    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-2xl mx-auto relative z-10 text-center">
            <h1 class="text-2xl font-bold text-white mb-1">Tambah Obat Baru</h1>
            <p class="text-red-100 text-sm">Masukkan informasi lengkap mengenai obat baru.</p>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 pb-12">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8 relative overflow-hidden">
            
            <!-- Texture Pattern Background -->
            <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>

            <form method="POST" action="{{ route('admin.medicines.store') }}" enctype="multipart/form-data" class="relative z-10 space-y-6">
                @csrf

                <!-- Nama Obat -->
                <div>
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama Obat</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" 
                           class="w-full px-4 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100 placeholder-gray-400" 
                           placeholder="Contoh: Paracetamol 500mg" required autofocus>
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tipe Obat -->
                    <div>
                        <label for="tipe" class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                        <div class="relative">
                            <select id="tipe" name="tipe" class="w-full appearance-none pl-4 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-700 bg-gray-50 font-medium transition shadow-sm cursor-pointer hover:bg-gray-100">
                                <option value="biasa">Biasa</option>
                                <option value="obat keras">Obat Keras</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stok" class="block text-sm font-bold text-gray-700 mb-2">Stok Awal</label>
                        <div class="relative">
                            <input type="number" id="stok" name="stok" value="{{ old('stok', 0) }}" min="0"
                                   class="w-full pl-4 pr-16 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-xs font-bold uppercase bg-gray-200 px-2 py-1 rounded">Unit</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi / Indikasi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" 
                              class="w-full px-4 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100 placeholder-gray-400 leading-relaxed" 
                              placeholder="Jelaskan kegunaan dan dosis obat..." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Upload Gambar -->
                <div class="pt-2">
                    <label for="gambar" class="block text-sm font-bold text-gray-700 mb-2">Foto Obat (Opsional)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="gambar" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-red-50 hover:border-red-200 transition group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-2 text-gray-400 group-hover:text-red-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-1 text-xs text-gray-500 group-hover:text-red-600"><span class="font-bold">Klik untuk upload</span> atau drag and drop</p>
                                <p class="text-[10px] text-gray-400">JPG, PNG, GIF (Max 2MB)</p>
                            </div>
                            <input id="gambar" name="gambar" type="file" class="hidden" />
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-6">
                    <a href="{{ route('admin.medicines.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-500 hover:text-red-700 hover:bg-red-50 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-bold rounded-xl shadow-lg shadow-red-900/20 hover:shadow-red-900/40 hover:-translate-y-0.5 transition-all transform flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Simpan Obat
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>