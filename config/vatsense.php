<?php

// config for Vulpecula/Vatsense
return [
    /*
     * The VATSense API key that allows access to the API.
     */
    'api_key' => env('VATSENSE_API_KEY'),

    /*
     * The amount of minutes the VATSense API responses will be cached.
     * If you set this to zero, the responses won't be cached at all.
     */
    'cache_lifetime_in_minutes' => 60 * 24,

    /*
     * Here you may configure the "store" that the underlying VATSense will
     * use to store its data.
     */
    'cache' => [
        'store' => 'file',
    ],
];
