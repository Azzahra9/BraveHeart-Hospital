<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
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
    
    // Dashboard Admin (Bisa tetap di sini atau dipindah ke controller biar rapi)
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
    
    // ✅ PERBAIKAN: Gunakan Controller agar grafik tidak error
    Route::get('/dashboard', [\App\Http\Controllers\DokterDashboardController::class, 'index'])->name('dashboard');

    Route::resource('schedules', \App\Http\Controllers\DokterScheduleController::class);
    
    Route::get('/appointments', [\App\Http\Controllers\DokterAppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{id}/status', [\App\Http\Controllers\DokterAppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');

    Route::resource('medical-records', \App\Http\Controllers\DokterMedicalRecordController::class);
});


// --- 5. ROUTE GROUP: PASIEN ---
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    
    // ✅ PERBAIKAN: Gunakan Controller agar fitur Search berfungsi
    Route::get('/dashboard', [\App\Http\Controllers\PasienDashboardController::class, 'index'])->name('dashboard');

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