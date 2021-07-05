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

        // foreach ($oarams as $key => $value) {
        //     $params[$key] = $value;
        // }

        $response = Http::withToken($this->token)
        ->get($this->endpoint . '/v2/shopping/flight-offers', $params);

        return $response->collect();
    }
}