<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{

    protected $table = 'pembayaran';

    protected $fillable = [
        'pemesanan_id',
        'jumlah',
        'metode',
        'status',
        'referensi_pembayaran',
        'dibayar_pada',
    ];

    // Relations
    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    // Scopes
    public function scopeSukses($query)
    {
        return $query->where('status', 'sukses');
    }
}
