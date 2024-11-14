<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('auth/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    // Authenticated user routes
    Route::post('auth/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

    // Trip routes
    Route::get('trips', [App\Http\Controllers\Api\TripController::class, 'index']);
    Route::get('trips/{id}', [App\Http\Controllers\Api\TripController::class, 'show']);


    Route::middleware(['auth', 'role:driver'])->group(function () {
        Route::post('/trips', [App\Http\Controllers\Api\TripController::class, 'store']);
        Route::put('trips/{id}', [App\Http\Controllers\Api\TripController::class, 'update']);
        Route::delete('trips/{id}', [App\Http\Controllers\Api\TripController::class, 'destroy']);
    });
    // Route::middleware('can:is-driver')->group(function () {
    //     Route::post('trips', [App\Http\Controllers\Api\TripController::class, 'store']);

    // });



    Route::middleware(['auth', 'role:passenger'])->group(function () {
        // Route::post('/bookings', [BookingController::class, 'store']);

        Route::post('bookings', [App\Http\Controllers\Api\BookingController::class, 'store'])->middleware('trip.available');
        Route::get('bookings', [App\Http\Controllers\Api\BookingController::class, 'index']);
        Route::get('bookings/{id}', [App\Http\Controllers\Api\BookingController::class, 'show'])->middleware('trip.available');
        Route::put('bookings/{id}', [App\Http\Controllers\Api\BookingController::class, 'update'])->middleware('trip.available');
        Route::delete('bookings/{id}', [App\Http\Controllers\Api\BookingController::class, 'destroy'])->middleware('trip.available');
        // Route::post('/bookings/{trip_id}', [BookingController::class, 'store'])->middleware(['auth', 'trip.available']);

    });

    // Booking routes


});


