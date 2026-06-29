<?php

namespace App\Http\Requests;

use App\Enums\CabinClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSegmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'position'      => ['sometimes', 'required', 'integer', 'min:1'],
            'origin'        => ['sometimes', 'required', 'string', 'size:3', 'alpha'],
            'destination'   => ['sometimes', 'required', 'string', 'size:3', 'alpha'],
            'departure_at'  => ['sometimes', 'required', 'date'],
            'arrival_at'    => ['sometimes', 'required', 'date', 'after:departure_at'],
            'cabin_class'   => ['sometimes', 'required', Rule::enum(CabinClass::class)],
            'airline'       => ['sometimes', 'required', 'string', 'max:3'],
            'flight_number' => ['sometimes', 'required', 'string', 'max:10'],
        ];
    }
}
