<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'pemeliharaan_id')->where('ref_table', 'pemeliharaan');
    }

    // Filter berdasarkan Bulan/Tahun (Opsional tapi sangat berguna untuk laporan)
    public function scopeFilter(Builder $query, $request): Builder
    {
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }
        return $query;
    }

    // Search berdasarkan Nama Aset, Pelaksana, atau Deskripsi Tindakan
    public function scopeSearch(Builder $query, $request): Builder
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('pelaksana', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('tindakan', 'LIKE', '%' . $request->search . '%')
                  ->orWhereHas('aset', function ($queryAset) use ($request) {
                      $queryAset->where('nama_aset', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('kode_aset', 'LIKE', '%' . $request->search . '%');
                  });
            });
        }
        return $query;
    }
}