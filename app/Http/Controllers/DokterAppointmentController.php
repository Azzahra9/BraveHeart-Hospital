<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterAppointmentController extends Controller
{
    /**
     * Menampilkan daftar janji temu khusus dokter yang login
     */
    public function index()
    {
        // Ambil appointment dimana dokter_id adalah user yang login
        $appointments = Appointment::with(['pasien', 'schedule'])
                                   ->where('dokter_id', Auth::id())
                                   ->latest()
                                   ->paginate(10);

        // Hitung statistik sederhana untuk dashboard kecil di atas tabel
        $pendingCount = Appointment::where('dokter_id', Auth::id())->where('status', 'Pending')->count();
        $todayCount = Appointment::where('dokter_id', Auth::id())
                                 ->where('status', 'Approved')
                                 ->whereDate('tanggal_booking', today())
                                 ->count();

        return view('dokter.appointments.index', compact('appointments', 'pendingCount', 'todayCount'));
    }

    /**
     * Update status janji temu (Approve / Reject / Selesai)
     */
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::where('id', $id)->where('dokter_id', Auth::id())->firstOrFail();

        $request->validate([
            'status' => 'required|in:Approved,Rejected,Selesai',
        ]);

        $appointment->update([
            'status' => $request->status
        ]);

        $message = 'Status janji temu berhasil diperbarui menjadi ' . $request->status;
        
        return redirect()->back()->with('success', $message);
    }
}