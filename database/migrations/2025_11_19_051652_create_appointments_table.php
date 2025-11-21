<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); // [cite: 108]
            $table->foreignId('pasien_id')->constrained('users')->onDelete('cascade'); // [cite: 109]
            $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade'); // [cite: 110]
            // Jadwal spesifik yang dipilih
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade'); // [cite: 111]
            
            $table->date('tanggal_booking'); // [cite: 112]
            $table->text('keluhan'); // [cite: 113]
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Selesai'])->default('Pending'); // [cite: 114]
            $table->text('alasan_reject')->nullable(); // [cite: 115]
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
