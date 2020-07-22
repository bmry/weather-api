<?php

namespace App\Service;

use App\Providers\WeatherDataProvider;

class CityTemperatureService implements TemperatureServiceInterface
{

    /**
     * @var WeatherDataProvider $weatherDataProvider
     */
    private $weatherDataProvider;

    /**
     * @param string $place
     * @return float
     * @throws \App\Exception\NoWeatherRecordFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPlaceTemperature(string $place): float
    {
        $weatherInformation = $this->weatherDataProvider->getPlaceWeatherInformation($place);
        return $weatherInformation->temp;
    }

    /**
     * @param WeatherDataProvider $weatherDataProviderService
     */
    public function setDataProvider(WeatherDataProvider $weatherDataProviderService): void
    {
        $this->weatherDataProvider = $weatherDataProviderService;
    }

}