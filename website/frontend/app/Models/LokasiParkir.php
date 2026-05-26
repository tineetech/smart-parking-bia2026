<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiParkir extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'lokasi_parkir';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'latitude',
        'longitude',
        'total_slot',
        'harga_per_jam',
        'jam_buka',
        'jam_tutup',
        'aktif',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    protected $casts = [
        'aktif'         => 'boolean',
        'latitude'      => 'decimal:8',
        'longitude'     => 'decimal:8',
        'harga_per_jam' => 'decimal:2',
        'dibuat_pada'   => 'datetime',
        'diperbarui_pada' => 'datetime',
    ];

    // Relations
    public function slotParkir(): HasMany
    {
        return $this->hasMany(SlotParkir::class, 'lokasi_parkir_id');
    }

    // Scopes
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}
