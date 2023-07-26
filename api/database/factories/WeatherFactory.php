<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weather>
 */
class WeatherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'     => 1,
            'main'        => 'Sunny',
            'description' => 'Sunny day, no rain projection',
            'temp'        => 85.0,
            'feels_like'  => 88.0,
            'temp_max'    => 90.0,
            'temp_min'    => 72.0,
            'humidity'    => 23,
            'wind_speed'  => 1.0,
            'wind_degree' => 190,
            'clouds'      => 20,
            'rain'        => null,
            'snow'        => null,
            'country'     => 'Argentina',
            'city'        => 'Buenos Aires',
        ];
    }
}
