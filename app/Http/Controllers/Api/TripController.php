<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResource;
use App\Services\TripService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TripController extends Controller
{
    protected $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    public function index(Request $request): JsonResponse
    {
        $trips = $this->tripService->getAvailableTrips($request->all());
        return response()->json(TripResource::collection($trips));
    }

    public function store(TripRequest $request): JsonResponse
    {
        $trip = $this->tripService->createTrip($request->validated());
        return response()->json(new TripResource($trip), 201);
    }

    public function show(int $id): JsonResponse
    {
        $trip = $this->tripService->getTripById($id);
        return response()->json(new TripResource($trip));
    }

    public function update(TripRequest $request, int $id): JsonResponse
    {
        $trip = $this->tripService->updateTrip($id, $request->validated());
        return response()->json(new TripResource($trip));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->tripService->deleteTrip($id);
        return response()->json(['message' => 'Trip deleted successfully.'], 200);
    }
}
