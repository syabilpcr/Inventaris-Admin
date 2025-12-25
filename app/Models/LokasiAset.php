<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'lokasi_id')->where('ref_table', 'lokasi_aset');
    }

    // Fitur Filter (RT/RW)
    public function scopeFilter(Builder $query, $request): Builder
    {
        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }
        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }
        return $query;
    }

    // Fitur Search (Nama Aset, Kode Aset, atau Alamat)
    public function scopeSearch(Builder $query, $request): Builder
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('lokasi_text', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('keterangan', 'LIKE', '%' . $request->search . '%')
                  ->orWhereHas('aset', function ($queryAset) use ($request) {
                      $queryAset->where('nama_aset', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('kode_aset', 'LIKE', '%' . $request->search . '%');
                  });
            });
        }
        return $query;
    }
}