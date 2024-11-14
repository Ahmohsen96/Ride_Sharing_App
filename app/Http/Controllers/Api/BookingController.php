<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(): JsonResponse
    {
        $bookings = $this->bookingService->getAllBookings();
        return response()->json($bookings, 200);
    }

    



    public function store(BookingRequest $request): JsonResponse
    {
        $booking = $this->bookingService->createBooking($request->validated());
        return response()->json(new BookingResource($booking), 201);
    }

    public function show(int $id): JsonResponse
    {
        $booking = $this->bookingService->getBookingById($id);
        return response()->json(new BookingResource($booking));
    }

    public function update(BookingRequest $request, int $id): JsonResponse
    {
        $booking = $this->bookingService->updateBooking($id, $request->validated());
        return response()->json(new BookingResource($booking));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->bookingService->deleteBooking($id);
        return response()->json(['message' => 'Booking deleted successfully.'], 200);
    }
}
