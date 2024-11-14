<?php

namespace App\Services;

use App\Repositories\TripRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TripService
{
    protected $tripRepository;

    public function __construct(TripRepositoryInterface $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function createTrip(array $data)
    {
        $this->validateTripData($data);
        return $this->tripRepository->createTrip($data);
    }

    public function getTripById(int $id)
    {
        return $this->tripRepository->findTripById($id);
    }

    public function getAvailableTrips(array $filters)
    {
        return $this->tripRepository->getAvailableTrips($filters);
    }

    public function updateTrip(int $id, array $data)
    {
        $this->validateTripData($data);
        return $this->tripRepository->updateTrip($id, $data);
    }

    public function deleteTrip(int $id)
    {
        return $this->tripRepository->deleteTrip($id);
    }

    protected function validateTripData(array $data)
    {
        $validator = Validator::make($data, [
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departure_time' => 'required|date',
            'price' => 'required|numeric',
            'available_seats' => 'required|integer|min:1',

        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
