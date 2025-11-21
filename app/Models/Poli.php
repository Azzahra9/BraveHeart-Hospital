<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = ['nama_poli', 'deskripsi', 'icon'];

    public function dokters() {
        return $this->hasMany(User::class, 'poli_id')->where('role', 'dokter');
    }
}
