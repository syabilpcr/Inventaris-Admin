<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class LokasiAset extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'lokasi_aset';
    
    // Primary key tabel
    protected $primaryKey = 'lokasi_id';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'aset_id',
        'keterangan',
        'lokasi_text',
        'rt',
        'rw'
    ];

    /**
     * Casting atribut untuk memastikan tipe data konsisten.
     * Ini membantu jika RT/RW sering dianggap null atau angka.
     */
    protected $casts = [
        'rt' => 'string',
        'rw' => 'string',
    ];

    /**
     * Relasi ke Model Aset (Many-to-One)
     */
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }

    /**
     * Relasi ke Model Media (One-to-Many)
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'lokasi_id')
                    ->where('ref_table', 'lokasi_aset');
    }

    /**
     * Fitur Filter (RT/RW)
     * Digunakan di Controller: LokasiAset::filter($request)->get();
     */
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

    /**
     * Fitur Search (Nama Aset, Kode Aset, atau Alamat)
     */
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

    /**
     * Accessor untuk RT/RW agar selalu muncul 2 digit (contoh: 01, 05)
     * Jika data di database kosong, akan muncul '00'
     */
    public function getRtAttribute($value)
    {
        return str_pad($value ?? '0', 2, '0', STR_PAD_LEFT);
    }

    public function getRwAttribute($value)
    {
        return str_pad($value ?? '0', 2, '0', STR_PAD_LEFT);
    }

    /**
     * Boot function untuk mengatur timezone Jakarta otomatis saat update
     */
    protected static function booted()
    {
        static::updating(function ($model) {
            $model->updated_at = Carbon::now('Asia/Jakarta');
        });
    }
}