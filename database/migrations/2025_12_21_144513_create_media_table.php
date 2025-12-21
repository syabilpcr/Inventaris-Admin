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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id'); // Primary Key (PK)

            // ref_table dan ref_id digunakan untuk relasi polimorfik atau referensi manual
            $table->string('ref_table')->comment('Nama tabel referensi (misal: mutasi_aset)');
            $table->unsignedBigInteger('ref_id')->comment('ID dari tabel referensi');

            // Mengubah file_url menjadi file_name sesuai permintaan gambar
            $table->string('file_name');

            $table->string('caption')->nullable();
            $table->string('mime_type')->nullable(); // Misal: image/jpeg, application/pdf
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            // Index untuk mempercepat pencarian berdasarkan referensi tabel
            $table->index(['ref_table', 'ref_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
