<?php

namespace Tests\Unit;

use App\Http\Controllers\Actions\User\ListUsersAction;
use App\Http\Controllers\Actions\Weather\GetWeatherByUserId;
use App\Jobs\WeatherJob;
use App\Models\User;
use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowWeatherByUserIdTest extends TestCase
{
    use RefreshDatabase;

    public function test_action_returns_weather_data(): void
    {
        $user = User::factory()->create([
            'latitude' => '51.5098',
            'longitude' => '-0.1180',
        ]);
        $weather = Weather::factory()->create([
            'user_id' => $user->id
        ]);

        $action = new GetWeatherByUserId();
        $actionWeather = $action->handle($user->id);

        $this->assertEquals($weather->toArray(), $actionWeather);
    }

    public function test_action_returns_empty_array_if_no_weather_data(): void
    {
        $user = User::factory()->create([
            'latitude' => '51.5098',
            'longitude' => '-0.1180',
        ]);

        $action = new GetWeatherByUserId();
        $actionWeather = $action->handle($user->id);

        $this->assertEquals([], $actionWeather);
    }
}
