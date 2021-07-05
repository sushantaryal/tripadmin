<?php

namespace App\Services\Amadeus;

use Illuminate\Support\Facades\Http;

class Location extends Client
{
    /**
     * Get location from the keyword
     *
     * @param $keyword
     * @param $countryCode
     * @return void
     */
    public function getAirportLocations($keyword, $countryCode = null)
    {
        $params = [
            'subType' => 'AIRPORT',
            'keyword' => $keyword
        ];

        if (!is_null($countryCode)) {
            $params['countryCode'] = $countryCode;
        }

        $response = Http::withToken($this->token)
        ->get($this->endpoint . '/v1/reference-data/locations', $params);

        return $response->json();
    }

    /**
     * Get location from the keyword
     *
     * @param $keyword
     * @param $countryCode
     * @return void
     */
    public function getCityLocations($keyword, $countryCode = null)
    {
        $params = [
            'subType' => 'CITY',
            'keyword' => $keyword
        ];

        if (!is_null($countryCode)) {
            $params['countryCode'] = $countryCode;
        }

        $response = Http::withToken($this->token)
        ->get($this->endpoint . '/v1/reference-data/locations', $params);

        return $response->json();
    }
}