<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\LocationController;

Route::post('login', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'store']);
Route::post('register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'show']);

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::put('password', [\Laravel\Fortify\Http\Controllers\PasswordController::class, 'update']);
        Route::put('profile-information', [\Laravel\Fortify\Http\Controllers\ProfileInformationController::class, 'update']);
    });

    Route::post('logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy']);
});

Route::get('countries', [CountryController::class, 'index']);

Route::get('airport-locations', [LocationController::class, 'getAirportLocations']);
Route::get('city-locations', [LocationController::class, 'getCityLocations']);

Route::get('hotel-offers', [HotelController::class, 'getHotelOffers']);
Route::get('hotel-offers/by-hotel', [HotelController::class, 'getHotelOffersByHotel']);
Route::get('hotel-offers/{offerId}', [HotelController::class, 'getHotelOffersByOffer']);
Route::post('booking/hotel-bookings', [HotelController::class, 'storeHotelBookings']);

Route::get('flight-offers', [FlightController::class, 'getFlightOffers']);
Route::post('flight-offers/pricing', [FlightController::class, 'getFlightOffersPrice']);
