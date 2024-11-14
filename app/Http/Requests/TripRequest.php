<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:1',
            'is_available' => 'sometimes|boolean',
            'driver_id' => 'required',
        ];
    }
}
