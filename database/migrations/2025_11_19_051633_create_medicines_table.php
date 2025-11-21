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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id(); // [cite: 117]
            $table->string('nama'); // [cite: 118]
            $table->text('deskripsi'); // [cite: 119]
            $table->enum('tipe', ['obat keras', 'biasa']); // [cite: 120]
            $table->integer('stok'); // [cite: 121]
            $table->string('gambar')->nullable(); // [cite: 280]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
