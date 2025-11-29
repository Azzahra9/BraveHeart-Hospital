<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DokterAppointmentController extends Controller
{
    /**
     * Menampilkan daftar janji temu untuk dokter yang login
     */
    public function index(Request $request)
    {
        // 1. Hitung statistik ringkas (Tetap hitung total global, tidak terpengaruh search)
        $pendingCount = Appointment::where('dokter_id', Auth::id())
            ->where('status', 'Pending')
            ->count();

        $todayCount = Appointment::where('dokter_id', Auth::id())
            ->where('status', 'Approved')
            ->whereDate('tanggal_booking', Carbon::today())
            ->count();

        // 2. Ambil daftar appointment dengan Filter Pencarian
        $appointments = Appointment::with(['pasien', 'schedule', 'medicalRecord']) // Load relasi medicalRecord
            ->where('dokter_id', Auth::id())
            // Logika Pencarian: Jika ada parameter 'search', cari berdasarkan nama pasien
            ->when($request->search, function ($query, $search) {
                return $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('tanggal_booking', 'desc')
            ->paginate(10);

        return view('dokter.appointments.index', compact('appointments', 'pendingCount', 'todayCount'));
    }

    /**
     * Update status janji temu (Approve / Reject)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $appointment = Appointment::where('id', $id)
            ->where('dokter_id', Auth::id())
            ->firstOrFail();

        $appointment->update([
            'status' => $request->status
        ]);

        $message = $request->status == 'Approved' ? 'Janji temu disetujui.' : 'Janji temu ditolak.';

        return redirect()->back()->with('success', $message);
    }
}