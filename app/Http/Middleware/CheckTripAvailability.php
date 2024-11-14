<?php

namespace App\Http\Middleware;

use App\Models\Trip;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTripAvailability
{
    public function handle($request, Closure $next)
    {
        // Only proceed with the trip checks if trip_id is present
        $tripId = $request->input('trip_id');

        if ($tripId) {
            $trip = Trip::find($tripId);

            // Check if the trip exists
            if (!$trip) {
                return response()->json(['message' => 'Trip not found.'], 404);
            }

            // Check if the trip is available and has enough seats
            if ($trip->available_seats <= 0 || !$trip->is_available) {
                return response()->json(['message' => 'Trip is not available'], 403);
            }

            // Optionally, add trip details to the request data
            $request->merge([
                'price' => $trip->price,
                'trip_user_id' => auth()->id(),
            ]);
        }

        return $next($request);
    }
}
