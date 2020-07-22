<?php

namespace App\Providers;


use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WeatherDataProvider
{
    /**
     * @var ParameterBagInterface $parameterBag
     */
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;

    }

    public function getPlaceWeatherInformation(string $place)
    {
        $weatherAPIKey = $this->parameterBag->get('open_weather_api_key');
        $weatherBaseUrl = $this->parameterBag->get('open_weather_url');
        $dataSource = $weatherBaseUrl.'?q='.$place.'&APPID='.$weatherAPIKey.'&units=metric';
        $httpClient = new Client();

        try {
            $response = $httpClient->request('GET', $dataSource);
            $response = json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
            $response = null;
        }

        return $response->main;
    }

}