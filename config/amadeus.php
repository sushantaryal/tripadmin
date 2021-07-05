<?php

return [

    'test' => env('AMADEUS_TEST', false),

    'api_key' => env('AMADEUS_KEY'),

    'api_secret' => env('AMADEUS_SECRET'),

    'model' => App\Models\Amadeus::class,

];