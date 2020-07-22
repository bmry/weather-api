<?php

namespace App\Providers;


use App\Exception\NoWeatherRecordFoundException;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WeatherDataProvider
{
    /**
     * @var ParameterBagInterface $parameterBag
     */
    private $parameterBag;

    private $logger;

    /**
     * WeatherDataProvider constructor.
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(
        LoggerInterface $logger,
        ParameterBagInterface $parameterBag
    )
    {
        $this->parameterBag = $parameterBag;
        $this->logger = $logger;
    }

    /**
     * @param string $place
     * @return mixed
     * @throws NoWeatherRecordFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPlaceWeatherInformation(string $place)
    {
        $weatherAPIKey = $this->parameterBag->get('open_weather_api_key');
        $weatherBaseUrl = $this->parameterBag->get('open_weather_url');
        $dataSource = $weatherBaseUrl.'?q='.$place.'&APPID='.$weatherAPIKey.'&units=metric';
        $httpClient = new Client();

        try {
            $response = $httpClient->request('GET', $dataSource);
            $weatherInformation = json_decode($response->getBody()->getContents());
            $weatherInformation = $weatherInformation->main;
        } catch (\Exception $e) {

            $this->logger->error($e->getMessage());
            throw new NoWeatherRecordFoundException($place);
        }

        return $weatherInformation;
    }

}