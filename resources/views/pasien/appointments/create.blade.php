<x-app-layout>
    <x-slot name="header">
        {{ __('Buat Janji Temu Baru') }}
    </x-slot>

    <!-- FIX: Pindahkan semua logika import dan lookup ke FQCN (Fully Qualified Class Name) -->
    @php
        // PENTING: Hitung tanggal besok di sini untuk input min date
        $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');

        // Lookup objek diperlukan untuk menampilkan nama menggunakan FQCN
        $selectedPoliObject = $selectedPoliId ? \App\Models\Poli::find($selectedPoliId) : null;
        $selectedDoctorObject = $doctorId ? \App\Models\User::find($doctorId) : null;
        
        // Menentukan step awal yang aman berdasarkan data yang sudah ada di URL
        $initialStep = 1;
        if (isset($selectedPoliId) && $selectedPoliId && isset($doctorId) && $doctorId) {
            // Jika Poli dan Dokter sudah dipilih, langsung ke step 3 (Pilih Waktu)
            $initialStep = 3;
        } elseif (isset($selectedPoliId) && $selectedPoliId) {
            // Jika hanya Poli yang dipilih, langsung ke step 2 (Pilih Dokter)
            $initialStep = 2;
        }
    @endphp

    <!-- KONTEN UTAMA: BOOKING FLOW -->
    <div class="max-w-4xl mx-auto" x-data="{ 
        step: {{ $initialStep }},
        selectedPoli: '{{ $selectedPoliId ?? '' }}',
        selectedDoctor: '{{ $doctorId ?? '' }}',
        selectedSchedule: null,
        selectedDate: '',
        
        // Fungsi untuk mengambil waktu jadwal yang dipilih
        getScheduleTime: function(scheduleId) {
            const schedules = @json($availableSchedules->keyBy('id'));
            const schedule = schedules[scheduleId];
            if (schedule) {
                const startTime = schedule.jam_mulai;
                const endTime = new Date('2000/01/01 ' + startTime);
                endTime.setMinutes(endTime.getMinutes() + schedule.durasi);
                return startTime.substring(0, 5) + ' - ' + endTime.toTimeString().substring(0, 5);
            }
            return 'Waktu Tidak Ditemukan';
        }
    }">
        
        <!-- Pesan Error/Success -->
        @if(session('error'))
            <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
        @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header & Status Bar -->
        <div class="bg-white rounded-3xl p-8 mb-8 shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Langkah Pengajuan Janji</h2>
            
            <!-- Step Indicators -->
            <div class="flex justify-between items-center text-sm font-medium">
                <div :class="{'text-primary': step >= 1, 'text-gray-400': step < 1}" class="flex flex-col items-center">
                    <div :class="{'bg-primary text-white': step >= 1, 'bg-gray-100 text-gray-500': step < 1}" class="w-8 h-8 rounded-full flex items-center justify-center mb-1 transition-colors duration-300">1</div>
                    Pilih Poli
                </div>
                <div class="flex-1 border-t-2 mt-4 mx-2" :class="{'border-primary': step > 1, 'border-gray-200': step <= 1}"></div>
                <div :class="{'text-primary': step >= 2, 'text-gray-400': step < 2}" class="flex flex-col items-center">
                    <div :class="{'bg-primary text-white': step >= 2, 'bg-gray-100 text-gray-500': step < 2}" class="w-8 h-8 rounded-full flex items-center justify-center mb-1 transition-colors duration-300">2</div>
                    Pilih Dokter
                </div>
                <div class="flex-1 border-t-2 mt-4 mx-2" :class="{'border-primary': step > 2, 'border-gray-200': step <= 2}"></div>
                <div :class="{'text-primary': step >= 3, 'text-gray-400': step < 3}" class="flex flex-col items-center">
                    <div :class="{'bg-primary text-white': step >= 3, 'bg-gray-100 text-gray-500': step < 3}" class="w-8 h-8 rounded-full flex items-center justify-center mb-1 transition-colors duration-300">3</div>
                    Pilih Waktu
                </div>
                <div class="flex-1 border-t-2 mt-4 mx-2" :class="{'border-primary': step > 3, 'border-gray-200': step <= 3}"></div>
                <div :class="{'text-primary': step >= 4, 'text-gray-400': step < 4}" class="flex flex-col items-center">
                    <div :class="{'bg-primary text-white': step >= 4, 'bg-gray-100 text-gray-500': step < 4}" class="w-8 h-8 rounded-full flex items-center justify-center mb-1 transition-colors duration-300">4</div>
                    Konfirmasi
                </div>
            </div>
        </div>

        <!-- FORM UTAMA -->
        <form id="booking-form" method="POST" action="{{ route('pasien.appointments.store') }}" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            @csrf
            
            <!-- STEP 1: PILIH POLI -->
            <div x-show="step === 1" x-transition:enter.duration.500ms>
                <h3 class="text-xl font-bold mb-6 text-gray-800">1. Pilih Spesialisasi Poli</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse($polis as $poli)
                    <div data-poli-id="{{ $poli->id }}"
                         @click="window.location.href = '{{ route('pasien.appointments.create') }}?poli_id={{ $poli->id }}'" 
                         class="p-4 border-2 rounded-xl text-center cursor-pointer transition-all duration-200"
                         :class="{'border-primary shadow-lg bg-red-50': selectedPoli === '{{ $poli->id }}', 'border-gray-200 hover:border-primary': selectedPoli !== '{{ $poli->id }}'}">
                        <div class="w-10 h-10 bg-red-100 text-primary rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <p class="font-bold text-sm">{{ $poli->nama_poli }}</p>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-8 text-gray-500">
                        Belum ada poli yang terdaftar. Hubungi Admin.
                    </div>
                    @endforelse
                </div>
                <div class="flex justify-end mt-8">
                     <!-- Tombol ini hanya sebagai visual karena navigasi terjadi di @click card -->
                     <button type="button" @click="step = 2" :disabled="!selectedPoli" :class="{'opacity-50 cursor-not-allowed': !selectedPoli}" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-red-800 transition">Lanjut →</button>
                </div>
            </div>

            <!-- STEP 2: PILIH DOKTER -->
            <div x-show="step === 2" x-transition:enter.duration.500ms>
                <h3 class="text-xl font-bold mb-6 text-gray-800">2. Pilih Dokter Spesialis</h3>
                <p class="text-sm text-gray-500 mb-6">Poli terpilih: <span class="font-semibold text-primary">{{ $selectedPoliObject->nama_poli ?? 'N/A' }}</span></p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse($availableDoctors as $dokter)
                    <div data-doctor-id="{{ $dokter->id }}" data-poli-id="{{ $selectedPoliId }}"
                         @click="window.location.href = '{{ route('pasien.appointments.create') }}?poli_id={{ $selectedPoliId }}&dokter_id={{ $dokter->id }}'"
                         class="p-4 border-2 rounded-xl text-center cursor-pointer transition-all duration-200"
                         :class="{'border-primary shadow-lg bg-red-50': selectedDoctor === '{{ $dokter->id }}', 'border-gray-200 hover:border-primary': selectedDoctor !== '{{ $dokter->id }}'}">
                        
                        <div class="w-14 h-14 rounded-full bg-gray-200 text-primary flex items-center justify-center mx-auto mb-2 font-bold text-lg">
                            {{ substr($dokter->name, 0, 1) }}
                        </div>
                        <p class="font-bold text-sm truncate">{{ $dokter->name }}</p>
                        <p class="text-xs text-gray-500">{{ $dokter->poli->nama_poli ?? 'Umum' }}</p>
                    </div>
                    @empty
                    <div class="col-span-4 text-center py-8 text-gray-500">
                        Tidak ada dokter yang tersedia untuk poli ini.
                    </div>
                    @endforelse
                </div>
                <div class="flex justify-between mt-8">
                    <button type="button" @click="window.location.href = '{{ route('pasien.appointments.create') }}'" class="px-6 py-3 border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition">← Ganti Poli</button>
                    <!-- Tombol ini hanya sebagai visual karena navigasi terjadi di @click card -->
                    <button type="button" @click="step = 3" :disabled="!selectedDoctor" :class="{'opacity-50 cursor-not-allowed': !selectedDoctor}" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-red-800 transition">Lanjut →</button>
                </div>
            </div>
            
            <!-- STEP 3: PILIH JADWAL & TANGGAL -->
            <div x-show="step === 3" x-transition:enter.duration.500ms>
                <h3 class="text-xl font-bold mb-6 text-gray-800">3. Pilih Tanggal & Jam</h3>
                <p class="text-sm text-gray-500 mb-6">Dokter terpilih: <span class="font-semibold text-primary">{{ $selectedDoctorObject->name ?? 'N/A' }}</span></p>

                <!-- Input Tanggal (untuk filtering) -->
                <div class="mb-6 max-w-xs">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Konsultasi</label>
                    <input type="date" x-model="selectedDate" min="{{ $tomorrow }}" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-red-200 transition shadow-sm">
                    <p class="text-xs text-gray-500 mt-1">Jadwal tersedia mulai besok.</p>
                </div>

                <!-- Jadwal Tersedia berdasarkan Hari -->
                <div class="space-y-6">
                    @php
                        // Memastikan $availableSchedules ada sebelum grouping
                        $groupedSchedules = $availableSchedules ? $availableSchedules->groupBy('hari') : collect();
                    @endphp
                    @if($groupedSchedules->isEmpty())
                        <div class="text-center py-8 text-gray-500 border border-gray-200 rounded-xl">
                            Dokter ini belum memiliki jadwal tetap. Mohon pilih dokter lain.
                        </div>
                    @else
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                            @if($groupedSchedules->has($day))
                                <div class="mb-4">
                                    <h4 class="font-bold text-lg text-gray-700 mb-3">{{ $day }}</h4>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($groupedSchedules[$day] as $schedule)
                                            @php
                                                // Kalkulasi waktu selesai untuk tampilan
                                                $startTime = \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i');
                                                $endTime = \Carbon\Carbon::parse($schedule->jam_mulai)->addMinutes($schedule->durasi)->format('H:i');
                                                $timeSlot = $startTime . ' - ' . $endTime;
                                            @endphp
                                            <div @click="selectedSchedule = {{ $schedule->id }};"
                                                 data-schedule-id="{{ $schedule->id }}"
                                                 data-time-slot="{{ $timeSlot }}"
                                                 class="px-4 py-2 border-2 rounded-xl text-sm cursor-pointer transition-all duration-200"
                                                 :class="{'border-primary shadow-lg bg-red-50': selectedSchedule === {{ $schedule->id }}, 'border-gray-200 hover:border-primary': selectedSchedule !== {{ $schedule->id }}}">
                                                {{ $timeSlot }} ({{ $schedule->durasi }} min)
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                
                <div class="flex justify-between mt-8">
                    <button type="button" @click="window.location.href = '{{ route('pasien.appointments.create') }}?poli_id={{ $selectedPoliId }}'" class="px-6 py-3 border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition">← Ganti Dokter</button>
                    <button type="button" @click="step = 4" :disabled="!selectedSchedule || !selectedDate" :class="{'opacity-50 cursor-not-allowed': !selectedSchedule || !selectedDate}" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-red-800 transition">Lanjut →</button>
                </div>
            </div>

            <!-- STEP 4: KONFIRMASI & KELUHAN -->
            <div x-show="step === 4" x-transition:enter.duration.500ms>
                <h3 class="text-xl font-bold mb-6 text-primary">4. Konfirmasi dan Keluhan</h3>
                
                <div class="bg-red-50 p-6 rounded-xl mb-6 border border-red-100 space-y-3">
                    <p class="text-gray-700 font-medium border-b border-red-100 pb-2">
                        Dokter: <span class="font-bold">{{ $selectedDoctorObject->name ?? 'N/A' }}</span>
                    </p>
                    <p class="text-gray-700 font-medium border-b border-red-100 pb-2">
                        Tanggal: <span class="font-bold" x-text="selectedDate"></span>
                    </p>
                    <p class="text-gray-700 font-medium">
                        Jam: <span class="font-bold" x-text="getScheduleTime(selectedSchedule)"></span>
                    </p>
                </div>

                <!-- Input Keluhan -->
                <div class="mb-6">
                    <label for="keluhan" class="block text-sm font-bold text-gray-700 mb-2">Keluhan Utama (Wajib)</label>
                    <textarea id="keluhan" name="keluhan" rows="4" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-red-200 transition shadow-sm" required></textarea>
                </div>

                <!-- Hidden Inputs untuk Data Final -->
                <!-- Nilai input ini akan dikirim ke controller -->
                <input type="hidden" name="dokter_id" :value="selectedDoctor">
                <input type="hidden" name="schedule_id" :value="selectedSchedule">
                <input type="hidden" name="tanggal_booking" :value="selectedDate">
                
                <div class="flex justify-between mt-8">
                    <button type="button" @click="step = 3" class="px-6 py-3 border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-100 transition">← Kembali</button>
                    <button type="submit" class="px-8 py-3 bg-primary text-white font-bold rounded-xl shadow-lg hover:bg-red-800 hover:shadow-red-900/30 transition transform hover:-translate-y-0.5">
                        Kirim Pengajuan
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!-- Script untuk Navigasi Multi-step (yang memaksa reload halaman) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika untuk Step 1 (Poli) - Pindahkan ke fungsi tunggal
            document.querySelectorAll('[x-show="step === 1"] .grid div').forEach(card => {
                card.addEventListener('click', function() {
                    const poliId = card.getAttribute('data-poli-id'); 
                    if (poliId) {
                        // Reload halaman dengan poli_id terpilih
                        window.location.href = '{{ route('pasien.appointments.create') }}?poli_id=' + poliId;
                    }
                });
            });
            
            // Logika untuk Step 2 (Dokter) - Pindahkan ke fungsi tunggal
            document.querySelectorAll('[x-show="step === 2"] .grid div').forEach(card => {
                card.addEventListener('click', function() {
                    const doctorId = card.getAttribute('data-doctor-id');
                    const poliId = card.getAttribute('data-poli-id');

                    if (doctorId) {
                         // Reload halaman dengan poli_id dan dokter_id terpilih
                         window.location.href = '{{ route('pasien.appointments.create') }}?poli_id=' + poliId + '&dokter_id=' + doctorId;
                    }
                });
            });
        });
    </script>
</x-app-layout>