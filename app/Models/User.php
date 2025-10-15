<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasilPertanian()
    {
        return $this->hasMany(HasilPertanian::class, 'petani_id');
    }
    public function detailPetani(): HasOne
    {
        // Secara default, mencari kolom 'user_id' di tabel 'detail_petani'
        return $this->hasOne(DetailPetani::class);
    }

    public function detailPedagang(): HasOne
    {
        // Mencari kolom 'user_id' di tabel 'detail_pedagang'
        return $this->hasOne(DetailPedagang::class);
    }
    // app/Models/User.php
    public function isPetani(): bool
    {
        return $this->role === 'petani';
    }
}
