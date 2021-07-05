<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Amadeus\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HotelController extends Controller
{
    public function getHotelOffers(Hotel $hotel)
    {
        $hotels = Cache::remember('hotels', now()->addHours(4), function() use ($hotel) {
            return $hotel->hotelOffers(request()->all());
        });
        
        return $hotels;
    }

    public function getHotelOffersByHotel(Hotel $hotel)
    {
        $hotel = Cache::remember('hotel', now()->addHours(4), function() use ($hotel) {
            return $hotel->hotelOffersByHotel(request()->all());
        });
        
        return $hotel;
    }

    public function getHotelOffersByOffer($offerId, Hotel $hotel)
    {
        $offer = Cache::remember('offer', now()->addHours(4), function() use ($offerId, $hotel) {
            return $hotel->hotelOffersByOffer($offerId);
        });
        
        return $offer;
    }

    public function storeHotelBookings(Request $request, Hotel $hotel)
    {
        return $hotel->hotelBookings($request->data);
    }
}
