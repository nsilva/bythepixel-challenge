<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Weather;
use App\Jobs\WeatherJob;

class WeatherJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_updates_weather_data(): void
    {
        $user = User::factory()->create([
            'latitude' => '51.5098',
            'longitude' => '-0.1180',
        ]);

        $job = new WeatherJob($user);
        $job->handle();

        $user->refresh();

        $weatherData = $user->weather->toArray();
        $this->assertContains('London', $weatherData);
        $this->assertContains('GB', $weatherData);

        $this->assertArrayHasKey('user_id', $weatherData);
        $this->assertArrayHasKey('temp', $weatherData);
        $this->assertArrayHasKey('main', $weatherData);
        $this->assertArrayHasKey('humidity', $weatherData);
        $this->assertArrayHasKey('wind_speed', $weatherData);
    }
}
