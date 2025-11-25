<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // Uncomment jika pakai verifikasi email
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage; // <--- INI WAJIB ADA

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'poli_id',
        'profile_photo_path', // Kolom baru untuk foto profil
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke Poli
     */
    public function poli() {
        return $this->belongsTo(Poli::class);
    }

    /**
     * Relasi Jadwal
     */
    public function schedules() {
        return $this->hasMany(Schedule::class, 'dokter_id');
    }

    /**
     * Relasi Janji Temu (Sebagai Dokter)
     */
    public function doctorAppointments() {
        return $this->hasMany(Appointment::class, 'dokter_id');
    }

    /**
     * Relasi Janji Temu (Sebagai Pasien)
     */
    public function patientAppointments() {
        return $this->hasMany(Appointment::class, 'pasien_id');
    }

    /**
     * Accessor untuk URL Foto Profil
     * Memanggil $user->profile_photo_url akan otomatis menjalankan fungsi ini
     */
    public function getProfilePhotoUrlAttribute()
    {
        // Jika ada foto di database, buat URL-nya
        if ($this->profile_photo_path) {
            return Storage::url($this->profile_photo_path);
        }

        // Jika tidak ada, pakai UI Avatars (Inisial Nama)
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }
}