<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notifikasi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'notifikasi';
    public $timestamps = false;

    protected $fillable = [
        'pengguna_id',
        'judul',
        'pesan',
        'jenis',
        'sudah_dibaca',
        'dibuat_pada',
    ];

    protected $casts = [
        'sudah_dibaca' => 'boolean',
        'dibuat_pada'  => 'datetime',
    ];

    // Relations
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    // Scopes
    public function scopeBelumDibaca($query)
    {
        return $query->where('sudah_dibaca', false);
    }
}
