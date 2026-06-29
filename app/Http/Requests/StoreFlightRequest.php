<?php

namespace App\Http\Requests;

use App\Enums\CabinClass;
use App\Enums\FlightStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreFlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status'                         => ['sometimes', Rule::enum(FlightStatus::class)],

            'legs'                           => ['required', 'array', 'min:1'],
            'legs.*'                         => ['array'],

            'legs.*.segments'                => ['required', 'array', 'min:1'],
            'legs.*.segments.*'              => ['array'],

            'legs.*.segments.*.origin'       => ['required', 'string', 'size:3', 'regex:/^[A-Z]{3}$/'],
            'legs.*.segments.*.destination'  => ['required', 'string', 'size:3', 'regex:/^[A-Z]{3}$/'],
            'legs.*.segments.*.departure'    => ['required', 'date'],
            'legs.*.segments.*.arrival'      => ['required', 'date'],
            'legs.*.segments.*.cabinClass'   => ['required', Rule::enum(CabinClass::class)],
            'legs.*.segments.*.airline'      => ['required', 'string', 'max:3'],
            'legs.*.segments.*.flightNumber' => ['required', 'string', 'max:10'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        // Laravel's after: rule cannot cross-reference siblings inside a wildcard array,
        // so we check arrival > departure here once all basic rules have passed.
        $validator->after(function (Validator $validator): void {
            foreach ($this->input('legs', []) as $li => $leg) {
                foreach ($leg['segments'] ?? [] as $si => $seg) {
                    $depTs = strtotime((string) ($seg['departure'] ?? ''));
                    $arrTs = strtotime((string) ($seg['arrival'] ?? ''));

                    if ($depTs !== false && $arrTs !== false && $arrTs <= $depTs) {
                        $validator->errors()->add(
                            "legs.{$li}.segments.{$si}.arrival",
                            'Arrival must be after departure.'
                        );
                    }
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'legs.required'                          => 'At least one leg is required.',
            'legs.min'                               => 'At least one leg is required.',
            'legs.*.segments.required'               => 'Each leg must contain at least one segment.',
            'legs.*.segments.min'                    => 'Each leg must contain at least one segment.',
            'legs.*.segments.*.origin.regex'         => 'Origin must be a 3-letter uppercase IATA code (e.g. JFK).',
            'legs.*.segments.*.destination.regex'    => 'Destination must be a 3-letter uppercase IATA code (e.g. LHR).',
        ];
    }
}
