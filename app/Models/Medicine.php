<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'tipe', 'stok', 'gambar'];
}
