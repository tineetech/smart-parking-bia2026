<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SlotParkir extends Model
{

    protected $table = 'slot_parkir';

    protected $fillable = [
        'lokasi_parkir_id',
        'kode_slot',
        'lantai',
        'zona',
        'jenis_slot',
        'kendaraan_type',
        'status',
        'id_sensor',
        'terakhir_diperbarui',
    ];

    // Relations
    public function lokasiParkir(): BelongsTo
    {
        return $this->belongsTo(LokasiParkir::class, 'lokasi_parkir_id');
    }

    public function pemesanan(): HasMany
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function sensor(): BelongsTo
    {
        return $this->belongsTo(Sensor::class, 'id_sensor');
    }

    // Scopes
    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }
}
