<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Poli;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun ADMIN Utama
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@rsjantung.com',
            'role' => 'admin',
            'password' => Hash::make('password123'), // Password default
            'email_verified_at' => now(),
        ]);

        // 2. Buat Data Dummy POLI (Opsional, biar tidak kosong)
        $poliJantung = Poli::create([
            'nama_poli' => 'Poli Jantung Umum',
            'deskripsi' => 'Penyakit jantung umum dan konsultasi rutin.',
        ]);
        
        Poli::create([
            'nama_poli' => 'Poli Jantung Anak',
            'deskripsi' => 'Penanganan spesialis untuk kelainan jantung pada anak.',
        ]);

        // 3. Buat Akun DOKTER Contoh
        User::create([
            'name' => 'dr. Budi Santoso, Sp.JP',
            'email' => 'dokterbudi@rsjantung.com',
            'role' => 'dokter',
            'poli_id' => $poliJantung->id,
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // 4. Buat Akun PASIEN Contoh
        User::create([
            'name' => 'Bapak Pasien',
            'email' => 'pasien@gmail.com',
            'role' => 'pasien',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}