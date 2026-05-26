<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogSensor extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'log_sensor';
    public $timestamps = false;

    protected $fillable = [
        'slot_id',
        'id_sensor',
        'status',
        'jarak_cm',
        'dicatat_pada',
    ];

    protected $casts = [
        'jarak_cm'    => 'decimal:2',
        'dicatat_pada' => 'datetime',
    ];

    // Relations
    public function slotParkir(): BelongsTo
    {
        return $this->belongsTo(SlotParkir::class, 'slot_id');
    }
}
