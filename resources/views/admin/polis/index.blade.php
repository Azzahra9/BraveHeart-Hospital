<x-app-layout>
    <x-slot name="header">
        {{ __('Manajemen Poli') }}
    </x-slot>

    <!-- Statistik Ringkas (Opsional, biar keren) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-red-50 rounded-full text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Poli</p>
                <p class="text-2xl font-bold text-gray-900">{{ $polis->total() }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Daftar Poli & Layanan</h3>
                <p class="text-sm text-gray-500">Kelola spesialisasi dan unit layanan rumah sakit.</p>
            </div>
            <a href="{{ route('admin.polis.create') }}" class="bg-primary hover:bg-red-800 text-white font-bold py-2.5 px-5 rounded-lg shadow-lg shadow-red-900/20 transition duration-300 flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Poli Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Nama Poli</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-center">Tim Dokter</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($polis as $poli)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold text-gray-900">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded bg-red-50 text-primary flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                {{ $poli->nama_poli }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                            {{ $poli->deskripsi }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-50 text-blue-600">
                                {{ $poli->dokters->count() }} Dokter
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.polis.edit', $poli->id) }}" class="p-2 text-gray-500 hover:text-primary hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('admin.polis.destroy', $poli->id) }}" method="POST" onsubmit="return confirm('Hapus poli ini?');">
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
            {{ $polis->links() }}
        </div>
    </div>
</x-app-layout>