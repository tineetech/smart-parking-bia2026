<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sensor extends Model
{

    protected $table = 'sensor';

    protected $fillable = [
        'nama_sensor',
        'status',
        'jarak_cm',
    ];

    public function slotParkir()
    {
        return $this->hasOne(SlotParkir::class, 'id_sensor');
    }
    
}
