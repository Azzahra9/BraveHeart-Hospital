<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Tambahkan enctype="multipart/form-data" untuk upload file -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Bagian Foto Profil (BARU) -->
        <div x-data="{photoName: null, photoPreview: null}">
            <label for="photo" class="block font-medium text-sm text-gray-700">Foto Profil</label>

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-20 w-20 object-cover border-2 border-primary">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <!-- Profile Photo File Input -->
            <input type="file" id="photo" name="photo"
                   class="hidden"
                   x-ref="photo"
                   x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                   " />

            <div class="flex space-x-3 mt-2">
                <x-secondary-button class="cursor-pointer" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Pilih Foto Baru') }}
                </x-secondary-button>
                
                @if (Auth::user()->profile_photo_path)
                    <x-secondary-button type="button" class="cursor-pointer" wire:click="deleteProfilePhoto">
                        {{ __('Hapus Foto') }}
                    </x-secondary-button>
                @endif
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>
        
        <!-- ... (Bagian Nama dan Email di bawah ini tetap sama) ... -->

        <!-- Nama -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Alamat email Anda belum terverifikasi.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Disimpan.') }}</p>
            @endif
        </div>
    </form>
</section>