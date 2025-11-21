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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id(); // [cite: 123]
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade'); // [cite: 124]
            $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade'); // [cite: 125]
            $table->foreignId('pasien_id')->constrained('users')->onDelete('cascade'); // [cite: 126]
            
            $table->text('diagnosis'); // [cite: 127]
            $table->text('tindakan'); // [cite: 128]
            $table->text('catatan')->nullable(); // [cite: 129]
            $table->date('tanggal'); // [cite: 130]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
