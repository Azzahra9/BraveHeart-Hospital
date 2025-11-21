<x-app-layout>
    <x-slot name="header">
        {{ __('Manajemen Obat') }}
    </x-slot>

    <!-- Statistik Stok (Opsional) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Jenis Obat</p>
                <p class="text-2xl font-bold text-gray-900">{{ $medicines->total() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Daftar Obat & Stok</h3>
                <p class="text-sm text-gray-500">Kelola inventaris obat-obatan rumah sakit.</p>
            </div>
            <a href="{{ route('admin.medicines.create') }}" class="bg-primary hover:bg-red-800 text-white font-bold py-2.5 px-5 rounded-lg shadow-lg shadow-red-900/20 transition duration-300 flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Obat
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Gambar</th>
                        <th class="px-6 py-4">Nama Obat</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4 text-center">Stok</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($medicines as $medicine)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            @if($medicine->gambar)
                                <img src="{{ asset('storage/' . $medicine->gambar) }}" alt="{{ $medicine->nama }}" class="h-12 w-12 rounded-lg object-cover border border-gray-200">
                            @else
                                <div class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">
                            {{ $medicine->nama }}
                            <p class="text-xs text-gray-400 font-normal mt-0.5 truncate max-w-xs">{{ $medicine->deskripsi }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($medicine->tipe == 'obat keras')
                                <span class="px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-700 uppercase">Obat Keras</span>
                            @else
                                <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-700 uppercase">Biasa</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center font-mono font-bold {{ $medicine->stok < 10 ? 'text-red-600' : 'text-gray-700' }}">
                            {{ $medicine->stok }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.medicines.edit', $medicine->id) }}" class="p-2 text-gray-500 hover:text-primary hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" onsubmit="return confirm('Hapus obat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $medicines->links() }}
        </div>
    </div>
</x-app-layout>