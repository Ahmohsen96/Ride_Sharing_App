<?php
namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;


class BookingRepository implements BookingRepositoryInterface
{

    public function getAllBookings(): Collection
    {
        return Booking::with('trip', 'passenger')->get();  // Includes related models if needed
    }

    public function createBooking(array $data)
    {
        return Booking::create($data);
    }

    public function findBookingById(int $id)
    {
        return Booking::findOrFail($id);
    }

    public function updateBooking(int $id, array $data)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($data);
        return $booking;
    }

    public function deleteBooking(int $id)
    {
        $booking = Booking::findOrFail($id);
        return $booking->delete();
    }
}

