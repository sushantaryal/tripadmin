<?php

namespace App\Services\Amadeus;

use Illuminate\Support\Facades\Http;

class Hotel extends Client
{
    /**
     * Get hotel offers
     *
     * @param array $params
     * @return void
     */
    public function hotelOffers(array $params = [])
    {
        $params['currency'] = 'USD';

        $response = Http::withToken($this->token)
        ->get($this->endpoint . '/v2/shopping/hotel-offers', $params);

        return $response->json();
    }

    /**
     * Get hotel offers by hotel
     *
     * @param array $params
     * @return void
     */
    public function hotelOffersByHotel(array $params = [])
    {
        $params['currency'] = 'USD';

        $response = Http::withToken($this->token)
        ->get($this->endpoint . '/v2/shopping/hotel-offers/by-hotel', $params);

        return $response->json();
    }

    /**
     * Get hotel offers by offerid
     *
     * @param string $offer
     * @return void
     */
    public function hotelOffersByOffer($offer)
    {
        $response = Http::withToken($this->token)
        ->get($this->endpoint . '/v2/shopping/hotel-offers/' . $offer);

        return $response->json();
    }

    /**
     * Book a hotel room
     *
     * @param $data
     * @return void
     */
    public function hotelBookings($data)
    {
        $response = Http::withToken($this->token)
        ->post($this->endpoint . '/v1/booking/hotel-bookings', [
            'data' => $data
        ]);

        return $response->json();
    }
}