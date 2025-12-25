<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeSearch(Builder $query, $request): Builder
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('kode', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $request->search . '%');
            });
        }
        return $query;
    }
}

