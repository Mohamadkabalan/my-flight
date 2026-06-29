<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLegRequest;
use App\Http\Requests\UpdateLegRequest;
use App\Http\Resources\LegResource;
use App\Models\Flight;
use App\Models\Leg;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LegController extends Controller
{
    public function index(Flight $flight): AnonymousResourceCollection
    {
        return LegResource::collection($flight->legs()->paginate());
    }

    public function store(StoreLegRequest $request, Flight $flight): JsonResponse
    {
        $leg = $flight->legs()->create($request->validated());

        return LegResource::make($leg)
            ->response()
            ->setStatusCode(201);
    }

    public function show(Flight $flight, Leg $leg): LegResource
    {
        abort_if($leg->flight_id !== $flight->id, 404);

        $leg->load('segments');

        return LegResource::make($leg);
    }

    public function update(UpdateLegRequest $request, Flight $flight, Leg $leg): LegResource
    {
        abort_if($leg->flight_id !== $flight->id, 404);

        $leg->update($request->validated());

        return LegResource::make($leg);
    }

    public function destroy(Flight $flight, Leg $leg): Response
    {
        abort_if($leg->flight_id !== $flight->id, 404);

        $leg->delete();

        return response()->noContent();
    }
}
