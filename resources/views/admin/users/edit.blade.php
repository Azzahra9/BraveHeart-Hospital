<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="role" :value="__('Role')" />
                        <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" onchange="togglePoli()">
                            <option value="pasien" {{ $user->role == 'pasien' ? 'selected' : '' }}>Pasien</option>
                            <option value="dokter" {{ $user->role == 'dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div id="poli-wrapper" class="mb-4 {{ $user->role == 'dokter' ? '' : 'hidden' }}">
                        <x-input-label for="poli_id" :value="__('Spesialis Poli')" />
                        <select id="poli_id" name="poli_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Poli --</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}" {{ $user->poli_id == $poli->id ? 'selected' : '' }}>
                                    {{ $poli->nama_poli }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded border">
                        <h3 class="text-sm font-bold text-gray-700 mb-2">Ubah Password (Opsional)</h3>
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Password Baru (Kosongkan jika tidak ganti)')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                        </div>
                        <div class="mb-2">
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                        <x-primary-button>
                            {{ __('Update User') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
    <script>
        function togglePoli() {
            const role = document.getElementById('role').value;
            const poliWrapper = document.getElementById('poli-wrapper');
            if (role === 'dokter') {
                poliWrapper.classList.remove('hidden');
            } else {
                poliWrapper.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>