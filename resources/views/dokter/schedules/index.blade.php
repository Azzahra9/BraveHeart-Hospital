<x-app-layout>
    <x-slot name="header">
        {{ __('Jadwal Praktik Saya') }}
    </x-slot>

    {{-- Container utama menggunakan AlpineJS untuk mengontrol Modal Hapus --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ showDeleteModal: false, deleteUrl: '' }">
        
        {{-- Flash Message Success --}}
        @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm animate-pulse-slow">
                <div class="p-1 bg-green-100 rounded-full text-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Flash Message Error --}}
        @if(session('error'))
            <div class="mb-8 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm">
                <div class="p-1 bg-red-100 rounded-full text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <!-- HEADER BANNER (Gradient Maroon) -->
        <div class="relative bg-gradient-to-r from-red-900 to-red-800 rounded-[2.5rem] p-8 text-white shadow-xl shadow-red-900/20 flex flex-col md:flex-row justify-between items-center overflow-hidden gap-6 mb-10">
            <!-- Texture Pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl -mt-20 -mr-20 pointer-events-none"></div>
            
            <div class="relative z-10">
                <h2 class="text-3xl font-bold tracking-tight mb-1">Kelola Jadwal Praktik</h2>
                <p class="text-red-100 text-sm font-medium opacity-90">Atur ketersediaan waktu Anda untuk melayani pasien.</p>
            </div>
            
            <div class="relative z-10">
                <a href="{{ route('dokter.schedules.create') }}" class="group bg-white text-red-900 px-6 py-3 rounded-2xl text-sm font-bold shadow-lg hover:shadow-xl hover:bg-gray-50 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <div class="bg-red-100 p-1 rounded-full group-hover:bg-red-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    Tambah Jadwal Baru
                </a>
            </div>
        </div>

        @if($schedules->isEmpty())
            <div class="bg-white rounded-[2rem] p-12 text-center shadow-sm border border-dashed border-gray-300 relative overflow-hidden">
                <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-6 text-red-800">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Jadwal Praktik Kosong</h3>
                    <p class="text-gray-500 mb-8 max-w-md">Anda belum menambahkan jadwal praktik. Silakan tambahkan jadwal agar pasien dapat membuat janji temu.</p>
                    <a href="{{ route('dokter.schedules.create') }}" class="text-red-800 font-bold hover:underline hover:text-red-900 transition">
                        Buat Jadwal Sekarang &rarr;
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($schedules as $schedule)
                    <div class="group bg-white rounded-[2rem] p-6 shadow-lg shadow-gray-200/50 border border-white hover:border-red-100 transition-all duration-300 relative overflow-hidden hover:-translate-y-1">
                        
                        <!-- Dekorasi Latar -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110 duration-500 pointer-events-none"></div>

                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-6">
                                {{-- Badge Hari --}}
                                <div class="px-4 py-1.5 bg-red-50 text-red-800 rounded-xl font-bold text-xs uppercase tracking-wider border border-red-100 shadow-sm">
                                    {{ $schedule->hari }}
                                </div>
                                
                                {{-- Action Buttons (Modern Icons) --}}
                                <div class="flex gap-2">
                                    <a href="{{ route('dokter.schedules.edit', $schedule->id) }}" 
                                       class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition border border-transparent hover:border-blue-100" 
                                       title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    
                                    {{-- TOMBOL HAPUS (Memicu Modal Popup) --}}
                                    <button @click="showDeleteModal = true; deleteUrl = '{{ route('dokter.schedules.destroy', $schedule->id) }}'" 
                                            class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-600 transition border border-transparent hover:border-red-100" 
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-6">
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wide mb-1">Waktu Praktik</p>
                                <div class="flex items-center gap-2 text-gray-900">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-2xl font-extrabold tracking-tight">
                                        {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }}
                                    </span>
                                    <span class="text-gray-400 font-medium text-sm">WIB - Selesai</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs text-gray-400 font-medium">Estimasi per pasien</span>
                                <span class="font-bold text-gray-700 bg-gray-50 px-3 py-1 rounded-lg text-xs border border-gray-100 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $schedule->durasi }} Menit
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- MODAL POPUP HAPUS (Custom UI Modern) --}}
        <div x-show="showDeleteModal" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            {{-- Backdrop Gelap dengan Blur --}}
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showDeleteModal = false"></div>

            {{-- Konten Modal --}}
            <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100"
                 x-show="showDeleteModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="bg-white p-8 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-50 mb-6">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2" id="modal-title">Hapus Jadwal?</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Apakah Anda yakin ingin menghapus jadwal ini? <br>
                        <span class="text-red-600 font-medium">Tindakan ini tidak dapat dibatalkan</span> dan pasien tidak akan bisa melihat jadwal ini lagi.
                    </p>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-center gap-3">
                    <button type="button" 
                            @click="showDeleteModal = false"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-300 shadow-sm hover:bg-gray-50 transition">
                        Batal
                    </button>
                    
                    {{-- Form Delete yang sesungguhnya --}}
                    <form :action="deleteUrl" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-5 py-2.5 bg-red-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-red-600/30 hover:bg-red-700 transition">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>