<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienAppointmentController extends Controller
{
    // Menampilkan daftar janji temu pasien (riwayat)
    public function index()
    {
        $appointments = Appointment::with(['dokter.poli', 'schedule'])
            ->where('pasien_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pasien.appointments.index', compact('appointments'));
    }

    // Menampilkan FORM CREATE APPOINTMENT
    public function create(Request $request)
    {
        $polis = Poli::all();
        $selectedPoliId = $request->input('poli_id');
        $availableDoctors = collect([]);
        $availableSchedules = collect([]);

        if ($selectedPoliId) {
            // Filter Dokter berdasarkan Poli
            $availableDoctors = User::with('poli')
                ->where('role', 'dokter')
                ->where('poli_id', $selectedPoliId)
                ->get();
        }

        // Jika dokter sudah dipilih, ambil jadwalnya
        if ($doctorId = $request->input('dokter_id')) {
            // Ambil jadwal mingguan dokter tersebut
            $availableSchedules = Schedule::where('dokter_id', $doctorId)->get();
        }

        return view('pasien.appointments.create', compact('polis', 'availableDoctors', 'availableSchedules', 'selectedPoliId', 'doctorId'));
    }

    // Menyimpan Janji Temu (Booking)
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'keluhan' => 'required|string|max:500',
        ]);

        // Cek apakah pasien sudah memiliki janji temu pending/approved
        $exists = Appointment::where('pasien_id', Auth::id())
            ->whereIn('status', ['Pending', 'Approved'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah memiliki janji temu yang aktif. Mohon tunggu konfirmasi yang sudah ada.');
        }

        Appointment::create([
            'pasien_id' => Auth::id(),
            'dokter_id' => $request->dokter_id,
            'schedule_id' => $request->schedule_id,
            'tanggal_booking' => $request->tanggal_booking,
            'keluhan' => $request->keluhan,
            'status' => 'Pending', // Status awal selalu pending
        ]);

        return redirect()->route('pasien.appointments.index')->with('success', 'Janji temu berhasil diajukan! Menunggu validasi dokter/admin.');
    }
}