<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Weather;
use App\Services\OpenWeatherMapApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $weatherService = new OpenWeatherMapApi(env('OPEN_WEATHER_MAP_API_KEY'));

        $endpoint = '/data/2.5/weather';
        $params = array(
            'lat' => $this->user->latitude,
            'lon' => $this->user->longitude,
            'units' => 'imperial'
        );

        $data = $weatherService->getRequest($endpoint, $params);
        if (!empty($data)) {
            $weather = [
                'main'        => $data['weather'][0]['main'] ?? null,
                'description' => $data['weather'][0]['description'] ?? null,
                'temp'        => $data['main']['temp'] ?? null,
                'feels_like'  => $data['main']['feels_like'] ?? null,
                'feels_like'  => $data['main']['feels_like'] ?? null,
                'temp_max'    => $data['main']['temp_max'] ?? null,
                'temp_min'    => $data['main']['temp_min'] ?? null,
                'humidity'    => $data['main']['humidity'] ?? null,
                'wind_speed'  => $data['wind']['speed'] ?? null,
                'wind_degree' => $data['wind']['deg'] ?? null,
                'clouds'      => $data['clouds']['all'] ?? null,
                'rain'        => $data['rain']['1h'] ?? null,
                'snow'        => $data['snow']['1h'] ?? null,
                'country'     => $data['sys']['country'] ?? null,
                'city'        => $data['name'] ?? null,
            ];

            Weather::updateOrCreate(
                ['user_id' => $this->user->id],
                $weather
            );
        }
    }
}
