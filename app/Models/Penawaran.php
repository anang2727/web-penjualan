<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penawaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'jumlah_kebutuhan',
        'harga_perkiraan',
        'tanggal_batas',
        'status',
    ];

    protected $casts = [
        'tanggal_batas' => 'date',
        'harga_perkiraan' => 'decimal:2',
    ];

    public function pengajuans(): HasMany
    {
        return $this->hasMany(Pengajuan::class);
    }
}