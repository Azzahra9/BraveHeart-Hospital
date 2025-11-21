<x-guest-layout>
    <!-- Judul Halaman -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Buat Akun Pasien</h2>
        <p class="text-sm text-gray-500 mt-1">Daftar untuk membuat janji temu dengan mudah</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
            <input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition duration-200 shadow-sm p-2.5 bg-gray-50" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition duration-200 shadow-sm p-2.5 bg-gray-50" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
            <input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition duration-200 shadow-sm p-2.5 bg-gray-50" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition duration-200 shadow-sm p-2.5 bg-gray-50" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-3 bg-primary border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-red-900/30">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>

        <div class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a class="underline text-sm text-primary hover:text-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary font-bold" href="{{ route('login') }}">
                {{ __('Masuk di sini') }}
            </a>
        </div>
    </form>
</x-guest-layout>