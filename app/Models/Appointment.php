<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * Menentukan kolom mana saja yang boleh diisi secara massal (Mass Assignment)
     * Sesuai request Anda.
     */
    protected $fillable = [
        'pasien_id', 
        'dokter_id', 
        'schedule_id', 
        'tanggal_booking', 
        'keluhan', 
        'status', 
        'alasan_reject'
    ];

    /**
     * Relasi ke Pasien (User)
     */
    public function pasien() {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    /**
     * Relasi ke Dokter (User)
     */
    public function dokter() {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    /**
     * Relasi ke Jadwal
     */
    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    /**
     * Relasi ke Rekam Medis (One to One)
     * Digunakan untuk tombol "Lihat Rekam Medis" di Dashboard Dokter
     */
    public function medicalRecord() {
        return $this->hasOne(MedicalRecord::class, 'appointment_id');
    }
}