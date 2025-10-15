<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penawaran_id',
        'petani_id',
        'nama_hasil',
        'stok_ditawarkan',
        'tanggal_panen',
        'deskripsi',
        'foto',
        'status',
        'is_stok_generated', // <-- NEW
        'stok_pengepul_id',  // <-- NEW
    ];

    protected $casts = [
        'tanggal_panen' => 'date',
    ];

    public function penawaran(): BelongsTo
    {
        return $this->belongsTo(Penawaran::class);
    }

    public function petani(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petani_id');
    }

    public function stokPengepul()
    {
        return $this->belongsTo(stokPengepul::class);
    }
}
