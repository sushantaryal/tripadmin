<?php

namespace App\Http\Controllers\Api;

use App\Services\Amadeus\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\HotelBookingRequest;

class HotelController extends Controller
{
    public function getHotelOffers(Hotel $hotel)
    {
        return $hotel->hotelOffers(request()->all());
    }

    public function getHotelOffersByHotel(Hotel $hotel)
    {
        return $hotel->hotelOffersByHotel(request()->all());
    }

    public function getHotelOffersByOffer($offerId, Hotel $hotel)
    {
        return $hotel->hotelOffersByOffer($offerId);
    }

    public function storeHotelBookings(HotelBookingRequest $request, Hotel $hotel)
    {
        return $hotel->hotelBookings($request->only(['offerId', 'guests', 'payments', 'rooms']));
    }
}
