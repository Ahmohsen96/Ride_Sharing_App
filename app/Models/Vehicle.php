<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'vehicle_type', 'license_plate',
        'color', 'capacity', 'vehicle_image', 'is_verified'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
