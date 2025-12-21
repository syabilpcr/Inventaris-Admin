<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;

    protected $table = 'kategori_aset'; // Nama tabel kustom
    protected $primaryKey = 'kategori_id'; // PK kustom

    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
    ];
}
