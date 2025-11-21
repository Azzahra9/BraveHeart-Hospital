<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Role Selection -->
                        <div>
                            <x-input-label for="role" :value="__('Peran (Role)')" />
                            <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm" onchange="togglePoliDropdown()">
                                <option value="pasien">Pasien</option>
                                <option value="dokter">Dokter</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <!-- Poli Selection (Hidden by Default) -->
                        <div id="poli-container" class="hidden">
                            <x-input-label for="poli_id" :value="__('Spesialis Poli (Wajib untuk Dokter)')" />
                            <select id="poli_id" name="poli_id" class="block mt-1 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm bg-red-50">
                                <option value="">-- Pilih Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">*Pilih poli tempat dokter ini bertugas.</p>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-8">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm" type="password" name="password_confirmation" required />
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 underline">Batal</a>
                        <x-primary-button class="bg-primary hover:bg-red-800">
                            {{ __('Simpan User') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script Sederhana untuk Toggle Poli -->
    <script>
        function togglePoliDropdown() {
            const role = document.getElementById('role').value;
            const poliContainer = document.getElementById('poli-container');
            
            if (role === 'dokter') {
                poliContainer.classList.remove('hidden');
                poliContainer.classList.add('block', 'animate-fade-in');
            } else {
                poliContainer.classList.add('hidden');
                poliContainer.classList.remove('block');
                document.getElementById('poli_id').value = ""; // Reset nilai
            }
        }
    </script>
</x-app-layout>