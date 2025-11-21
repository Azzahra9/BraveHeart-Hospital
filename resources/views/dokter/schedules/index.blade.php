<x-app-layout>
    <x-slot name="header">
        {{ __('Jadwal Praktik Saya') }}
    </x-slot>

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Kelola Waktu Praktik</h2>
            <p class="text-gray-500 text-sm">Atur jadwal ketersediaan Anda untuk pasien.</p>
        </div>
        <a href="{{ route('dokter.schedules.create') }}" class="bg-primary hover:bg-red-800 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-red-900/20 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Grid Jadwal (Card Style) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($schedules as $schedule)
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition relative overflow-hidden group">
            <!-- Dekorasi -->
            <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-full -mr-10 -mt-10 group-hover:bg-red-100 transition"></div>
            
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-red-50 text-primary rounded-xl font-bold text-lg w-14 h-14 flex items-center justify-center shadow-sm">
                        {{ substr($schedule->hari, 0, 3) }}
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('dokter.schedules.edit', $schedule->id) }}" class="text-gray-400 hover:text-blue-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <form action="{{ route('dokter.schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal hari {{ $schedule->hari }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $schedule->hari }}</h3>
                <p class="text-gray-500 text-sm flex items-center gap-2 mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }} - Selesai
                </p>

                <div class="border-t border-gray-100 pt-4 flex justify-between items-center text-sm">
                    <span class="text-gray-400">Durasi Per Pasien</span>
                    <span class="font-bold text-gray-700 bg-gray-100 px-2 py-1 rounded">{{ $schedule->durasi }} Menit</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
            <div class="inline-block p-4 rounded-full bg-gray-50 mb-4 text-gray-400">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Belum Ada Jadwal</h3>
            <p class="text-gray-500 mb-6">Anda belum membuat jadwal praktik apapun.</p>
            <a href="{{ route('dokter.schedules.create') }}" class="text-primary font-bold hover:underline">Buat Jadwal Sekarang &rarr;</a>
        </div>
        @endforelse
    </div>

</x-app-layout>