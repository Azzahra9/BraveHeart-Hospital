<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['dokter_id', 'hari', 'jam_mulai', 'durasi'];

    public function dokter() {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}
