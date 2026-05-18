<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SlotParkir extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'slot_parkir';
    public $timestamps = false;

    protected $fillable = [
        'lokasi_parkir_id',
        'kode_slot',
        'lantai',
        'zona',
        'jenis_slot',
        'status',
        'id_sensor',
        'terakhir_diperbarui',
        'dibuat_pada',
    ];

    protected $casts = [
        'terakhir_diperbarui' => 'datetime',
        'dibuat_pada'         => 'datetime',
    ];

    // Relations
    public function lokasiParkir(): BelongsTo
    {
        return $this->belongsTo(LokasiParkir::class, 'lokasi_parkir_id');
    }

    public function pemesanan(): HasMany
    {
        return $this->hasMany(Pemesanan::class, 'slot_id');
    }

    public function logSensor(): HasMany
    {
        return $this->hasMany(LogSensor::class, 'slot_id');
    }

    // Scopes
    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }
}
