<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterScheduleController extends Controller
{
    /**
     * Menampilkan daftar jadwal praktik dokter yang sedang login
     */
    public function index()
    {
        // Ambil jadwal milik dokter yang sedang login
        $schedules = Schedule::where('dokter_id', Auth::id())->orderBy('hari')->get();
        
        return view('dokter.schedules.index', compact('schedules'));
    }

    /**
     * Form tambah jadwal
     */
    public function create()
    {
        return view('dokter.schedules.create');
    }

    /**
     * Simpan jadwal baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:15|max:120', // Durasi dalam menit
        ]);

        Schedule::create([
            'dokter_id' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('dokter.schedules.index')
                         ->with('success', 'Jadwal praktik berhasil ditambahkan!');
    }

    /**
     * Form edit jadwal
     */
    public function edit(Schedule $schedule)
    {
        // Pastikan jadwal ini milik dokter yang login
        if ($schedule->dokter_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengedit jadwal ini.');
        }

        return view('dokter.schedules.edit', compact('schedule'));
    }

    /**
     * Update jadwal
     */
    public function update(Request $request, Schedule $schedule)
    {
        if ($schedule->dokter_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:15|max:120',
        ]);

        $schedule->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('dokter.schedules.index')
                         ->with('success', 'Jadwal praktik berhasil diperbarui!');
    }

    /**
     * Hapus jadwal
     */
    public function destroy(Schedule $schedule)
    {
        if ($schedule->dokter_id !== Auth::id()) {
            abort(403);
        }

        $schedule->delete();

        return redirect()->route('dokter.schedules.index')
                         ->with('success', 'Jadwal berhasil dihapus!');
    }
}