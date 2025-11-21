<x-guest-layout>
    <!-- Judul Halaman -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h2>
        <p class="text-sm text-gray-500 mt-1">Silakan masuk untuk mengakses akun Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition duration-200 shadow-sm p-2.5 bg-gray-50" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
            <input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-red-200 transition duration-200 shadow-sm p-2.5 bg-gray-50" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4 mb-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-3 bg-primary border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-red-900/30">
                {{ __('Masuk Sekarang') }}
            </button>
        </div>

        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-primary hover:underline">Daftar Pasien Baru</a>
        </div>
    </form>
</x-guest-layout>