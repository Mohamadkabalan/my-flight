<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SegmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'position'      => $this->position,
            'origin'        => $this->origin,
            'destination'   => $this->destination,
            'departure_at'  => $this->departure_at,
            'arrival_at'    => $this->arrival_at,
            'cabin_class'   => $this->cabin_class,
            'airline'       => $this->airline,
            'flight_number' => $this->flight_number,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
