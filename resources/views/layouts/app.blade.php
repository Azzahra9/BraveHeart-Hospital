<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BraveHeart') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            primary: '#991B1B', // Red 800
                            primaryDark: '#7F1D1D', // Red 900
                            accent: '#FEE2E2', // Red 100
                        }
                    }
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    </head>

    <body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ sidebarOpen: true }">
        <div class="min-h-screen flex">
            
            <aside class="w-72 bg-[#7F1D1D] text-white shadow-xl fixed h-full z-40 transition-transform duration-300 md:translate-x-0 flex flex-col" 
                   :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
                   @click.outside="if(window.innerWidth < 768) sidebarOpen = false"> 
                
                <div class="h-20 flex items-center px-8 border-b border-red-800/50 bg-[#6d1616]">
                    <div class="w-full">
                        <h1 class="text-2xl font-bold text-white tracking-tight leading-none">BraveHeart</h1>
                        <p class="text-[10px] text-red-300 uppercase tracking-widest mt-1">Hospital System</p>
                    </div>
                </div>

                <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                    
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 group
                       {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <div class="mt-8 mb-2 px-4">
                            <p class="text-[11px] font-bold text-red-300/80 uppercase tracking-wider">Manajemen User</p>
                        </div>
                        
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Staf Internal
                        </a>

                        <a href="{{ route('admin.patients.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('admin.patients.*') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.patients.*') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Data Pasien
                        </a>

                        <div class="mt-8 mb-2 px-4">
                            <p class="text-[11px] font-bold text-red-300/80 uppercase tracking-wider">Klinik & Farmasi</p>
                        </div>

                        <a href="{{ route('admin.polis.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('admin.polis.*') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.polis.*') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Daftar Poli
                        </a>

                        <a href="{{ route('admin.medicines.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('admin.medicines.*') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.medicines.*') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            Stok Obat
                        </a>
                        
                        <a href="{{ route('admin.appointments.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('admin.appointments.*') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.appointments.*') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Validasi Janji Temu
                        </a>
                    @endif

                    @if(auth()->user()->role === 'dokter')
                        <div class="mt-8 mb-2 px-4">
                            <p class="text-[11px] font-bold text-red-300/80 uppercase tracking-wider">Ruang Dokter</p>
                        </div>
                        <a href="{{ route('dokter.schedules.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('dokter.schedules.*') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dokter.schedules.*') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Jadwal Praktik
                        </a>
                        <a href="{{ route('dokter.appointments.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('dokter.appointments.*') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dokter.appointments.*') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Pasien Masuk
                        </a>
                    @endif

                    @if(auth()->user()->role === 'pasien')
                        <div class="mt-8 mb-2 px-4">
                            <p class="text-[11px] font-bold text-red-300/80 uppercase tracking-wider">Menu Pasien</p>
                        </div>
                        
                        <a href="{{ route('pasien.appointments.create') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('pasien.appointments.create') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pasien.appointments.create') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Buat Janji Temu
                        </a>

                        <a href="{{ route('pasien.appointments.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('pasien.appointments.index') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pasien.appointments.index') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Status Janji Temu
                        </a>

                        <a href="{{ route('pasien.medical-records.index') }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
                           {{ request()->routeIs('pasien.medical-records.index') ? 'bg-white/10 text-white shadow-sm border-l-4 border-white' : 'text-red-100 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('pasien.medical-records.index') ? 'text-white' : 'text-red-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Riwayat Medis
                        </a>
                    @endif
                </nav>

                <div class="border-t border-red-800 p-4 bg-[#6d1616]">
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2 text-sm font-medium text-red-200 hover:bg-red-800/50 hover:text-white rounded-lg transition-colors group">
                            <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex-1 md:ml-72 flex flex-col min-h-screen"> 
                
                <div x-show="sidebarOpen" class="fixed inset-0 bg-black/50 z-30 md:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

                <header class="bg-white/90 backdrop-blur-sm shadow-sm border-b border-gray-200 sticky top-0 z-20 h-16">
                    <div class="px-6 h-full flex justify-between items-center">
                        
                        <div class="flex items-center gap-4">
                            <button class="md:hidden text-gray-500 hover:text-primary transition" @click.stop="sidebarOpen = !sidebarOpen">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>
                            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                                {{ $header ?? 'Dashboard' }}
                            </h2>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-semibold text-gray-900 leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-[11px] text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                            </div>
                            
                            <div class="h-10 w-10 rounded-full bg-gray-200 ring-2 ring-white shadow-sm overflow-hidden relative">
                                <img src="{{ Auth::user()->profile_photo_url }}" 
                                     alt="Foto" 
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null;this.src='{{ asset('images/avatar-default.png') }}';">
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-6 flex-1 bg-gray-50">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>