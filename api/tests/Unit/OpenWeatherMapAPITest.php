<?php

use Tests\TestCase;
use App\Services\OpenWeatherMapApi;

class OpenWeatherMapAPITest extends TestCase
{
    public function test_get_request_with_valid_endpoint_and_params()
    {
        $openWeatherMap = new OpenWeatherMapAPI(env('OPEN_WEATHER_MAP_API_KEY'));

        $endpoint = '/data/2.5/weather';
        $params = array(
            'lat' => '33.44',
            'lon' => '-94.04',
            'units' => 'imperial'
        );

        $response = $openWeatherMap->getRequest($endpoint, $params);

        // Assert that the response is an array
        $this->assertIsArray($response);
    }

    public function test_get_request_with_invalid_api_key()
    {
        $openWeatherMap = new OpenWeatherMapAPI('invalid_key');

        $endpoint = '/data/2.5/weather';
        $params = array(
            'lat' => '33.44',
            'lon' => '-94.04',
        );

        $response = $openWeatherMap->getRequest($endpoint, $params);

        // Assert that the response is an empty array when API key is invalid
        $this->assertEmpty($response);
    }

    public function test_get_request_with_invalid_endpoint()
    {
        $openWeatherMap = new OpenWeatherMapAPI(env('OPEN_WEATHER_MAP_API_KEY'));

        $endpoint = 'invalid_endpoint';
        $params = array(
            'lat' => '33.44',
            'lon' => '-94.04',
        );

        $response = $openWeatherMap->getRequest($endpoint, $params);

        // Assert that the response is an empty array when endpoint is invalid
        $this->assertEmpty($response);
    }

    public function test_reverse_geolocation()
    {
        $openWeatherMap = new OpenWeatherMapAPI(env('OPEN_WEATHER_MAP_API_KEY'));

        $endpoint = '/geo/1.0/reverse';
        $params = array(
            'lat' => '51.5098',
            'lon' => '-0.1180',
            'limit' => 1
        );

        $response = $openWeatherMap->getRequest($endpoint, $params);
        // Assert that the response array
        $this->assertIsArray($response);
        $this->assertArrayHasKey('name', $response[0]);
        $this->assertArrayHasKey('country', $response[0]);
        $this->assertArrayHasKey('state', $response[0]);
        $this->assertContains('City of Westminster', $response[0]);
    }
}
