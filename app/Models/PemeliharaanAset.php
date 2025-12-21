<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeliharaanAset extends Model
{
    use HasFactory;

    protected $table = 'pemeliharaan_aset';
    protected $primaryKey = 'pemeliharaan_id';

    protected $fillable = [
        'aset_id',
        'tanggal',
        'tindakan',
        'biaya',
        'pelaksana'
    ];

    // Relasi balik ke Aset
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'pemeliharaan_id')->where('ref_table', 'pemeliharaan');
    }
}
