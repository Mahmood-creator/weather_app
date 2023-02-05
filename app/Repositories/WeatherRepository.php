<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class WeatherRepository extends BaseRepository
{
    protected string $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';
    protected string $apiKey = 'cd0e5d6e8a3e8b106d3f4e6534e2db7c';

    public function weather(array $params)
    {
        $units = $params['units'] ?? 'default';

        $measureTemperature = 'K';

        $measureSpeed = 'm/s';

        if ($units == 'metric')
        {
            $measureTemperature = 'C';
        }

        if ($units == 'imperial')
        {
            $measureTemperature = 'F';

            $measureSpeed = 'm/h';

        }

        $weather = collect(Http::get(
            $this->baseUrl.'?lat='.
            $params['lat'].'&lon='.
            $params['lon'].'&appid='.
            $this->apiKey.'&lang='.
            $params['lang'].'&units='.
            $units
        )->json());

        return [
            'wind_description' => $weather->get('weather')[0]['description'],
            'wind_speed' => $weather->get('wind')['speed'].' '. $measureSpeed,
            'wind_degree' => $weather->get('wind')['deg'],
            'pressure' => $weather->get('main')['pressure']. ' hPa',
            'humidity' => $weather->get('main')['humidity'].' %',
            'clouds' => $weather->get('clouds')['all'],
            'temperature' => $weather->get('main')['feels_like'].' '.$measureTemperature,
            'city' => $weather->get('name'),
        ];

    }
}
