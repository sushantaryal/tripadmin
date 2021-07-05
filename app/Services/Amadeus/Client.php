<?php

namespace App\Services\Amadeus;

use Illuminate\Support\Facades\Http;

class Client
{
    /**
     * Access token
     *
     * @var
     */
    public $token;

    /**
     * Api endpoint
     *
     * @var
     */
    public $endpoint;

    public function __construct()
    {
        $this->endpoint = config('amadeus.test') ? 'https://test.api.amadeus.com' : 'https://api.amadeus.com';

        $this->model = config('amadeus.model');

        if ($this->isExpired()) {
            $this->amadeusAuth();
        }

        $this->setToken();
    }

    /**
     * Authenticate amadeus
     *
     * @return void
     */
    public function amadeusAuth()
    {
        $response = Http::asForm()
        ->post($this->endpoint . '/v1/security/oauth2/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('amadeus.api_key'),
            'client_secret' => config('amadeus.api_secret')
        ]);

        return $this->updateDb($response->json());
    }

    /**
     * Update Database with current access token
     *
     * @param $data
     * @return void
     */
    public function updateDb($data)
    {
        $amadeus = $this->model::first();

        if (!$amadeus) {
            $amadeus = new $this->model;
        }

        $amadeus->auth_at = now();
        $amadeus->access_token = $data['access_token'];
        $amadeus->expires_in = $data['expires_in'];
        $amadeus->state = $data['state'];

        $amadeus->save();

        return $amadeus;
    }

    /**
     * Check if access token is expired
     *
     * @return boolean
     */
    public function isExpired()
    {
        $amadeus = $this->model::first();

        if (!$amadeus) {
            return false;
        }

        return !! (now()->timestamp > ($amadeus->auth_at->timestamp + $amadeus->expires_in));
    }

    /**
     * Set current access token
     *
     * @return void
     */
    public function setToken()
    {
        $amadeus = $this->model::first();

        $this->token = $amadeus->access_token;
    }
}