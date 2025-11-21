<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Menampilkan halaman depan (Welcome)
     */
    public function index()
    {
        // Ambil 3 poli untuk ditampilkan di halaman depan
        $polis = Poli::take(3)->get();
        
        // Ambil 4 dokter untuk ditampilkan di halaman depan
        $dokters = User::where('role', 'dokter')->with('poli')->take(4)->get();

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
     * INI YANG HILANG TADI
     */
    public function showPoli($id)
    {
        // Cari poli berdasarkan ID, jika tidak ada tampilkan 404
        $poli = Poli::findOrFail($id);
        
        // Ambil dokter yang bekerja di poli ini
        $dokters = User::where('role', 'dokter')
                       ->where('poli_id', $id)
                       ->get();
        
        // Tampilkan view detail
        return view('guest.poli-detail', compact('poli', 'dokters'));
    }

    /**
     * Menampilkan daftar semua dokter
     */
    public function dokters()
    {
        $dokters = User::where('role', 'dokter')->with('poli')->get();
        return view('guest.dokter', compact('dokters'));
    }
}