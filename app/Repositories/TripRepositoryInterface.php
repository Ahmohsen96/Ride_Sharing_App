<?php
namespace App\Repositories;

interface TripRepositoryInterface
{
    public function createTrip(array $data);
    public function findTripById(int $id);
    public function getAvailableTrips(array $filters);
    public function updateTrip(int $id, array $data);
    public function deleteTrip(int $id);
}
