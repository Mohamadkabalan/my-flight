<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\LegController;
use App\Http\Controllers\SegmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('api.key')->group(function () {
    Route::apiResource('flights', FlightController::class);
    Route::apiResource('flights.legs', LegController::class)->scoped();
    Route::apiResource('flights.legs.segments', SegmentController::class)->scoped();
});
