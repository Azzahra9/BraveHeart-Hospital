<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poli;
use App\Models\Medicine;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. DATA KARTU UTAMA (Sesuai kode lama Anda)
        $totalPasien = User::where('role', 'pasien')->count();
        $totalDokter = User::where('role', 'dokter')->count();
        $pendingAppointments = Appointment::where('status', 'Pending')->count();
        $jadwalHariIni = Appointment::whereDate('tanggal_booking', Carbon::today())->count(); // Menggunakan Carbon

        // Data tambahan untuk tabel permintaan terbaru
        $latestAppointments = Appointment::with(['pasien', 'dokter'])->latest()->take(5)->get();

        // ---------------------------------------------------------
        // 2. FITUR BARU: ANALITIK & LAPORAN OPERASIONAL
        // ---------------------------------------------------------

        // A. STATISTIK PASIEN PER POLI
        // Menghitung jumlah pasien appointment berdasarkan Poli dokter
        $poliStats = DB::table('appointments')
            ->join('users', 'appointments.dokter_id', '=', 'users.id') 
            ->join('polis', 'users.poli_id', '=', 'polis.id')          
            ->select('polis.nama_poli', DB::raw('count(*) as total_pasien'))
            ->groupBy('polis.nama_poli')
            ->orderByDesc('total_pasien')
            ->get();

        // B. LAPORAN KINERJA DOKTER
        // Dokter dengan pasien selesai terbanyak
        $dokterPerformance = User::where('role', 'dokter')
            ->withCount(['appointments as total_selesai' => function ($query) {
                $query->whereIn('status', ['Selesai', 'Approved']); 
            }])
            ->orderByDesc('total_selesai')
            ->take(5)
            ->get();

        // C. ANALISIS OBAT TERLARIS
        // Obat yang paling sering diresepkan
        $topMedicines = DB::table('prescriptions')
            ->join('medicines', 'prescriptions.medicine_id', '=', 'medicines.id')
            ->select('medicines.nama', 'medicines.stok', DB::raw('sum(prescriptions.jumlah) as total_terjual'))
            ->groupBy('medicines.id', 'medicines.nama', 'medicines.stok')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();

        // 3. Kirim semua variable ke View
        // Perhatikan nama variabel disini harus sama dengan yang dipanggil di View blade
        return view('admin.dashboard', [
            'totalPasien' => $totalPasien, 
            'totalDokter' => $totalDokter, 
            'pendingAppointments' => $pendingAppointments, 
            'jadwalHariIni' => $jadwalHariIni,
            'latest_appointments' => $latestAppointments, // Variabel lama Anda
            'poliStats' => $poliStats,                    // Variabel BARU
            'dokterPerformance' => $dokterPerformance,    // Variabel BARU
            'topMedicines' => $topMedicines               // Variabel BARU
        ]);
    }
}