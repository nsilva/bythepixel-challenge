<?php

namespace App\Services;

class OpenWeatherMapApi {

    private string $baseURL = 'https://api.openweathermap.org';
    private string $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Performs the get request to the API.
     * Weather data endpoint: /data/2.5/weather
     * Geocoding endpoint: /geo.1.0/reverse
     *
     * @param string $endpoint
     * @param array $params
     * @return array
     */
    public function getRequest(string $endpoint, array $params = []): array
    {
        $url = $this->buildURL($endpoint, $params);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);

            if ($response === false) {
                throw new \Exception(curl_error($ch));
            }

            curl_close($ch);

            $result = json_decode($response, true);

            if (isset($result['cod']) && $result['cod'] !== 200) {
                throw new \Exception(isset($result['message']) ? $result['message'] : 'Unknown error');
            }

            return $result;
        } catch (\Exception $e) {
            return array();
        }
    }

    private function buildURL(string $endpoint, array $params): string
    {
        $queryString = http_build_query($params);
        return "{$this->baseURL}{$endpoint}?{$queryString}&appid={$this->apiKey}";
    }
}

