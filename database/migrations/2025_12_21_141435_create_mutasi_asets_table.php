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
        Schema::create('mutasi_aset', function (Blueprint $table) {
            $table->id('mutasi_id'); // Primary Key
            $table->unsignedBigInteger('aset_id'); // Foreign Key ke tabel aset
            $table->date('tanggal');
            $table->string('jenis_mutasi'); // Contoh: Masuk, Keluar, Pindah
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Relasi
            $table->foreign('aset_id')->references('aset_id')->on('aset')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_asets');
    }
};
