<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienMedicalRecordController extends Controller
{
    /**
     * Menampilkan daftar riwayat medis milik pasien yang sedang login
     */
    public function index()
    {
        // Mengambil semua rekam medis milik pasien, dengan eager loading relasi penting:
        $medicalRecords = MedicalRecord::with([
                'dokter', 
                'prescriptions.medicine'
            ])
            ->where('pasien_id', Auth::id())
            ->latest('tanggal') // Urutkan dari yang terbaru
            ->paginate(10);

        return view('pasien.medical_records.index', compact('medicalRecords'));
    }

    /**
     * Menampilkan detail resep untuk kunjungan tertentu
     */
    public function show($id)
    {
        // Cari rekam medis berdasarkan ID dan pastikan milik pasien yang login
        $record = MedicalRecord::with(['dokter.poli', 'prescriptions.medicine'])
                               ->where('id', $id)
                               ->where('pasien_id', Auth::id())
                               ->firstOrFail();

        return view('pasien.medical_records.show', compact('record'));
    }
}