<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'isi',
        'gambar'
    ];

    // Relasi: Berita ini dimiliki oleh satu kategori
    public function kategori_berita(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }
}
