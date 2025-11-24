<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GuestController extends Controller
{
    /**
     * Menampilkan halaman depan (Landing Page)
     */
    public function index()
    {
        // Ambil 3 poli untuk ditampilkan di halaman depan
        $polis = Poli::take(3)->get();
        
        // Ambil 4 dokter untuk ditampilkan di halaman depan
        $dokters = User::with('poli')
            ->where('role', 'dokter')
            ->inRandomOrder() // Acak agar tampilan berbeda
            ->take(4)
            ->get();

        return view('welcome', compact('polis', 'dokters'));
    }

    /**
     * Menampilkan daftar semua poli
     */
    public function polis()
    {
        $polis = Poli::all();
        return view('guest.polis', compact('polis'));
    }
    
    /**
     * Menampilkan detail satu poli spesifik
     */
    public function showPoli($id)
    {
        $poli = Poli::findOrFail($id);
        // Ambil dokter yang bekerja di poli ini
        $dokters = User::where('role', 'dokter')->where('poli_id', $id)->get();
        
        return view('guest.poli-detail', compact('poli', 'dokters'));
    }

    /**
     * Menampilkan daftar semua dokter dengan fitur filtering.
     */
    public function dokters(Request $request)
    {
        $search = $request->input('search');
        $poliId = $request->input('poli_id');
        $hari = $request->input('hari');

        $doktersQuery = User::with(['poli', 'schedules'])
            ->where('role', 'dokter');
        
        // --- LOGIC FILTERING ---
        if ($search) {
            $doktersQuery->where('name', 'like', '%' . $search . '%');
        }

        if ($poliId) {
            $doktersQuery->where('poli_id', $poliId);
        }

        if ($hari) {
            // Filter dokter yang memiliki jadwal di hari tersebut
            $dokterIdsWithSchedule = Schedule::where('hari', $hari)->pluck('dokter_id')->unique();
            $doktersQuery->whereIn('id', $dokterIdsWithSchedule);
        }
        // --- END LOGIC FILTERING ---

        $dokters = $doktersQuery->paginate(12)->appends($request->query());
        $polis = Poli::all();
        $listHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('guest.dokter', compact('dokters', 'polis', 'listHari', 'search', 'poliId', 'hari'));
    }
}