<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
        protected $fillable = [
        'pasien_id', 'dokter_id', 'schedule_id', 
        'tanggal_booking', 'keluhan', 'status', 'alasan_reject'
    ];

    public function pasien() {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    public function dokter() {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function schedule() {
        return $this->belongsTo(Schedule::class);
    }

    public function medicalRecord() {
        return $this->hasOne(MedicalRecord::class);
    }
}
