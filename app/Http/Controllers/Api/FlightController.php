<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Amadeus\Flight;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class FlightController extends Controller
{
    public function getFlightOffers(Flight $flight)
    {
        // Cache::forget('flights');
        $flights = Cache::remember('flights', now()->addHours(4), function() use ($flight) {
            return $flight->flightOffers(request()->only(['originLocationCode', 'destinationLocationCode', 'departureDate', 'returnDate', 'adults', 'children', 'infants', 'travelClass']));
        });
        
        return $flights;
    }

    public function getFlightOffersPrice(Flight $flight)
    {
        // Cache::forget('flight-price');
        $flightPrice = Cache::remember('flight-price', now()->addHours(4), function() use ($flight) {
            return $flight->flightOffersPrice(request()->only(['type', 'flightOffers']));
        });
        
        return $flightPrice;
    }

    public function storeFlightBooking(Flight $flight)
    {
        return $flight->flightBookings(request()->only(['type', 'flightOffers', 'travelers', 'contacts']));
    }
}
