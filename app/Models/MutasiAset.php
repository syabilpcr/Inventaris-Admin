<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MutasiAset extends Model
{
    use HasFactory;

    protected $table = 'mutasi_aset';
    protected $primaryKey = 'mutasi_id';

    protected $fillable = [
        'aset_id',
        'tanggal',
        'jenis_mutasi',
        'keterangan'
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }

    // Fitur Pencarian
    public function scopeSearch(Builder $query, $request): Builder
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('jenis_mutasi', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('keterangan', 'LIKE', '%' . $request->search . '%')
                  ->orWhereHas('aset', function ($qAset) use ($request) {
                      $qAset->where('nama_aset', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('kode_aset', 'LIKE', '%' . $request->search . '%');
                  });
            });
        }
        return $query;
    }

    // Fitur Filter
    public function scopeFilter(Builder $query, $request): Builder
    {
        if ($request->filled('jenis')) {
            $query->where('jenis_mutasi', $request->jenis);
        }
        return $query;
    }
}