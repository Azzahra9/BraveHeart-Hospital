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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id(); // [cite: 102]
            $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade'); // [cite: 103]
            $table->string('hari'); // [cite: 104]
            $table->time('jam_mulai'); // [cite: 105]
            $table->integer('durasi')->default(30); // [cite: 106]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
