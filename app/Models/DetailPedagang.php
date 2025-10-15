<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPedagang extends Model
{
    use HasFactory;
    protected $table = 'detail_pedagang';
    protected $fillable = [
        'user_id',
        'no_telepon',
        'email',
        'alamat_lengkap',
        // Kolom Baru
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
