<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. PUBLIC ROUTES (GUEST) ---
Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/poli-layanan', [GuestController::class, 'polis'])->name('guest.polis');
Route::get('/poli-layanan/{id}', [GuestController::class, 'showPoli'])->name('guest.poli.show');
Route::get('/cari-dokter', [GuestController::class, 'dokters'])->name('guest.dokter');


// --- 2. DASHBOARD REDIRECT (LOGIC) ---
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'dokter') {
        return redirect()->route('dokter.dashboard');
    } else {
        return redirect()->route('pasien.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


// --- 3. ROUTE GROUP: ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        $data = [
            'total_pasien' => User::where('role', 'pasien')->count(),
            'total_dokter' => User::where('role', 'dokter')->count(),
            'pending_appointments' => Appointment::where('status', 'Pending')->count(),
            'today_appointments' => Appointment::whereDate('tanggal_booking', Carbon::today())->count(),
            'latest_appointments' => Appointment::with(['pasien', 'dokter'])->latest()->take(5)->get(),
        ];
        return view('admin.dashboard', $data);
    })->name('dashboard');

    // Master Data
    Route::resource('users', \App\Http\Controllers\AdminUserController::class);
    Route::resource('polis', \App\Http\Controllers\AdminPoliController::class);
    Route::resource('medicines', \App\Http\Controllers\AdminMedicineController::class);
    
    // Fitur Tambahan Admin
    Route::get('/patients', [\App\Http\Controllers\AdminUserController::class, 'patients'])->name('patients.index');
    Route::get('/appointments', [\App\Http\Controllers\AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{id}/approve', [\App\Http\Controllers\AdminAppointmentController::class, 'approve'])->name('appointments.approve');
    Route::patch('/appointments/{id}/reject', [\App\Http\Controllers\AdminAppointmentController::class, 'reject'])->name('appointments.reject');
});


// --- 4. ROUTE GROUP: DOKTER ---
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    
    // Dashboard Dokter (MENGIRIM DATA GRAFIK & REAL REVENUE)
    Route::get('/dashboard', function () {
        $dokterId = Auth::id();
        $bulan = [];
        $data_periksa = [];
        $data_pending = [];
        
        // Asumsi Biaya per Tindakan (Rp 200.000)
        $BIAYA_TINDAKAN = 200000;
        
        // 1. GENERATE DATA GRAFIK UNTUK CHART.JS (6 BULAN TERAKHIR)
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulan[] = $date->translatedFormat('M');

            $count_periksa = MedicalRecord::where('dokter_id', $dokterId)
                ->whereMonth('tanggal', $date->month)
                ->whereYear('tanggal', $date->year)
                ->count();
                
            $data_periksa[] = $count_periksa;
                
            $data_pending[] = Appointment::where('dokter_id', $dokterId)
                ->whereIn('status', ['Pending', 'Approved'])
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        // 2. DATA STATISTIK CARD
        $todayAppointments = Appointment::where('dokter_id', $dokterId)
            ->where('status', 'Approved')
            ->whereDate('tanggal_booking', Carbon::today())
            ->count();

        $myPendingCount = Appointment::where('dokter_id', $dokterId)
            ->where('status', 'Pending')
            ->count();
        
        // HITUNG DATA REAL BARU
        $totalRecords = MedicalRecord::where('dokter_id', $dokterId)->count();
        $totalRevenue = $totalRecords * $BIAYA_TINDAKAN;

        // 3. Data Tabel (5 appointment terbaru)
        $appointments = Appointment::with('pasien')
            ->where('dokter_id', $dokterId)
            ->latest()
            ->take(5)
            ->get();

        // 4. Data Pasien Terakhir Diperiksa
        $lastPatients = MedicalRecord::with('pasien')
            ->where('dokter_id', $dokterId)
            ->latest('tanggal')
            ->take(5)
            ->get();

        return view('dokter.dashboard', compact(
            'todayAppointments', 
            'myPendingCount', 
            'appointments', 
            'lastPatients',
            'bulan', 
            'data_periksa', 
            'data_pending',
            'totalRecords', 
            'totalRevenue'  
        ));
    })->name('dashboard');

    Route::resource('schedules', \App\Http\Controllers\DokterScheduleController::class);
    
    Route::get('/appointments', [\App\Http\Controllers\DokterAppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{id}/status', [\App\Http\Controllers\DokterAppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');

    Route::resource('medical-records', \App\Http\Controllers\DokterMedicalRecordController::class);
});


// --- 5. ROUTE GROUP: PASIEN ---
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    
    // Dashboard Pasien (MENGIRIM DATA PASIEN)
    Route::get('/dashboard', function () {
        $pasienId = Auth::id();

        // Data Janji Temu Terbaru
        $latestAppointment = Appointment::with(['dokter.poli', 'schedule'])
            ->where('pasien_id', $pasienId)
            ->latest()
            ->first();
        
        // Data Riwayat Medis Singkat
        $lastRecord = MedicalRecord::with(['dokter', 'appointment'])
            ->where('pasien_id', $pasienId)
            ->latest('tanggal')
            ->first();

        // Dokter yang Direkomendasikan/Tersedia (Ambil 4 Dokter teratas)
        $availableDoctors = User::with('poli')
            ->where('role', 'dokter')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('pasien.dashboard', compact('latestAppointment', 'lastRecord', 'availableDoctors'));
    })->name('dashboard');

    // Appointments (Booking)
    Route::resource('appointments', \App\Http\Controllers\PasienAppointmentController::class)->only(['index', 'create', 'store', 'show']);
    Route::patch('/appointments/{id}/cancel', [\App\Http\Controllers\PasienAppointmentController::class, 'cancel'])->name('appointments.cancel');

    // Medical Records
    Route::get('/my-medical-records', [\App\Http\Controllers\PasienMedicalRecordController::class, 'index'])->name('medical-records.index');
    Route::get('/my-medical-records/{id}', [\App\Http\Controllers\PasienMedicalRecordController::class, 'show'])->name('medical-records.show');
});


// --- 6. PROFILE ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';