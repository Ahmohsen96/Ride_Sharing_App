<?php
namespace App\Repositories;

use App\Models\Trip;

class TripRepository implements TripRepositoryInterface
{
    public function createTrip(array $data)
    {
        return Trip::create($data);
    }

    public function findTripById(int $id)
    {
        return Trip::findOrFail($id);
    }

    public function getAvailableTrips(array $filters)
    {
        // Assume $filters includes date range, origin, destination, etc.
        $query = Trip::query();

        if (isset($filters['origin'])) {
            $query->where('origin', $filters['origin']);
        }

        if (isset($filters['destination'])) {
            $query->where('destination', $filters['destination']);
        }

        if (isset($filters['date'])) {
            $query->whereDate('departure_time', $filters['date']);
        }

        return $query->where('is_available', true)->get();
    }

    public function updateTrip(int $id, array $data)
    {
        $trip = Trip::findOrFail($id);
        $trip->update($data);
        return $trip;
    }

    public function deleteTrip(int $id)
    {
        $trip = Trip::findOrFail($id);
        return $trip->delete();
    }
}
