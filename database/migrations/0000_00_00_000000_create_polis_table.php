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
        Schema::create('polis', function (Blueprint $table) {
            $table->id(); // [cite: 97]
            $table->string('nama_poli'); // [cite: 98]
            $table->text('deskripsi'); // [cite: 99]
            $table->string('icon')->nullable(); // [cite: 100]
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polis');
    }
};
