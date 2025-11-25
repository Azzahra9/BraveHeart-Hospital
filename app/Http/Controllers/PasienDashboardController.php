<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Poli;
use App\Models\User; // Import Model User
use Illuminate\Support\Facades\Auth;

class PasienDashboardController extends Controller
{
    public function index(Request $request)
    {
        $pasienId = Auth::id();
        $search = $request->input('search');
        $poliId = $request->input('poli_id');

        // 1. Query Dasar: Janji Temu Saya
        $query = Appointment::with(['dokter', 'schedule', 'dokter.poli'])
                            ->where('pasien_id', $pasienId);

        // Logika Pencarian
        if ($search) {
            $query->whereHas('dokter', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Logika Filter Poli
        if ($poliId) {
            $query->whereHas('dokter', function($q) use ($poliId) {
                $q->where('poli_id', $poliId);
            });
        }

        $appointments = $query->latest()->paginate(5)->withQueryString();

        // 2. Statistik
        $total_appointment = Appointment::where('pasien_id', $pasienId)->count();
        $pending_count = Appointment::where('pasien_id', $pasienId)->where('status', 'Pending')->count();
        $medical_records_count = MedicalRecord::where('pasien_id', $pasienId)->count();
        $last_appointment = Appointment::where('pasien_id', $pasienId)->latest()->first();
        
        // 3. Data Pendukung
        $polis = Poli::all(); 

        // 4. DOKTER TERSEDIA (Fitur Baru)
        // Mengambil 4 dokter secara acak untuk rekomendasi
        $availableDoctors = User::with('poli')
                                ->where('role', 'dokter')
                                ->inRandomOrder()
                                ->take(4)
                                ->get();

        return view('pasien.dashboard', compact(
            'appointments', 
            'search', 
            'poliId',
            'polis',
            'total_appointment',
            'pending_count',
            'medical_records_count',
            'last_appointment',
            'availableDoctors' // Kirim data dokter ke view
        ));
    }
}