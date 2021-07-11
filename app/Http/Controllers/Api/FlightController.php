<?php

namespace App\Http\Controllers\Api;

use App\Services\Amadeus\Flight;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class FlightController extends Controller
{
    public function getFlightOffers(Flight $flight)
    {
        return $flight->flightOffers(request()->only(['originLocationCode', 'destinationLocationCode', 'departureDate', 'returnDate', 'adults', 'children', 'infants', 'travelClass']));
    }

    public function getFlightOffersPrice(Flight $flight)
    {
        return $flight->flightOffersPrice(request()->only(['type', 'flightOffers']));
    }

    public function storeFlightBooking(Flight $flight)
    {
        return $flight->flightBookings(request()->only(['type', 'flightOffers', 'travelers', 'contacts']));
    }
}
