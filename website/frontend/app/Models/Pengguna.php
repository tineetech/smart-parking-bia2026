<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengguna extends Authenticatable
{
    use HasFactory, HasUuids;

    protected $table = 'pengguna';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'no_telepon',
        'peran',
        'foto_profil',
        'sudah_verifikasi',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    protected $casts = [
        'sudah_verifikasi' => 'boolean',
        'dibuat_pada'      => 'datetime',
        'diperbarui_pada'  => 'datetime',
    ];

    protected $dates = ['dibuat_pada', 'diperbarui_pada'];

    // Relations
    public function kendaraan(): HasMany
    {
        return $this->hasMany(Kendaraan::class, 'pengguna_id');
    }

    public function pemesanan(): HasMany
    {
        return $this->hasMany(Pemesanan::class, 'pengguna_id');
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'pengguna_id');
    }

    public function tokenRefresh(): HasMany
    {
        return $this->hasMany(TokenRefresh::class, 'pengguna_id');
    }
}
