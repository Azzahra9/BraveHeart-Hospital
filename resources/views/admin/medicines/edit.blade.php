<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Obat') }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            
            <div class="mb-6 border-b border-gray-100 pb-4">
                <h3 class="text-lg font-bold text-gray-900">Edit Obat</h3>
                <p class="text-sm text-gray-500">Perbarui informasi stok atau detail obat.</p>
            </div>

            <form method="POST" action="{{ route('admin.medicines.update', $medicine->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Obat -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-1">Nama Obat</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $medicine->nama) }}" 
                           class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm" 
                           required>
                </div>

                <!-- Tipe & Stok -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="tipe" class="block text-sm font-bold text-gray-700 mb-1">Tipe Obat</label>
                        <select id="tipe" name="tipe" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm">
                            <option value="biasa" {{ $medicine->tipe == 'biasa' ? 'selected' : '' }}>Biasa</option>
                            <option value="obat keras" {{ $medicine->tipe == 'obat keras' ? 'selected' : '' }}>Obat Keras</option>
                        </select>
                    </div>
                    <div>
                        <label for="stok" class="block text-sm font-bold text-gray-700 mb-1">Stok Saat Ini</label>
                        <input type="number" id="stok" name="stok" value="{{ old('stok', $medicine->stok) }}" min="0"
                               class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-1">Deskripsi / Indikasi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" 
                              class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm" 
                              required>{{ old('deskripsi', $medicine->deskripsi) }}</textarea>
                </div>

                <!-- Upload Gambar -->
                <div class="mb-8">
                    <label for="gambar" class="block text-sm font-bold text-gray-700 mb-1">Ganti Foto (Opsional)</label>
                    @if($medicine->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $medicine->gambar) }}" class="h-20 w-20 object-cover rounded-lg border">
                        </div>
                    @endif
                    <input type="file" id="gambar" name="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-primary hover:file:bg-red-100 transition"/>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.medicines.index') }}" class="text-gray-500 hover:text-gray-900 font-medium text-sm px-4 py-2 rounded-lg hover:bg-gray-100 transition">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-red-800 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg shadow-red-900/20 transition transform hover:-translate-y-0.5">
                        Update Obat
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>