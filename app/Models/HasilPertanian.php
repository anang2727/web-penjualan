<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPertanian extends Model
{
    use HasFactory;

    protected $fillable = [
        'petani_id',
        'nama_hasil',
        'foto',
        'stok',
        'tanggal_panen',
        'deskripsi',
    ];

    public function petani()
    {
        // relasi hanya ke user dengan role petani
        return $this->belongsTo(User::class, 'petani_id')->where('role', 'petani');
    }
}
