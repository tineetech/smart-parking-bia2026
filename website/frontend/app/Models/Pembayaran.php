<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pembayaran';
    public $timestamps = false;

    protected $fillable = [
        'pemesanan_id',
        'jumlah',
        'metode',
        'status',
        'referensi_pembayaran',
        'dibayar_pada',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    protected $casts = [
        'jumlah'         => 'decimal:2',
        'dibayar_pada'   => 'datetime',
        'dibuat_pada'    => 'datetime',
        'diperbarui_pada' => 'datetime',
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
