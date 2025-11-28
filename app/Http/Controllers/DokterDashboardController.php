<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DokterDashboardController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();
        $today = Carbon::today();

        // 1. Statistik Kartu Atas
        $todayAppointments = Appointment::where('dokter_id', $dokterId)
            ->where('status', 'Approved')
            ->whereDate('tanggal_booking', $today)
            ->count();

        $myPendingCount = Appointment::where('dokter_id', $dokterId)
            ->where('status', 'Pending')
            ->count();

        $totalRecords = MedicalRecord::where('dokter_id', $dokterId)->count();

        // Asumsi Revenue: Rp 150.000 per pasien selesai (Bisa disesuaikan)
        $totalRevenue = $totalRecords * 150000; 

        // 2. Data Grafik (6 Bulan Terakhir)
        $bulan = [];
        $data_periksa = [];
        $data_pending = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M');
            $monthNum = $date->month;
            $yearNum = $date->year;

            $bulan[] = $monthName;

            $data_periksa[] = MedicalRecord::where('dokter_id', $dokterId)
                ->whereMonth('created_at', $monthNum)
                ->whereYear('created_at', $yearNum)
                ->count();

            $data_pending[] = Appointment::where('dokter_id', $dokterId)
                ->whereMonth('created_at', $monthNum)
                ->whereYear('created_at', $yearNum)
                ->count();
        }

        // 3. Tabel & List (Eager Loading untuk performa)
        $appointments = Appointment::with(['pasien', 'schedule'])
            ->where('dokter_id', $dokterId)
            ->latest()
            ->get();

        $lastPatients = MedicalRecord::with('pasien')
            ->where('dokter_id', $dokterId)
            ->latest()
            ->take(5)
            ->get();

        return view('dokter.dashboard', compact(
            'todayAppointments',
            'myPendingCount',
            'totalRecords',
            'totalRevenue',
            'bulan',
            'data_periksa',
            'data_pending',
            'appointments',
            'lastPatients'
        ));
    }
}