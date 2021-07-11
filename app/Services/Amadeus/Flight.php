<?php

namespace App\Services\Amadeus;

use Illuminate\Support\Facades\Http;

class Flight extends Client
{
    /**
     * Get flight offers
     *
     * @param array $params
     * @return void
     */
    public function flightOffers(array $params)
    {
        $params['currencyCode'] = 'USD';

        $response = Http::withToken($this->token)
        ->get($this->endpoint . '/v2/shopping/flight-offers', $params);

        return $response->json();
    }

    /**
     * Get flight offers
     *
     * @param $data
     * @return void
     */
    public function flightOffersPrice($data)
    {
        $response = Http::withToken($this->token)
        ->post($this->endpoint . '/v1/shopping/flight-offers/pricing', [
            'data' => $data
        ]);

        return $response->json();
    }

    public function flightBookings($data)
    {
        $response = Http::withToken($this->token)
        ->post($this->endpoint . '/v1/booking/flight-orders', [
            'data' => $data
        ]);

        return $response->json();
    }
}