<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    /**
     * Menampilkan daftar janji temu (Appointment)
     */
    public function index()
    {
        // Ambil semua appointment, urutkan dari yang terbaru
        $appointments = Appointment::with(['pasien', 'dokter', 'schedule'])
                                   ->latest()
                                   ->paginate(10);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Menyetujui (Approve) Janji Temu
     */
    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Ubah status menjadi Approved
        $appointment->update(['status' => 'Approved']);

        return redirect()->route('admin.appointments.index')
                         ->with('success', 'Janji temu berhasil disetujui (Approved)!');
    }
    
    /**
     * Menolak (Reject) Janji Temu
     */
    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        $appointment->update(['status' => 'Rejected']);

        return redirect()->route('admin.appointments.index')
                         ->with('error', 'Janji temu telah ditolak.');
    }
}