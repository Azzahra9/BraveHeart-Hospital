<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'dokter_id', 'pasien_id', 
        'diagnosis', 'tindakan', 'catatan', 'tanggal'
    ];

    /**
     * Relasi ke Appointment
     */
    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Relasi ke Resep Obat
     */
    public function prescriptions() {
        return $this->hasMany(Prescription::class);
    }

    /**
     * Relasi ke Pasien (User) - INI YANG HILANG SEBELUMNYA
     */
    public function pasien() {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    /**
     * Relasi ke Dokter (User) - Tambahkan juga agar lengkap
     */
    public function dokter() {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}