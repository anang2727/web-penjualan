<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StokPengepul extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     *
     * @var string
     */
    protected $table = 'stok_pengepul';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * Harus mencakup semua kolom yang diisi saat stok dibuat dari Pengajuan.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pengepul_id',
        'nama_komoditas',
        'jumlah_stok_saat_ini',
        'satuan',
        'tanggal_masuk',
    ];

    // --- Relasi ---

    /**
     * Mendapatkan User (Pengepul) pemilik stok.
     */
    public function pengepul(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengepul_id');
    }

    /**
     * Mendapatkan semua penawaran pedagang (iklan jual) yang berasal dari stok ini.
     */
    // public function penawaranPedagang(): HasMany
    // {
    //     return $this->hasMany(PenawaranPedagang::class, 'stok_pengepul_id');
    // }
}