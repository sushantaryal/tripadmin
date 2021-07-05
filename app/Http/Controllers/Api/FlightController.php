<?php

namespace App\Http\Controllers\Api;

use App\Services\Amadeus\Flight;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class FlightController extends Controller
{
    public function getFlightOffers(Flight $flight)
    {
        $flights = Cache::remember('flights', now()->addHours(4), function() use ($flight) {
            return $flight->flightOffers(request()->all());
        });
        
        return response()->json($flights);
    }
}
