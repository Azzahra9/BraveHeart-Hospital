<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Poli') }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            
            <div class="mb-6 border-b border-gray-100 pb-4 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Edit Poli</h3>
                    <p class="text-sm text-gray-500">Perbarui informasi poli yang sudah ada.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.polis.update', $poli->id) }}">
                @csrf
                @method('PUT')

                <!-- Nama Poli -->
                <div class="mb-6">
                    <label for="nama_poli" class="block text-sm font-bold text-gray-700 mb-1">Nama Poli</label>
                    <input type="text" id="nama_poli" name="nama_poli" value="{{ old('nama_poli', $poli->nama_poli) }}" 
                           class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm" 
                           required>
                    @error('nama_poli') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-8">
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" 
                              class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm" 
                              required>{{ old('deskripsi', $poli->deskripsi) }}</textarea>
                    @error('deskripsi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.polis.index') }}" class="text-gray-500 hover:text-gray-900 font-medium text-sm px-4 py-2 rounded-lg hover:bg-gray-100 transition">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-red-800 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg shadow-red-900/20 transition transform hover:-translate-y-0.5">
                        Update Poli
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>