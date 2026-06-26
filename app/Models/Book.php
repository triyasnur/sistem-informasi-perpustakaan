<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'kategori',
        'stok',
        'deskripsi',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}