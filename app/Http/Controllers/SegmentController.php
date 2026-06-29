<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSegmentRequest;
use App\Http\Requests\UpdateSegmentRequest;
use App\Http\Resources\SegmentResource;
use App\Models\Leg;
use App\Models\Flight;
use App\Models\Segment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SegmentController extends Controller
{
    public function index(Flight $flight, Leg $leg): AnonymousResourceCollection
    {
        abort_if($leg->flight_id !== $flight->id, 404);

        return SegmentResource::collection($leg->segments()->paginate());
    }

    public function store(StoreSegmentRequest $request, Flight $flight, Leg $leg): JsonResponse
    {
        abort_if($leg->flight_id !== $flight->id, 404);

        $segment = $leg->segments()->create($request->validated());

        return SegmentResource::make($segment)
            ->response()
            ->setStatusCode(201);
    }

    public function show(Flight $flight, Leg $leg, Segment $segment): SegmentResource
    {
        abort_if($leg->flight_id !== $flight->id, 404);
        abort_if($segment->leg_id !== $leg->id, 404);

        return SegmentResource::make($segment);
    }

    public function update(UpdateSegmentRequest $request, Flight $flight, Leg $leg, Segment $segment): SegmentResource
    {
        abort_if($leg->flight_id !== $flight->id, 404);
        abort_if($segment->leg_id !== $leg->id, 404);

        $segment->update($request->validated());

        return SegmentResource::make($segment);
    }

    public function destroy(Flight $flight, Leg $leg, Segment $segment): Response
    {
        abort_if($leg->flight_id !== $flight->id, 404);
        abort_if($segment->leg_id !== $leg->id, 404);

        $segment->delete();

        return response()->noContent();
    }
}
