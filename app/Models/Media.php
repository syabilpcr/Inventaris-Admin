<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Nama tabel sesuai migration
    protected $table = 'media';

    // Primary Key
    protected $primaryKey = 'media_id';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];

    /**
     * Helper untuk mendapatkan URL file yang valid
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_name);
    }
}
