<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BraveHeart Admin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#991B1B', // Maroon
                            secondary: '#FEE2E2', // Pink Muda
                            dark: '#7F1D1D',
                            sidebar: '#1E293B', 
                        }
                    }
                }
            }
        </script>
        <!-- Alpine.js untuk Interaktivitas Responsive -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <!-- FIX 1: Set sidebarOpen default true (agar langsung terbuka di PC/Laptop) -->
    <body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ sidebarOpen: true }">
        <div class="min-h-screen flex">
            
            <!-- 1. SIDEBAR (Fixed & Maroon) -->
            <aside class="w-64 bg-gradient-to-b from-primary to-red-900 text-white shadow-2xl fixed h-full z-40 transition-transform duration-300 md:translate-x-0" 
                   :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
                   @click.outside="if(window.innerWidth < 768) sidebarOpen = false"> 
                
                <!-- Logo Area -->
                <div class="h-20 flex items-center justify-center border-b border-white/10 px-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                        <span class="text-xl font-bold tracking-wider">BraveHeart</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white font-bold shadow-inner' : 'text-red-100 hover:bg-white/10 hover:text-white' }} transition-all group">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <div class="mt-8 mb-2 px-4 text-xs font-bold text-red-300 uppercase tracking-wider">Manajemen Data</div>
                        
                        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/10' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Staf Internal
                        </a>

                        <a href="{{ route('admin.patients.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('patients.*') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/10' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Data Pasien
                        </a>

                        <div class="mt-8 mb-2 px-4 text-xs font-bold text-red-300 uppercase tracking-wider">Layanan Medis</div>

                        <a href="{{ route('admin.polis.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.polis.*') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/10' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Poli
                        </a>

                        <a href="{{ route('admin.medicines.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.medicines.*') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/10' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            Obat
                        </a>
                        
                        <a href="{{ route('admin.appointments.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.appointments.*') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/10' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Validasi Janji Temu
                        </a>

                    @endif

                    <!-- Dokter Menu -->
                    @if(auth()->user()->role === 'dokter')
                        <div class="mt-8 mb-2 px-4 text-xs font-bold text-red-300 uppercase tracking-wider">Area Dokter</div>
                        <a href="{{ route('dokter.schedules.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('dokter.schedules.*') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/5 hover:text-white' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Jadwal Praktik
                        </a>
                        <a href="{{ route('dokter.appointments.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('dokter.appointments.*') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/5 hover:text-white' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Janji Temu Masuk
                        </a>
                    @endif

                    <!-- Pasien Menu -->
                    @if(auth()->user()->role === 'pasien')
                        <div class="mt-8 mb-2 px-4 text-xs font-bold text-red-300 uppercase tracking-wider">Area Pasien</div>
                        
                        <a href="{{ route('pasien.appointments.create') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('pasien.appointments.create') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/5 hover:text-white' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Buat Janji Temu
                        </a>

                        <a href="{{ route('pasien.appointments.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('pasien.appointments.index') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/5 hover:text-white' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Status Janji Temu
                        </a>

                        <a href="{{ route('pasien.medical-records.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('pasien.medical-records.index') ? 'bg-white/20 text-white font-bold' : 'text-red-100 hover:bg-white/5 hover:text-white' }} transition group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Riwayat Medis Saya
                        </a>
                    @endif

                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-8 border-t border-red-800 pt-4">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg text-red-200 hover:bg-red-800 hover:text-white transition group">
                            <svg class="w-5 h-5 mr-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar
                        </button>
                    </form>
                </nav>
            </aside>

            <!-- MAIN CONTENT -->
            <div class="flex-1 md:ml-64 flex flex-col min-h-screen"> 
                
                <!-- Overlay Backdrop for Mobile Menu -->
                <div x-show="sidebarOpen" class="fixed inset-0 bg-black/50 z-30 md:hidden" @click="sidebarOpen = false"></div>

                <!-- Topbar -->
                <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 sticky top-0 z-20 h-20">
                    <div class="px-8 h-full flex justify-between items-center">
                        
                        <!-- Hamburger Menu (Mobile) & Judul -->
                        <div class="flex items-center">
                            <!-- Tombol Hamburger HANYA muncul jika TIDAK di desktop/layar besar -->
                            <button class="md:hidden text-gray-500 hover:text-primary mr-4" @click.stop="sidebarOpen = !sidebarOpen">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>
                            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center">
                                <span class="text-primary mr-2 hidden md:inline">/</span> {{ $header ?? 'Dashboard' }}
                            </h2>
                        </div>

                        <!-- Profile Area -->
                        <div class="flex items-center gap-4">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                <div class="flex items-center justify-end gap-1">
                                    <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                            </div>
                            <!-- FIX: Gunakan img tag untuk menampilkan foto profil -->
                            <div class="h-11 w-11 rounded-full bg-gradient-to-br from-primary to-red-600 text-white flex items-center justify-center font-bold text-xl shadow-md ring-2 ring-red-100 overflow-hidden">
                                <img src="{{ Auth::user()->profile_photo_url }}" 
                                     alt="Foto Profil" 
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null;this.src='{{ asset('images/avatar-default.png') }}';">
                                
                                <!-- Jika foto gagal/tidak ada, tampilkan inisial (fallback) -->
                                @if (Auth::user()->profile_photo_url === 'https://ui-avatars.com/api/...')
                                    <span class="absolute">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-8 flex-1 bg-gray-50">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>