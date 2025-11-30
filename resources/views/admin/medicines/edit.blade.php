<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Obat') }}
    </x-slot>

    <!-- HEADER DEKORATIF (Slim) -->
    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-2xl mx-auto relative z-10 text-center">
            <h1 class="text-2xl font-bold text-white mb-1">Perbarui Data Obat</h1>
            <p class="text-red-100 text-sm">Edit informasi stok dan detail obat.</p>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 pb-12">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8 relative overflow-hidden">
            
            <!-- Texture Pattern Background -->
            <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>

            <form method="POST" action="{{ route('admin.medicines.update', $medicine->id) }}" enctype="multipart/form-data" class="relative z-10 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Obat -->
                <div>
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama Obat</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $medicine->nama) }}" 
                           class="w-full px-4 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100 placeholder-gray-400" 
                           required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tipe Obat -->
                    <div>
                        <label for="tipe" class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                        <div class="relative">
                            <select id="tipe" name="tipe" class="w-full appearance-none pl-4 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-700 bg-gray-50 font-medium transition shadow-sm cursor-pointer hover:bg-gray-100">
                                <option value="biasa" {{ $medicine->tipe == 'biasa' ? 'selected' : '' }}>Biasa</option>
                                <option value="obat keras" {{ $medicine->tipe == 'obat keras' ? 'selected' : '' }}>Obat Keras</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stok" class="block text-sm font-bold text-gray-700 mb-2">Stok Tersedia</label>
                        <div class="relative">
                            <input type="number" id="stok" name="stok" value="{{ old('stok', $medicine->stok) }}" min="0"
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
                              required>{{ old('deskripsi', $medicine->deskripsi) }}</textarea>
                </div>

                <!-- Upload Gambar -->
                <div class="pt-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Produk (Opsional)</label>
                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl bg-gray-50">
                        @if($medicine->gambar)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $medicine->gambar) }}" class="h-16 w-16 object-cover rounded-lg border border-gray-200 shadow-sm" alt="Preview">
                            </div>
                        @else
                            <div class="flex-shrink-0 h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400 border border-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" id="gambar" name="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition cursor-pointer"/>
                            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max 2MB). Biarkan kosong jika tidak diubah.</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-6">
                    <a href="{{ route('admin.medicines.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-500 hover:text-red-700 hover:bg-red-50 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-bold rounded-xl shadow-lg shadow-red-900/20 hover:shadow-red-900/40 hover:-translate-y-0.5 transition-all transform flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Update Obat
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>