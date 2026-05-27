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

    protected $fillable = [
        'user_id',
        'slot_id',
        'kendaraan_id',
        'kode_pemesanan',
        'waktu_mulai',
        'waktu_selesai',
        'durasi_parkir',
        'total_harga',
        'status',
        'catatan',
    ];

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
