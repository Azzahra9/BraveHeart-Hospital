<x-app-layout>
    <x-slot name="header">
        {{ __('Buat Janji Temu Baru') }}
    </x-slot>

    @php
        // --- LOGIKA PERSIAPAN DATA ---
        $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');
        
        // Ambil ID dari Controller/URL
        $poliId = $selectedPoliId ?? request('poli_id');
        $docId = $doctorId ?? request('dokter_id');

        // Lookup Nama untuk Tampilan
        $poliName = $poliId ? (\App\Models\Poli::find($poliId)->nama_poli ?? '-') : '-';
        $docName = $docId ? (\App\Models\User::find($docId)->name ?? '-') : '-';

        // Tentukan Step Awal
        // Default: Step 1
        $currentStep = 1;
        
        // Jika sudah pilih dokter -> Step 3
        if ($docId) {
            $currentStep = 3; 
        } 
        // Jika baru pilih poli -> Step 2
        elseif ($poliId) {
            $currentStep = 2;
        }

        // Grouping Jadwal (Agar tampil rapi per hari)
        // Menggunakan variable $availableSchedules dari Controller
        $schedulesByDay = isset($availableSchedules) ? $availableSchedules->groupBy('hari') : collect([]);
    @endphp

    {{-- DEBUG PANEL: Hapus bagian ini jika sudah berhasil --}}
    @if($docId)
    <div class="max-w-4xl mx-auto mt-4 p-3 bg-gray-800 text-white text-xs font-mono rounded-lg">
        <strong>DEBUG INFO:</strong><br>
        Dokter ID: {{ $docId }} <br>
        Jadwal Ditemukan: {{ $availableSchedules->count() }} baris data.<br>
        @if($availableSchedules->isEmpty())
            <span class="text-red-400">PENTING: Dokter ini belum membuat jadwal di database! Silakan login sebagai dokter dan buat jadwal.</span>
        @endif
    </div>
    @endif

    <div class="max-w-4xl mx-auto mt-6" x-data="appointmentApp()">
        
        <!-- STEP INDICATOR -->
        <div class="bg-white rounded-2xl p-6 mb-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center text-sm font-bold text-gray-400">
                <div :class="{'text-red-600': step >= 1}">1. Poli</div>
                <div class="flex-1 border-b-2 mx-2" :class="{'border-red-600': step > 1}"></div>
                <div :class="{'text-red-600': step >= 2}">2. Dokter</div>
                <div class="flex-1 border-b-2 mx-2" :class="{'border-red-600': step > 2}"></div>
                <div :class="{'text-red-600': step >= 3}">3. Jadwal</div>
                <div class="flex-1 border-b-2 mx-2" :class="{'border-red-600': step > 3}"></div>
                <div :class="{'text-red-600': step >= 4}">4. Konfirmasi</div>
            </div>
        </div>

        <!-- FORM UTAMA -->
        <form method="POST" action="{{ route('pasien.appointments.store') }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            @csrf

            <!-- STEP 1: PILIH POLI -->
            <div x-show="step === 1" x-transition>
                <h3 class="text-xl font-bold mb-6">Pilih Poli Spesialis</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($polis as $item)
                    <a href="?poli_id={{ $item->id }}" 
                       class="p-4 border-2 rounded-xl text-center hover:border-red-500 hover:bg-red-50 transition {{ $poliId == $item->id ? 'border-red-500 bg-red-50' : 'border-gray-200' }}">
                        <div class="font-bold text-gray-800">{{ $item->nama_poli }}</div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- STEP 2: PILIH DOKTER -->
            <div x-show="step === 2" x-transition>
                <h3 class="text-xl font-bold mb-4">Pilih Dokter</h3>
                <p class="mb-6 text-sm text-gray-500">Poli: <span class="font-bold text-gray-800">{{ $poliName }}</span></p>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse($availableDoctors as $doc)
                    <a href="?poli_id={{ $poliId }}&dokter_id={{ $doc->id }}" 
                       class="p-4 border-2 rounded-xl text-center hover:border-red-500 hover:bg-red-50 transition {{ $docId == $doc->id ? 'border-red-500 bg-red-50' : 'border-gray-200' }}">
                        <div class="font-bold text-gray-800">{{ $doc->name }}</div>
                        <div class="text-xs text-gray-500">Dokter Spesialis</div>
                    </a>
                    @empty
                    <div class="col-span-3 text-center py-8 text-gray-400 border-2 border-dashed rounded-xl">
                        Tidak ada dokter di poli ini.
                    </div>
                    @endforelse
                </div>
                <div class="mt-6">
                    <a href="?" class="text-red-600 text-sm hover:underline">← Ganti Poli</a>
                </div>
            </div>

            <!-- STEP 3: PILIH JADWAL (MASALAH DISINI SEBELUMNYA) -->
            <div x-show="step === 3" x-transition>
                <h3 class="text-xl font-bold mb-4">Pilih Waktu Konsultasi</h3>
                <p class="mb-6 text-sm text-gray-500">Dokter: <span class="font-bold text-gray-800">{{ $docName }}</span></p>

                <!-- Input Tanggal -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Rencana</label>
                    <input type="date" x-model="selectedDate" min="{{ $tomorrow }}" class="w-full md:w-1/2 p-3 border rounded-xl focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Daftar Jadwal -->
                <div class="space-y-6">
                    @if($schedulesByDay->isEmpty())
                        {{-- Jika Controller mengirim data kosong --}}
                        <div class="p-6 bg-orange-50 text-orange-800 rounded-xl border border-orange-200 text-center">
                            <strong>Jadwal Kosong</strong><br>
                            Dokter ini belum mengatur jadwal praktiknya. Silakan pilih dokter lain.
                        </div>
                    @else
                        {{-- Loop Jadwal --}}
                        @foreach($schedulesByDay as $hari => $listJadwal)
                            <div>
                                <h4 class="font-bold text-gray-800 mb-3 border-b pb-1">{{ ucfirst($hari) }}</h4>
                                <div class="flex flex-wrap gap-3">
                                    @foreach($listJadwal as $jadwal)
                                        <div @click="selectSchedule({{ $jadwal->id }}, '{{ substr($jadwal->jam_mulai, 0, 5) }}')"
                                             class="px-4 py-3 border-2 rounded-xl cursor-pointer transition select-none"
                                             :class="scheduleId == {{ $jadwal->id }} ? 'bg-red-600 text-white border-red-600 shadow-md' : 'hover:border-red-400 bg-white'">
                                            
                                            <div class="font-bold text-sm">
                                                {{ substr($jadwal->jam_mulai, 0, 5) }} WIB
                                            </div>
                                            <div class="text-xs opacity-75">
                                                Durasi: {{ $jadwal->durasi }} Menit
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="?poli_id={{ $poliId }}" class="text-gray-500 hover:text-red-600">← Ganti Dokter</a>
                    <button type="button" @click="step = 4" :disabled="!scheduleId || !selectedDate" 
                            class="px-6 py-3 bg-red-600 text-white font-bold rounded-xl disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:bg-red-700 transition">
                        Lanjut Konfirmasi →
                    </button>
                </div>
            </div>

            <!-- STEP 4: KONFIRMASI -->
            <div x-show="step === 4" x-transition>
                <h3 class="text-xl font-bold mb-6 text-red-600">Konfirmasi Janji Temu</h3>
                
                <div class="bg-red-50 p-6 rounded-xl border border-red-100 mb-6 text-sm space-y-2">
                    <div class="flex justify-between border-b border-red-200 pb-2">
                        <span class="text-gray-600">Dokter</span>
                        <span class="font-bold text-gray-900">{{ $docName }}</span>
                    </div>
                    <div class="flex justify-between border-b border-red-200 pb-2">
                        <span class="text-gray-600">Poli</span>
                        <span class="font-bold text-gray-900">{{ $poliName }}</span>
                    </div>
                    <div class="flex justify-between border-b border-red-200 pb-2">
                        <span class="text-gray-600">Tanggal</span>
                        <span class="font-bold text-gray-900" x-text="selectedDate"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jam Mulai</span>
                        <span class="font-bold text-gray-900" x-text="scheduleTime"></span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block font-bold text-gray-700 mb-2">Keluhan (Wajib Diisi)</label>
                    <textarea name="keluhan" rows="3" class="w-full border-gray-300 rounded-xl focus:ring-red-500 focus:border-red-500" required placeholder="Jelaskan gejala yang Anda rasakan..."></textarea>
                </div>

                {{-- Hidden Inputs untuk dikirim ke Controller --}}
                <input type="hidden" name="dokter_id" value="{{ $docId }}">
                <input type="hidden" name="schedule_id" :value="scheduleId">
                <input type="hidden" name="tanggal_booking" :value="selectedDate">

                <div class="flex justify-between mt-8">
                    <button type="button" @click="step = 3" class="text-gray-500 hover:text-red-600">← Kembali</button>
                    <button type="submit" class="px-8 py-3 bg-red-600 text-white font-bold rounded-xl shadow-lg hover:bg-red-700 transition">
                        Kirim Sekarang
                    </button>
                </div>
            </div>

        </form>
    </div>

    {{-- SCRIPT JAVASCRIPT DIPISAH AGAR LEBIH STABIL --}}
    <script>
        function appointmentApp() {
            return {
                step: {{ $currentStep }},
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