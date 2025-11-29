<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokterMedicalRecordController extends Controller
{
    /**
     * Menampilkan Form Pemeriksaan
     */
    public function create(Request $request)
    {
        // Pastikan ada appointment_id yang dikirim
        $appointmentId = $request->query('appointment_id');
        
        if (!$appointmentId) {
            return redirect()->route('dokter.appointments.index')
                ->with('error', 'ID Janji Temu tidak ditemukan.');
        }

        // Ambil data appointment dan pastikan milik dokter ini
        $appointment = Appointment::with('pasien')
            ->where('id', $appointmentId)
            ->where('dokter_id', Auth::id())
            ->firstOrFail();

        // Ambil daftar obat untuk resep (hanya yang stoknya ada)
        $medicines = Medicine::where('stok', '>', 0)->get();

        return view('dokter.medical_records.create', compact('appointment', 'medicines'));
    }

    /**
     * Simpan Rekam Medis & Resep
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'diagnosis'      => 'required|string',
            'tindakan'       => 'required|string',
            'medicines'      => 'array', // Array obat yang dipilih
            'medicines.*'    => 'exists:medicines,id',
            'quantities'     => 'array', // Array jumlah obat
            'quantities.*'   => 'integer|min:1',
        ]);

        // Gunakan Transaksi Database agar data konsisten
        DB::transaction(function () use ($request) {
            $appointment = Appointment::findOrFail($request->appointment_id);

            // 1. Simpan Rekam Medis
            $record = MedicalRecord::create([
                'appointment_id' => $appointment->id,
                'dokter_id'      => Auth::id(),
                'pasien_id'      => $appointment->pasien_id,
                'diagnosis'      => $request->diagnosis,
                'tindakan'       => $request->tindakan,
                'catatan'        => $request->catatan, // Pastikan field ini nullable di database jika tidak wajib
                'tanggal'        => now(),
            ]);

            // 2. Simpan Resep Obat (Jika ada)
            if ($request->medicines) {
                foreach ($request->medicines as $index => $medicineId) {
                    $qty = $request->quantities[$index] ?? 1;
                    
                    // Simpan ke tabel pivot prescriptions
                    Prescription::create([
                        'medical_record_id' => $record->id,
                        'medicine_id'       => $medicineId,
                        'jumlah'            => $qty
                    ]);

                    // Kurangi stok obat
                    $medicine = Medicine::find($medicineId);
                    if ($medicine) {
                        $medicine->decrement('stok', $qty);
                    }
                }
            }

            // 3. Update Status Appointment jadi 'Selesai'
            $appointment->update(['status' => 'Selesai']);
        });

        return redirect()->route('dokter.appointments.index')
            ->with('success', 'Pemeriksaan selesai! Rekam medis berhasil disimpan.');
    }

    /**
     * Menampilkan Detail Rekam Medis
     * Method ini yang sebelumnya hilang dan menyebabkan error.
     */
    public function show($id)
    {
        // Menggunakan findOrFail agar jika ID tidak ketemu otomatis 404
        // 'with' digunakan untuk mengambil data relasi (pasien dan obat) sekaligus
        $medicalRecord = MedicalRecord::with(['pasien', 'prescriptions.medicine', 'appointment'])
            ->findOrFail($id);

        // Pastikan Anda sudah membuat view di: resources/views/dokter/medical_records/show.blade.php
        return view('dokter.medical_records.show', compact('medicalRecord'));
    }
}