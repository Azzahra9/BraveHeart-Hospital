<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
        protected $fillable = [
        'appointment_id', 'dokter_id', 'pasien_id', 
        'diagnosis', 'tindakan', 'catatan', 'tanggal'
    ];

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    public function prescriptions() {
        return $this->hasMany(Prescription::class);
    }
}
