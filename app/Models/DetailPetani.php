<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPetani extends Model
{
    use HasFactory;
    protected $table = 'detail_petani';
    protected $fillable = [
        'user_id',
        'no_telepon',
        'email_opsional',
        'alamat_lengkap',
        // Kolom Baru
        'komoditas_utama',
        'bank_nama',
        'rekening_nomor',
        'rekening_nama',
    ];

    /**
     * Relasi: Satu DetailPetani dimiliki oleh satu User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
