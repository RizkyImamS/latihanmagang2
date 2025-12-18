<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBerita extends Model
{
    protected $table = 'kategori_beritas'; // Opsional jika nama tabel jamak
    protected $fillable = ['nama_kategori'];

    // Relasi: Satu kategori memiliki banyak berita
    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class, 'kategori_id');
    }
}
