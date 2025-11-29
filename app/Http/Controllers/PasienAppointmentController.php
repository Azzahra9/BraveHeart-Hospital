<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienAppointmentController extends Controller
{
    /**
     * Menampilkan daftar riwayat/status janji temu pasien
     * (Function ini yang sebelumnya hilang)
     */
    public function index()
    {
        $appointments = Appointment::with(['dokter.poli', 'schedule'])
            ->where('pasien_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pasien.appointments.index', compact('appointments'));
    }

    /**
     * Menampilkan Form Buat Janji Temu
     */
    public function create(Request $request)
    {
        // 1. Ambil data Poli untuk dropdown
        $polis = Poli::all();
        
        // 2. Siapkan variabel default
        $availableDoctors = collect([]);
        $availableSchedules = collect([]); 
        
        // 3. Ambil parameter dari URL
        $selectedPoliId = $request->input('poli_id');
        $doctorId = $request->input('dokter_id');

        // 4. Logika: Jika Poli sudah dipilih, cari dokternya
        if ($selectedPoliId) {
            $availableDoctors = User::with('poli')
                ->where('role', 'dokter')
                ->where('poli_id', $selectedPoliId)
                ->get();
        }

        // 5. Logika: Jika Dokter sudah dipilih, cari jadwalnya
        if ($doctorId) {
            $availableSchedules = Schedule::where('dokter_id', $doctorId)->get();
        }

        // 6. Kirim ke View
        return view('pasien.appointments.create', compact(
            'polis', 
            'availableDoctors', 
            'availableSchedules', 
            'selectedPoliId', 
            'doctorId'
        ));
    }

    /**
     * Menyimpan data janji temu ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'tanggal_booking' => 'required|date|after_or_equal:tomorrow',
            'keluhan' => 'required|string|max:500',
        ]);

        // Validasi 1: Cek apakah pasien punya janji aktif (Pending/Approved)
        $patientActiveAppointment = Appointment::where('pasien_id', Auth::id())
            ->whereIn('status', ['Pending', 'Approved'])
            ->exists();

        if ($patientActiveAppointment) {
            return back()->with('error', 'Anda masih memiliki janji temu yang aktif/belum selesai.');
        }

        // Validasi 2: Cek tabrakan jadwal (Dokter sama, Jadwal sama, Tanggal sama)
        $collision = Appointment::where('dokter_id', $request->dokter_id)
            ->where('schedule_id', $request->schedule_id)
            ->whereDate('tanggal_booking', $request->tanggal_booking)
            ->whereIn('status', ['Pending', 'Approved'])
            ->exists();
        
        if ($collision) {
             return back()->with('error', 'Slot jadwal pada tanggal tersebut sudah penuh/diambil orang lain.');
        }

        // Simpan Data
        Appointment::create([
            'pasien_id' => Auth::id(),
            'dokter_id' => $request->dokter_id,
            'schedule_id' => $request->schedule_id,
            'tanggal_booking' => $request->tanggal_booking,
            'keluhan' => $request->keluhan,
            'status' => 'Pending',
        ]);

        // Redirect ke halaman index (Riwayat)
        return redirect()->route('pasien.appointments.index')
            ->with('success', 'Janji temu berhasil diajukan! Menunggu konfirmasi dokter.');
    }
}