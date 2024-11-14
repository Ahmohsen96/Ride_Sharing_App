<?php
namespace App\Services;

use App\Repositories\BookingRepositoryInterface;
use App\Repositories\TripRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BookingService
{
    protected $bookingRepository;
    protected $tripRepository;

    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        TripRepositoryInterface $tripRepository
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->tripRepository = $tripRepository;
    }

    public function getAllBookings(): Collection
    {
        return $this->bookingRepository->getAllBookings();
    }

    public function createBooking(array $data)
    {
        $this->validateBookingData($data);

        // Check if the trip is available and has enough seats
        $trip = $this->tripRepository->findTripById($data['trip_id']);
        // dd($trip);
        if (!$trip || !$trip->is_available || $trip->available_seats < $data['available_seats']) {
            throw new \Exception("Trip is not available or has insufficient seats.");
        }

        $data['price'] =$trip->price;

        // dd($trip->price);

        // Set passenger_id from the authenticated user
        $data['passenger_id'] = auth()->id();

        // Process booking logic
        return $this->bookingRepository->createBooking($data);
    }

    public function getBookingById(int $id)
    {
        return $this->bookingRepository->findBookingById($id);
    }

    public function updateBooking(int $id, array $data)
    {
        $this->validateBookingData($data);
        return $this->bookingRepository->updateBooking($id, $data);
    }

    public function deleteBooking(int $id)
    {
        return $this->bookingRepository->deleteBooking($id);
    }

    protected function validateBookingData(array $data)
    {
        $validator = Validator::make($data, [
            'trip_id' => 'required|exists:trips,id',
            // 'user_id' => 'required|exists:users,id',
            'available_seats' => 'required|integer|min:1',
            // 'price' => 'required|numeric',


        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
