<?php

namespace App\Models;

use App\Enums\CabinClass;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Segment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'leg_id',
        'position',
        'origin',
        'destination',
        'departure_at',
        'arrival_at',
        'cabin_class',
        'airline',
        'flight_number',
    ];

    protected $casts = [
        'departure_at' => 'datetime',
        'arrival_at'   => 'datetime',
        'cabin_class'  => CabinClass::class,
    ];

    public function leg(): BelongsTo
    {
        return $this->belongsTo(Leg::class);
    }
}