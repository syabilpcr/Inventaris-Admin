<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'aset';
    protected $primaryKey = 'aset_id';

    protected $fillable = [
        'kategori_id',
        'kode_aset',
        'nama_aset',
        'tgl_perolehan',
        'nilai_perolehan',
        'kondisi',
    ];

    // Relasi balik ke KategoriAset
    public function kategori()
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id', 'kategori_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'aset_id')->where('ref_table', 'aset');
    }
    public function scopeFilter(Builder $query, $request): Builder
    {
        // Filter berdasarkan kategori_id
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter berdasarkan kondisi (Sangat Baik, Baik, dll)
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        return $query;
    }

    public function scopeSearch(Builder $query, $request): Builder
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_aset', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('kode_aset', 'LIKE', '%' . $request->search . '%');
            });
        }
        return $query;
    }
    }

