<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Proxy current weather + 5-day forecast from Open-Meteo.
     * Accepts optional lat/lon query params; defaults to Tagum City.
     *
     * GET /api/weather?lat=7.4467&lon=125.8094
     */
    public function forecast(Request $request)
    {
        $lat = $request->query('lat', env('WEATHER_DEFAULT_LAT', '7.4467'));
        $lon = $request->query('lon', env('WEATHER_DEFAULT_LON', '125.8094'));

        $response = Http::timeout(10)->get('https://api.open-meteo.com/v1/forecast', [
            'latitude'   => $lat,
            'longitude'  => $lon,
            'current'    => 'temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m,apparent_temperature',
            'daily'      => 'weather_code,temperature_2m_max,temperature_2m_min,precipitation_sum',
            'timezone'   => 'Asia/Manila',
            'forecast_days' => 6,
        ]);

        if ($response->failed()) {
            return response()->json([
                'message' => 'Failed to fetch weather data from upstream.',
            ], 502);
        }

        return response()->json($response->json());
    }

    /**
     * Geocode a city name via Open-Meteo geocoding API.
     *
     * GET /api/weather/geocode?city=Tagum
     */
    public function geocode(Request $request)
    {
        $city = $request->query('city', '');

        if (empty($city)) {
            return response()->json(['message' => 'City name is required.'], 422);
        }

        $response = Http::timeout(8)->get('https://geocoding-api.open-meteo.com/v1/search', [
            'name'     => $city,
            'count'    => 5,
            'language' => 'en',
            'format'   => 'json',
        ]);

        if ($response->failed()) {
            return response()->json([
                'message' => 'Geocoding request failed.',
            ], 502);
        }

        return response()->json($response->json());
    }
}
