<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kendaraan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kendaraan';
    public $timestamps = false;

    protected $fillable = [
        'pengguna_id',
        'plat_nomor',
        'merek',
        'model',
        'warna',
        'jenis',
        'utama',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    protected $casts = [
        'utama'          => 'boolean',
        'dibuat_pada'    => 'datetime',
        'diperbarui_pada' => 'datetime',
    ];

    // Relations
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function pemesanan(): HasMany
    {
        return $this->hasMany(Pemesanan::class, 'kendaraan_id');
    }
}
