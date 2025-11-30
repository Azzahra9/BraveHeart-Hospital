<x-app-layout>
    <x-slot name="header">
        {{ __('Edit User') }}
    </x-slot>

    <!-- HEADER DEKORATIF (Slim) -->
    <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
        <div class="max-w-2xl mx-auto relative z-10 text-center">
            <h1 class="text-2xl font-bold text-white mb-1">Perbarui Data Staf</h1>
            <p class="text-red-100 text-sm">Edit informasi pengguna sistem internal.</p>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 pb-12">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white p-8 relative overflow-hidden">
            
            <!-- Texture Pattern Background -->
            <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="relative z-10 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input id="name" class="w-full px-4 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100 placeholder-gray-400" 
                           type="text" name="name" value="{{ old('name', $user->name) }}" required />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                    <input id="email" class="w-full px-4 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 bg-gray-50 font-medium shadow-sm transition hover:bg-gray-100 placeholder-gray-400" 
                           type="email" name="email" value="{{ old('email', $user->email) }}" required />
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Role Selection -->
                <div>
                    <label for="role" class="block text-sm font-bold text-gray-700 mb-2">Jabatan / Role</label>
                    <div class="relative">
                        <select id="role" name="role" onchange="togglePoli()" class="w-full appearance-none pl-4 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-700 bg-gray-50 font-medium transition shadow-sm cursor-pointer hover:bg-gray-100">
                            <option value="pasien" {{ old('role', $user->role) == 'pasien' ? 'selected' : '' }}>Pasien</option>
                            <option value="dokter" {{ old('role', $user->role) == 'dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Poli Selection (Conditional) -->
                <div id="poli-wrapper" class="{{ old('role', $user->role) == 'dokter' ? '' : 'hidden' }} transition-all duration-300">
                    <label for="poli_id" class="block text-sm font-bold text-gray-700 mb-2">Spesialis Poli <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="poli_id" name="poli_id" class="w-full appearance-none pl-4 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-red-500 focus:border-red-500 text-gray-700 bg-gray-50 font-medium transition shadow-sm cursor-pointer hover:bg-gray-100">
                            <option value="">-- Pilih Poli --</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}" {{ old('poli_id', $user->poli_id) == $poli->id ? 'selected' : '' }}>
                                    {{ $poli->nama_poli }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1 ml-1">Wajib diisi jika role adalah Dokter.</p>
                </div>

                <!-- Ubah Password Section -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Ubah Password (Opsional)
                    </h3>
                    
                    <div class="grid grid-cols-1 gap-4 p-5 bg-gray-50 rounded-2xl border border-gray-200/60">
                        <div>
                            <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Password Baru</label>
                            <input id="password" class="w-full px-3 py-2 border-gray-200 rounded-lg text-sm focus:ring-red-500 focus:border-red-500 bg-white shadow-sm transition" 
                                   type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti" />
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Konfirmasi Password</label>
                            <input id="password_confirmation" class="w-full px-3 py-2 border-gray-200 rounded-lg text-sm focus:ring-red-500 focus:border-red-500 bg-white shadow-sm transition" 
                                   type="password" name="password_confirmation" placeholder="Ulangi password baru" />
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-6">
                    <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-gray-500 hover:text-red-700 hover:bg-red-50 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-red-800 to-red-900 text-white font-bold rounded-xl shadow-lg shadow-red-900/20 hover:shadow-red-900/40 hover:-translate-y-0.5 transition-all transform flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
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
                // Reset selection if hidden
                document.getElementById('poli_id').value = "";
            }
        }
    </script>
</x-app-layout>