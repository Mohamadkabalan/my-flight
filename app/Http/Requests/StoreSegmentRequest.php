<?php

namespace App\Http\Requests;

use App\Enums\CabinClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSegmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'position'      => ['required', 'integer', 'min:1'],
            'origin'        => ['required', 'string', 'size:3', 'alpha'],
            'destination'   => ['required', 'string', 'size:3', 'alpha'],
            'departure_at'  => ['required', 'date'],
            'arrival_at'    => ['required', 'date', 'after:departure_at'],
            'cabin_class'   => ['required', Rule::enum(CabinClass::class)],
            'airline'       => ['required', 'string', 'max:3'],
            'flight_number' => ['required', 'string', 'max:10'],
        ];
    }
}
