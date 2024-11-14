<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'trip_id' => 'required|exists:trips,id',
            // 'user_id' => 'required|exists:users,id',
            'available_seats' => 'required|integer|min:1',
            // 'price' => 'required|numeric|min:0',
        ];
    }
}
