<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leg extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'flight_id',
        'position',
    ];

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    public function segments(): HasMany
    {
        return $this->hasMany(Segment::class)->orderBy('position');
    }
}