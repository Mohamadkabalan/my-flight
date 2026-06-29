<?php

namespace App\Http\Controllers;

use App\Enums\FlightStatus;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return FlightResource::collection(Flight::paginate());
    }

    public function store(StoreFlightRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $flight = DB::transaction(function () use ($validated): Flight {
            $flight = Flight::create([
                'status' => $validated['status'] ?? FlightStatus::Draft->value,
            ]);

            foreach ($validated['legs'] as $legIndex => $legData) {
                $leg = $flight->legs()->create(['position' => $legIndex + 1]);

                foreach ($legData['segments'] as $segIndex => $segData) {
                    $leg->segments()->create([
                        'position'      => $segIndex + 1,
                        'origin'        => $segData['origin'],
                        'destination'   => $segData['destination'],
                        'departure_at'  => $segData['departure'],
                        'arrival_at'    => $segData['arrival'],
                        'cabin_class'   => $segData['cabinClass'],
                        'airline'       => $segData['airline'],
                        'flight_number' => $segData['flightNumber'],
                    ]);
                }
            }

            return $flight;
        });

        return response()->json(['flightId' => $flight->id], 201);
    }

    public function show(Flight $flight): FlightResource
    {
        $flight->load('legs.segments');

        return FlightResource::make($flight);
    }

    public function update(UpdateFlightRequest $request, Flight $flight): FlightResource
    {
        $flight->update($request->validated());

        return FlightResource::make($flight);
    }

    public function destroy(Flight $flight): Response
    {
        $flight->delete();

        return response()->noContent();
    }
}
