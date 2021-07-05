<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Amadeus\Location;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function getAirportLocations(Request $request, Location $location)
    {
        if ($request->filled('keyword')) {
            $data = $location->getAirportLocations($request->keyword);

            return $data['data'];
        }
    }

    public function getCityLocations(Request $request, Location $location)
    {
        if ($request->filled('keyword')) {
            $data = $location->getCityLocations($request->keyword);

            return $data['data'];
        }
    }
}
