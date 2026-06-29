<?php

namespace App\Models;

use App\Enums\FlightStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'status',
    ];

    protected $casts = [
        'status' => FlightStatus::class,
    ];

    public function legs(): HasMany
    {
        return $this->hasMany(Leg::class)->orderBy('position');
    }
}