<x-app-layout>
    <x-slot name="header">
        {{ __('Buat Janji Temu') }}
    </x-slot>

    @php
        $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');
        
        $poliId = $selectedPoliId ?? request('poli_id');
        $docId = $doctorId ?? request('dokter_id');

        $poliName = $poliId ? (\App\Models\Poli::find($poliId)->nama_poli ?? '-') : '-';
        $docName = $docId ? (\App\Models\User::find($docId)->name ?? '-') : '-';
        $docPhoto = $docId ? (\App\Models\User::find($docId)->profile_photo_url ?? '') : '';

        $currentStep = 1;
        if ($docId) {
            $currentStep = 3; 
        } elseif ($poliId) {
            $currentStep = 2;
        }

        $schedulesByDay = isset($availableSchedules) ? $availableSchedules->groupBy('hari') : collect([]);

        $poliIcons = [
            'jantung' => 'heart-pulse',
            'kardiologi' => 'heart-pulse',
            'gigi' => 'tooth',
            'mata' => 'eye',
            'anak' => 'baby',
            'tht' => 'ear',
            'saraf' => 'brain',
            'dalam' => 'activity',
        ];
    @endphp

    <div class="min-h-screen bg-gray-50/50 pb-12" x-data="appointmentApp()">
            
        <div class="bg-gradient-to-r from-red-900 to-red-800 py-8 px-4 sm:px-6 lg:px-8 shadow-lg relative overflow-hidden rounded-b-[50px] mx-0 mt-0 z-0">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mt-10 -mr-10 pointer-events-none"></div>
            <div class="max-w-5xl mx-auto relative z-10">
                <h1 class="text-xl font-bold text-white mb-1">Pendaftaran Pasien</h1>
                <p class="text-red-100 text-xs sm:text-sm">Lengkapi langkah-langkah di bawah untuk bertemu dokter Anda.</p>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-0">
            
            <!-- STEP INDICATOR MODERN -->
            <div class="bg-white rounded-2xl shadow-xl shadow-red-900/5 p-4 mb-8 border border-gray-100">
                <div class="flex items-center justify-between relative">
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-100 rounded-full -z-0"></div>
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-gradient-to-r from-red-600 to-red-800 rounded-full -z-0 transition-all duration-500"
                         :style="'width: ' + ((step - 1) / 3 * 100) + '%'"></div>

                    <!-- Step 1 -->
                    <div class="relative z-10 flex flex-col items-center group cursor-default">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center font-bold text-xs sm:text-sm transition-all duration-300 border-4"
                             :class="step >= 1 ? 'bg-red-800 text-white border-red-100 shadow-md scale-110' : 'bg-white text-gray-400 border-gray-100'">1</div>
                        <span class="mt-2 text-[10px] sm:text-xs font-bold uppercase tracking-wide transition-colors duration-300"
                              :class="step >= 1 ? 'text-red-800' : 'text-gray-400'">Poli</span>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative z-10 flex flex-col items-center group cursor-default">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center font-bold text-xs sm:text-sm transition-all duration-300 border-4"
                             :class="step >= 2 ? 'bg-red-800 text-white border-red-100 shadow-md scale-110' : 'bg-white text-gray-400 border-gray-100'">2</div>
                        <span class="mt-2 text-[10px] sm:text-xs font-bold uppercase tracking-wide transition-colors duration-300"
                              :class="step >= 2 ? 'text-red-800' : 'text-gray-400'">Dokter</span>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative z-10 flex flex-col items-center group cursor-default">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center font-bold text-xs sm:text-sm transition-all duration-300 border-4"
                             :class="step >= 3 ? 'bg-red-800 text-white border-red-100 shadow-md scale-110' : 'bg-white text-gray-400 border-gray-100'">3</div>
                        <span class="mt-2 text-[10px] sm:text-xs font-bold uppercase tracking-wide transition-colors duration-300"
                              :class="step >= 3 ? 'text-red-800' : 'text-gray-400'">Jadwal</span>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative z-10 flex flex-col items-center group cursor-default">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center font-bold text-xs sm:text-sm transition-all duration-300 border-4"
                             :class="step >= 4 ? 'bg-red-800 text-white border-red-100 shadow-md scale-110' : 'bg-white text-gray-400 border-gray-100'">4</div>
                        <span class="mt-2 text-[10px] sm:text-xs font-bold uppercase tracking-wide transition-colors duration-300"
                              :class="step >= 4 ? 'text-red-800' : 'text-gray-400'">Selesai</span>
                    </div>
                </div>
            </div>

            <!-- FORM CARD UTAMA -->
            <form method="POST" action="{{ route('pasien.appointments.store') }}" class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-white overflow-hidden relative min-h-[400px]">
                @csrf
                
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-[0.02] bg-[radial-gradient(#7F1D1D_1px,transparent_1px)] [background-size:16px_16px]"></div>

                <div class="p-6 sm:p-8 relative z-10">

                    <!-- STEP 1: PILIH POLI -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-gray-900">Pilih Layanan Medis</h3>
                            <p class="text-gray-500 text-sm mt-1">Silakan pilih poli spesialis yang sesuai dengan keluhan Anda.</p>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                            @foreach($polis as $item)
                                @php 
                                    $iconName = 'hospital';
                                    $lowerName = strtolower($item->nama_poli);
                                    foreach($poliIcons as $key => $val) {
                                        if(str_contains($lowerName, $key)) {
                                            $iconName = $val;
                                            break;
                                        }
                                    }
                                @endphp
                                <a href="?poli_id={{ $item->id }}" 
                                   class="group relative flex flex-col items-center justify-center p-6 rounded-2xl border-2 transition-all duration-300 {{ $poliId == $item->id ? 'border-red-600 bg-red-50/50 ring-4 ring-red-100' : 'border-gray-100 bg-white hover:border-red-200 hover:shadow-lg hover:-translate-y-1' }}">
                                    
                                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 transition-colors duration-300 {{ $poliId == $item->id ? 'bg-red-600 text-white' : 'bg-red-50 text-red-600 group-hover:bg-red-600 group-hover:text-white' }}">
                                        @if($iconName == 'heart-pulse')
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                                        @elseif($iconName == 'tooth')
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                        @elseif($iconName == 'eye')
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        @elseif($iconName == 'brain')
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                                        @elseif($iconName == 'baby')
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        @else
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                        @endif
                                    </div>

                                    <div class="font-bold text-gray-800 text-base mb-1">{{ $item->nama_poli }}</div>
                                    <div class="text-xs text-gray-400 font-medium">Spesialis Medis</div>
                                    
                                    @if($poliId == $item->id)
                                        <div class="absolute top-3 right-3 bg-red-600 text-white rounded-full p-1">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- STEP 2: PILIH DOKTER -->
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                            <div class="text-center md:text-left">
                                <h3 class="text-2xl font-bold text-gray-900">Pilih Dokter Spesialis</h3>
                                <p class="text-gray-500 text-sm mt-1">
                                    Menampilkan dokter untuk <span class="font-bold text-red-700 bg-red-50 px-2 py-0.5 rounded">{{ $poliName }}</span>
                                </p>
                            </div>
                            <a href="?" class="text-xs font-bold text-gray-500 hover:text-red-700 flex items-center gap-1 bg-gray-50 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Ganti Poli
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @forelse($availableDoctors as $doc)
                            <a href="?poli_id={{ $poliId }}&dokter_id={{ $doc->id }}" 
                               class="relative flex items-center gap-4 p-4 rounded-2xl border-2 transition-all duration-300 {{ $docId == $doc->id ? 'border-red-600 bg-red-50/50 shadow-md' : 'border-gray-100 bg-white hover:border-red-200 hover:shadow-lg' }}">
                                
                                <div class="relative flex-shrink-0">
                                    <img class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-sm" 
                                         src="{{ $doc->profile_photo_url }}" 
                                         alt="{{ $doc->name }}"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($doc->name) }}&background=E5E7EB&color=374151'">
                                    
                                    @if($docId == $doc->id)
                                        <div class="absolute bottom-0 right-0 bg-red-600 text-white p-1 rounded-full border-2 border-white">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-lg font-bold text-gray-900 truncate">{{ $doc->name }}</h4>
                                    <p class="text-sm text-red-600 font-medium truncate">{{ $poliName }}</p>
                                    <div class="flex items-center gap-1 mt-1">
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        <span class="text-xs text-gray-400 font-medium">4.8 (120+ Pasien)</span>
                                    </div>
                                </div>
                            </a>
                            @empty
                            <div class="col-span-3 flex flex-col items-center justify-center py-12 text-center border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50">
                                <div class="bg-white p-3 rounded-full mb-3 shadow-sm">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" /></svg>
                                </div>
                                <p class="text-gray-500 font-medium">Maaf, tidak ada dokter tersedia di poli ini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- STEP 3: PILIH JADWAL -->
                    <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        <div class="flex flex-col lg:flex-row gap-8">
                            
                            <!-- Kolom Kiri: Info Dokter & Input Tanggal -->
                            <div class="w-full lg:w-1/3">
                                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 h-full">
                                    <div class="flex items-center gap-4 mb-6">
                                        <img class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-md" src="{{ $docPhoto }}" alt="{{ $docName }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($docName) }}'">
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $docName }}</h4>
                                            <p class="text-xs text-gray-500">{{ $poliName }}</p>
                                        </div>
                                    </div>

                                    <label class="block text-sm font-bold text-gray-800 mb-2">Pilih Tanggal Rencana</label>
                                    <input type="date" x-model="selectedDate" min="{{ $tomorrow }}" 
                                           class="w-full p-3 border-gray-200 rounded-xl focus:ring-red-500 focus:border-red-500 text-sm shadow-sm">
                                    <p class="text-xs text-gray-400 mt-2">*Jadwal di samping akan menyesuaikan hari yang Anda pilih.</p>
                                    
                                    <div class="mt-6 border-t border-gray-200 pt-4">
                                        <a href="?poli_id={{ $poliId }}" class="text-sm text-gray-500 hover:text-red-700 font-medium flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                            Ganti Dokter
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Slot Waktu -->
                            <div class="w-full lg:w-2/3">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-gray-900">Slot Waktu Tersedia</h3>
                                    <span class="text-xs font-bold text-red-600 bg-red-50 px-3 py-1 rounded-full border border-red-100">WIB</span>
                                </div>

                                <div class="space-y-6">
                                    @if($schedulesByDay->isEmpty())
                                        <div class="flex flex-col items-center justify-center py-12 bg-white border border-gray-200 rounded-2xl text-center">
                                            <svg class="w-16 h-16 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <strong class="text-gray-900 block">Jadwal Belum Tersedia</strong>
                                            <p class="text-gray-500 text-sm mt-1">Dokter ini belum mengatur jam praktiknya.</p>
                                        </div>
                                    @else
                                        @foreach($schedulesByDay as $hari => $listJadwal)
                                            <div class="relative pl-6 border-l-2 border-gray-100">
                                                <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-red-100 border-2 border-white ring-1 ring-red-200"></div>
                                                <h4 class="font-bold text-gray-800 mb-3 text-lg">{{ ucfirst($hari) }}</h4>
                                                
                                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                                    @foreach($listJadwal as $jadwal)
                                                        <button type="button" 
                                                                @click="selectSchedule({{ $jadwal->id }}, '{{ substr($jadwal->jam_mulai, 0, 5) }}')"
                                                                class="group relative flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-200"
                                                                :class="scheduleId == {{ $jadwal->id }} 
                                                                    ? 'bg-gradient-to-br from-red-700 to-red-900 text-white border-red-900 shadow-md transform scale-[1.02]' 
                                                                    : 'bg-white text-gray-700 border-gray-200 hover:border-red-300 hover:shadow-sm'">
                                                            
                                                            <div class="font-bold text-base tracking-wide">
                                                                {{ substr($jadwal->jam_mulai, 0, 5) }}
                                                            </div>
                                                            <div class="text-[10px] opacity-80 mt-1 font-medium" 
                                                                 :class="scheduleId == {{ $jadwal->id }} ? 'text-red-100' : 'text-gray-400'">
                                                                {{ $jadwal->durasi }} Menit
                                                            </div>

                                                            <div x-show="scheduleId == {{ $jadwal->id }}" class="absolute -top-2 -right-2 bg-white text-red-700 rounded-full p-0.5 border border-gray-100 shadow-sm">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                            </div>
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="mt-8 flex justify-end">
                                    <button type="button" @click="step = 4" :disabled="!scheduleId || !selectedDate" 
                                            class="flex items-center gap-2 px-8 py-3 bg-red-800 text-white font-bold rounded-xl disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:bg-red-900 hover:shadow-red-900/30 transition transform active:scale-95">
                                        Lanjut Konfirmasi
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 4: KONFIRMASI -->
                    <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        <div class="max-w-2xl mx-auto">
                            <div class="text-center mb-8">
                                <h3 class="text-2xl font-bold text-gray-900">Konfirmasi Detail</h3>
                                <p class="text-gray-500 text-sm mt-1">Mohon periksa kembali data janji temu Anda sebelum mengirim.</p>
                            </div>

                            <!-- Ticket Card -->
                            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-lg relative">
                                <div class="h-2 bg-gradient-to-r from-red-600 to-red-900"></div>
                                
                                <div class="p-6 md:p-8">
                                    <div class="flex items-start gap-5 border-b border-dashed border-gray-200 pb-6 mb-6">
                                        <img class="w-16 h-16 rounded-full object-cover border-2 border-gray-100" src="{{ $docPhoto }}" alt="{{ $docName }}">
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg">{{ $docName }}</h4>
                                            <p class="text-red-700 font-medium text-sm">{{ $poliName }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-y-6 gap-x-4 mb-6">
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase tracking-wide font-bold">Tanggal</p>
                                            <p class="font-bold text-gray-800 text-lg" x-text="selectedDate"></p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase tracking-wide font-bold">Waktu</p>
                                            <p class="font-bold text-gray-800 text-lg" x-text="scheduleTime + ' WIB'"></p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase tracking-wide font-bold">Lokasi</p>
                                            <p class="font-medium text-gray-600 text-sm">Heart Hospital, Lantai 2</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase tracking-wide font-bold">Biaya Konsul</p>
                                            <p class="font-medium text-gray-600 text-sm">Menyesuaikan</p>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                        <label class="block font-bold text-gray-700 text-sm mb-2 flex items-center justify-between">
                                            Keluhan Utama
                                            <span class="text-[10px] text-red-500 bg-red-50 px-2 py-0.5 rounded-full border border-red-100 uppercase">*Wajib Diisi</span>
                                        </label>
                                        <textarea name="keluhan" rows="3" 
                                                  class="w-full border-gray-200 rounded-lg focus:ring-0 focus:border-red-500 bg-white text-sm placeholder-gray-400" 
                                                  required placeholder="Contoh: Saya sering merasa nyeri dada di bagian kiri saat beraktivitas berat..."></textarea>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                                    <button type="button" @click="step = 3" class="text-sm font-bold text-gray-500 hover:text-gray-800">
                                        Ubah Jadwal
                                    </button>
                                    <button type="submit" class="px-6 py-2.5 bg-red-800 text-white font-bold rounded-xl shadow-lg shadow-red-900/20 hover:bg-red-900 transition flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Konfirmasi Janji
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="dokter_id" value="{{ $docId }}">
                    <input type="hidden" name="schedule_id" :value="scheduleId">
                    <input type="hidden" name="tanggal_booking" :value="selectedDate">

                </div>
            </form>
        </div>
    </div>

    <script>
        function appointmentApp() {
            return {
                step: parseInt('{{ $currentStep }}'),
                selectedDate: '',
                scheduleId: null,
                scheduleTime: '',

                selectSchedule(id, time) {
                    this.scheduleId = id;
                    this.scheduleTime = time;
                }
            }
        }
    </script>
</x-app-layout>