<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BraveHeart Hospital') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- CDN Tailwind (Jalur Tol) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#991B1B', // Maroon
                            secondary: '#FEE2E2', // Pink Muda
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Background Gradient Senada dengan Home -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-red-50 via-white to-red-100 relative overflow-hidden">
            
            <!-- Dekorasi Background -->
            <div class="absolute top-0 left-0 -ml-20 -mt-20 w-72 h-72 bg-red-200 rounded-full blur-3xl opacity-30"></div>
            <div class="absolute bottom-0 right-0 -mr-20 -mb-20 w-96 h-96 bg-red-100 rounded-full blur-3xl opacity-40"></div>

            <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-red-50">
                <!-- Logo di Tengah Atas -->
                <div class="flex justify-center mb-6">
                    <a href="/" class="flex flex-col items-center gap-2 group">
                        <svg class="w-12 h-12 text-primary group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        <span class="font-bold text-2xl text-primary tracking-tight">BraveHeart</span>
                    </a>
                </div>
                
                <!-- Slot Konten (Form Login/Register) -->
                {{ $slot }}
            </div>
        </div>
    </body>
</html>