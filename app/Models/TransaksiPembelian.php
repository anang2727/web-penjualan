<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiPembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedagang_id',
        'postingan_dagangan_id',
        'pengepul_id',
        'kode_transaksi',
        'kuantitas_pesanan',
        'satuan',
        'harga_satuan',
        'total_harga',
        'status',
        'catatan',
    ];

    /**
     * Relasi ke PostinganDagangan yang dibeli.
     */
    public function postinganDagangan(): BelongsTo
    {
        return $this->belongsTo(PostinganDagangan::class, 'postingan_dagangan_id');
    }

    /**
     * Relasi ke Pedagang (Pembeli).
     */
    public function pedagang(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pedagang_id');
    }

    /**
     * Relasi ke Pengepul (Penjual).
     */
    public function pengepul(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengepul_id');
    }
}