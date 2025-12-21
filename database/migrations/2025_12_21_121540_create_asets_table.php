<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aset', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->id('aset_id'); // Primary Key

            // Foreign Key ke tabel kategori_aset
            $table->foreignId('kategori_id')
                ->constrained('kategori_aset', 'kategori_id')
                ->onDelete('cascade');

            $table->string('kode_aset')->unique(); // Unique
            $table->string('nama_aset');
            $table->date('tgl_perolehan');
            $table->decimal('nilai_perolehan', 15, 2); // Decimal sesuai gambar
            $table->string('kondisi'); // Contoh: Baik, Rusak, dll.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
