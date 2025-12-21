<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lokasi_aset', function (Blueprint $table) {
            // lokasi_id (PK)
            $table->id('lokasi_id');

            // aset_id (FK) - Menghubungkan ke tabel aset
            $table->unsignedBigInteger('aset_id');

            // Kolom sesuai gambar
            $table->text('keterangan')->nullable();
            $table->string('lokasi_text');
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('aset_id')->references('aset_id')->on('aset')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi_aset');
    }
};
