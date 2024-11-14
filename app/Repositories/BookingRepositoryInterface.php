<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;

interface BookingRepositoryInterface
{
    public function createBooking(array $data);
    public function findBookingById(int $id);
    public function updateBooking(int $id, array $data);
    public function getAllBookings(): Collection;

    public function deleteBooking(int $id);
}
