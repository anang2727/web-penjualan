<?php

// app/Models/PostinganDagangan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostinganDagangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pengepul_id',
        'stok_pengepul_id',
        'judul_postingan',
        'deskripsi',
        'foto_postingan',
        'harga_jual_satuan',
        'kuantitas_dijual',
        'minimum_order',
        'satuan',
        'lokasi_stok',
        'status',
    ];

    // Relasi ke User (Pengepul)
    public function pengepul(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengepul_id');
    }

    // Relasi untuk TransaksiPembelian
    public function transaksiPembelians()
    {
        return $this->hasMany(TransaksiPembelian::class);
    }

    // Relasi ke StokPengepul (Sumber Inventaris)
    public function stokPengepul(): BelongsTo
    {
        return $this->belongsTo(StokPengepul::class, 'stok_pengepul_id');
    }

    // (Opsional) Enum untuk Satuan
    public const SATUAN_KG = 'Kg';
    public const SATUAN_KUINTAL = 'Kuintal';
    public const SATUAN_TON = 'Ton';

    public static function getSatuanOptions(): array
    {
        return [
            self::SATUAN_KG => 'Kilogram (Kg)',
            self::SATUAN_KUINTAL => 'Kuintal (100 Kg)',
            self::SATUAN_TON => 'Ton (1000 Kg)',
        ];
    }
}
