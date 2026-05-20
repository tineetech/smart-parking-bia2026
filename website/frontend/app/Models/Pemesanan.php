<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pemesanan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pemesanan';
    public $timestamps = false;

    protected $fillable = [
        'pengguna_id',
        'slot_id',
        'kendaraan_id',
        'kode_pemesanan',
        'waktu_mulai',
        'waktu_selesai',
        'durasi_jam',
        'total_harga',
        'status',
        'catatan',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    protected $casts = [
        'waktu_mulai'    => 'datetime',
        'waktu_selesai'  => 'datetime',
        'durasi_jam'     => 'decimal:2',
        'total_harga'    => 'decimal:2',
        'dibuat_pada'    => 'datetime',
        'diperbarui_pada' => 'datetime',
    ];

    // Relations
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function slotParkir(): BelongsTo
    {
        return $this->belongsTo(SlotParkir::class, 'slot_id');
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'pemesanan_id');
    }

    // Scopes
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeMenunggu($query)
    {
        return $query->where('status', 'menunggu');
    }
}
