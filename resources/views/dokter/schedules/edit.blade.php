<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Jadwal') }}
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="mb-6 border-b border-gray-100 pb-4">
                <h3 class="text-lg font-bold text-gray-900">Edit Jadwal Praktik</h3>
            </div>

            <form method="POST" action="{{ route('dokter.schedules.update', $schedule->id) }}">
                @csrf
                @method('PUT')

                <!-- Hari -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Hari Praktik</label>
                    <select name="hari" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm">
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                            <option value="{{ $hari }}" {{ $schedule->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <!-- Jam Mulai -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai" value="{{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }}" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm" required>
                    </div>

                    <!-- Durasi -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Durasi Per Pasien</label>
                        <div class="relative">
                            <input type="number" name="durasi" value="{{ $schedule->durasi }}" min="15" max="120" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition shadow-sm pr-12" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">Menit</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('dokter.schedules.index') }}" class="text-gray-500 hover:text-gray-900 font-medium text-sm px-4 py-2 rounded-lg hover:bg-gray-100 transition">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-red-800 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg shadow-red-900/20 transition transform hover:-translate-y-0.5">
                        Update Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>