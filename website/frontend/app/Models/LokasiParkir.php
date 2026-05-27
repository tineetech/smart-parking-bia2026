<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiParkir extends Model
{

    protected $table = 'lokasi_parkir';

    protected $fillable = [
        'kode_unik',
        'nama',
        'alamat',
        'latitude',
        'longitude',
        'total_slot',
        'harga_per_jam',
        'jam_buka',
        'jam_tutup',
        'aktif',
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
