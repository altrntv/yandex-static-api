<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Your personal API key for accessing the Yandex Static Maps service.
    | You can obtain it in the Yandex Developer Console:
    | https://developer.tech.yandex.ru/
    |
    | This key is required to authenticate requests to the API.
    |
    */

    'api_key' => env('YANDEX_STATIC_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for Yandex Static Maps API.
    |
    */

    'url' => env('YANDEX_STATIC_URL', 'https://static-maps.yandex.ru'),
];
