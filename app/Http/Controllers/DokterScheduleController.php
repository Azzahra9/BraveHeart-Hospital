<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon untuk manipulasi waktu

class DokterScheduleController extends Controller
{
    /**
     * Menampilkan daftar jadwal praktik dokter yang sedang login
     */
    public function index()
    {
        // Ambil jadwal milik dokter yang sedang login, urutkan berdasarkan hari (custom sorting bisa ditambahkan jika perlu)
        // Kita urutkan field 'hari' secara string sederhana, atau bisa dibuat map khusus
        $schedules = Schedule::where('dokter_id', Auth::id())
                        ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
                        ->orderBy('jam_mulai')
                        ->get();
        
        return view('dokter.schedules.index', compact('schedules'));
    }

    /**
     * Form tambah jadwal
     */
    public function create()
    {
        return view('dokter.schedules.create');
    }

    /**
     * Simpan jadwal baru
     */
    public function store(Request $request)
    {
        // 1. Definisikan Pesan Error Kustom
        $messages = [
            'hari.required' => 'Hari wajib dipilih.',
            'hari.in' => 'Pilihan hari tidak valid.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Format jam harus HH:MM (contoh: 09:00).',
            'durasi.required' => 'Durasi praktik wajib diisi.',
            'durasi.integer' => 'Durasi harus berupa angka.',
            'durasi.min' => 'Durasi minimal 15 menit.',
            'durasi.max' => 'Durasi maksimal 120 menit (2 jam).',
        ];

        // 2. Validasi Input Dasar
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:15|max:120', // Durasi dalam menit
        ], $messages);

        // 3. Validasi Tumpang Tindih (Overlap)
        if ($this->isScheduleOverlapping($request)) {
            return back()
                ->withErrors(['jam_mulai' => 'Jadwal bertabrakan dengan jadwal Anda yang lain di hari ' . $request->hari . '.'])
                ->withInput();
        }

        // 4. Simpan ke Database
        Schedule::create([
            'dokter_id' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('dokter.schedules.index')
                         ->with('success', 'Jadwal praktik berhasil ditambahkan!');
    }

    /**
     * Form edit jadwal
     */
    public function edit(Schedule $schedule)
    {
        // Pastikan jadwal ini milik dokter yang login
        if ($schedule->dokter_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengedit jadwal ini.');
        }

        return view('dokter.schedules.edit', compact('schedule'));
    }

    /**
     * Update jadwal
     */
    public function update(Request $request, Schedule $schedule)
    {
        // Proteksi otorisasi
        if ($schedule->dokter_id !== Auth::id()) {
            abort(403);
        }

        // 1. Pesan Error
        $messages = [
            'hari.required' => 'Hari wajib dipilih.',
            'hari.in' => 'Pilihan hari tidak valid.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Format jam harus HH:MM.',
            'durasi.required' => 'Durasi wajib diisi.',
            'durasi.integer' => 'Durasi harus berupa angka.',
            'durasi.min' => 'Durasi minimal 15 menit.',
            'durasi.max' => 'Durasi maksimal 120 menit.',
        ];

        // 2. Validasi Input
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:15|max:120',
        ], $messages);

        // 3. Validasi Tumpang Tindih (Exclude jadwal yang sedang diedit)
        if ($this->isScheduleOverlapping($request, $schedule->id)) {
            return back()
                ->withErrors(['jam_mulai' => 'Jadwal bertabrakan dengan jadwal Anda yang lain di hari tersebut.'])
                ->withInput();
        }

        // 4. Update Database
        $schedule->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('dokter.schedules.index')
                         ->with('success', 'Jadwal praktik berhasil diperbarui!');
    }

    /**
     * Hapus jadwal
     */
    public function destroy(Schedule $schedule)
    {
        if ($schedule->dokter_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah jadwal sedang dipakai di appointment yang aktif (Pending/Approved)
        // Jika ada, sebaiknya dilarang hapus.
        $hasActiveAppointments = \App\Models\Appointment::where('schedule_id', $schedule->id)
            ->whereIn('status', ['Pending', 'Approved'])
            ->exists();

        if ($hasActiveAppointments) {
            return back()->with('error', 'Gagal menghapus! Jadwal ini sedang digunakan oleh pasien yang memiliki janji temu aktif.');
        }

        $schedule->delete();

        return redirect()->route('dokter.schedules.index')
                         ->with('success', 'Jadwal berhasil dihapus!');
    }

    /**
     * FUNGSI BANTUAN: Cek apakah jadwal bertabrakan
     * Return true jika overlap, false jika aman.
     */
    private function isScheduleOverlapping($request, $ignoreId = null)
    {
        // FIX ERROR: Tambahkan (int) casting agar Carbon menerima integer, bukan string
        $durasi = (int) $request->durasi; 

        // Konversi input baru ke objek Carbon (gunakan tanggal dummy hari ini agar bisa dibandingkan jamnya)
        $newStart = Carbon::parse($request->jam_mulai);
        $newEnd = Carbon::parse($request->jam_mulai)->addMinutes($durasi);

        // Ambil semua jadwal dokter ini di hari yang sama
        $query = Schedule::where('dokter_id', Auth::id())
                         ->where('hari', $request->hari);

        // Jika sedang update, jangan bandingkan dengan dirinya sendiri
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $existingSchedules = $query->get();

        foreach ($existingSchedules as $schedule) {
            // Konversi jadwal yang ada di DB ke Carbon
            // Pastikan durasi dari DB juga di-cast ke int untuk keamanan
            $existingDurasi = (int) $schedule->durasi;

            $existingStart = Carbon::parse($schedule->jam_mulai);
            $existingEnd = Carbon::parse($schedule->jam_mulai)->addMinutes($existingDurasi);

            // LOGIKA OVERLAP:
            // (StartA < EndB) && (EndA > StartB)
            if ($newStart->lt($existingEnd) && $newEnd->gt($existingStart)) {
                return true; // Bertabrakan
            }
        }

        return false; // Aman
    }
}