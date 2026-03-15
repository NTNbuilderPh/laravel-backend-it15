<?php

return [
    'default_lat' => env('WEATHER_DEFAULT_LAT', '7.4467'),
    'default_lon' => env('WEATHER_DEFAULT_LON', '125.8094'),
    'timeout' => env('WEATHER_TIMEOUT', 10),
    'geocode_timeout' => env('WEATHER_GEOCODE_TIMEOUT', 8),
];
