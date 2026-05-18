<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TokenRefresh extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'token_refresh';
    public $timestamps = false;

    protected $fillable = [
        'pengguna_id',
        'token',
        'kedaluwarsa_pada',
        'dicabut',
        'dibuat_pada',
    ];

    protected $hidden = ['token'];

    protected $casts = [
        'kedaluwarsa_pada' => 'datetime',
        'dicabut'          => 'boolean',
        'dibuat_pada'      => 'datetime',
    ];

    // Relations
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    // Scopes
    public function scopeAktif($query)
    {
        return $query->where('dicabut', false)
                     ->where('kedaluwarsa_pada', '>', now());
    }
}
