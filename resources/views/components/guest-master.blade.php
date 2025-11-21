<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BraveHeart Hospital - Layanan Jantung Terpercaya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CDN Tailwind (Styling) -->
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

    <!-- CDN Alpine.js (Interaktivitas / Pop-up) - WAJIB ADA -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased text-gray-900 bg-white">

    <!-- NAVBAR -->
    <nav class="bg-white/90 backdrop-blur-md shadow-sm fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo Brand -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <svg width="40" height="40" class="w-10 h-10 text-primary group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        <span class="font-bold text-2xl text-primary tracking-tight">BraveHeart</span>
                    </a>
                </div>

                <!-- Menu Desktop (Font Konsisten & Normal) -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary font-medium transition text-base">Beranda</a>
                    <a href="{{ route('guest.polis') }}" class="text-gray-600 hover:text-primary font-medium transition text-base">Layanan Medis</a>
                    <a href="{{ route('guest.dokter') }}" class="text-gray-600 hover:text-primary font-medium transition text-base">Cari Dokter</a>
                    
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-primary text-white font-bold rounded-full hover:bg-red-800 transition shadow-lg shadow-red-900/20 text-sm">Dashboard</a>
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-primary font-bold hover:underline transition text-sm">Masuk</a>
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-primary text-white font-bold rounded-full hover:bg-red-800 transition shadow-lg shadow-red-900/20 text-sm transform hover:-translate-y-0.5">Buat Janji Temu</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-20 min-h-screen">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="bg-gradient-to-br from-primary to-red-900 text-white pt-16 pb-8 mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Kolom 1 -->
            <div class="md:col-span-1">
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <svg width="24" height="24" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    BraveHeart
                </h3>
                <p class="text-red-100 text-sm leading-relaxed opacity-90">
                    Melayani dengan hati, merawat dengan teknologi. Rumah sakit jantung terdepan pilihan keluarga Indonesia.
                </p>
            </div>

            <!-- Kolom 2 -->
            <div>
                <h4 class="font-bold text-lg mb-6 border-b border-white/20 pb-2 inline-block">Pasien</h4>
                <ul class="space-y-3 text-sm text-red-100">
                    <li><a href="{{ route('register') }}" class="hover:text-white inline-block">Buat Janji Temu</a></li>
                    <li><a href="{{ route('guest.dokter') }}" class="hover:text-white inline-block">Jadwal Dokter</a></li>
                    <li><a href="{{ route('guest.polis') }}" class="hover:text-white inline-block">Fasilitas & Layanan</a></li>
                </ul>
            </div>

            <!-- Kolom 3 -->
            <div>
                <h4 class="font-bold text-lg mb-6 border-b border-white/20 pb-2 inline-block">Hubungi Kami</h4>
                <ul class="space-y-3 text-sm text-red-100">
                    <li>📞 1-500-911 (Emergency)</li>
                    <li>📱 0812-3456-7890</li>
                    <li>📧 info@braveheart.com</li>
                </ul>
            </div>

            <!-- Kolom 4: LOKASI (Makassar) -->
            <div>
                <h4 class="font-bold text-lg mb-6 border-b border-white/20 pb-2 inline-block">Lokasi Kami</h4>
                
                <!-- Google Maps Embed -->
                <div class="rounded-xl overflow-hidden border-2 border-white/20 shadow-lg mb-4 h-40 bg-gray-800 relative group">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.801376496625!2d119.48592531476027!3d-5.135245996273283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefc8e6585791b%3A0xf29447268e3533a8!2sJl.%20Perintis%20Kemerdekaan%2C%20Kota%20Makassar%2C%20Sulawesi%20Selatan!5e0!3m2!1sid!2sid!4v1678901234567!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full">
                    </iframe>
                </div>
                
                <p class="text-sm text-red-100 leading-relaxed">
                    Jl. Perintis Kemerdekaan, <br>
                    Kota Makassar, Sulawesi Selatan.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-white/20 text-center text-sm text-red-200">
            &copy; 2025 BraveHeart Hospital. All rights reserved.
        </div>
    </footer>

</body>
</html>