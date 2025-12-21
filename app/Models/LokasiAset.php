<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiAset extends Model
{
    use HasFactory;

    protected $table = 'lokasi_aset';
    protected $primaryKey = 'lokasi_id';

    protected $fillable = [
        'aset_id',
        'keterangan',
        'lokasi_text',
        'rt',
        'rw'
    ];

    // Relasi ke model Aset
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'lokasi_id')->where('ref_table', 'lokasi_aset');
    }
}
