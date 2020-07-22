<?php

namespace App\Service;


use App\Providers\WeatherDataProvider;

class CountryTemperatureService implements TemperatureServiceInterface
{

    /**
     * @var WeatherDataProvider $weatherDataProvider
     */
    private $weatherDataProvider;

    /**
     * @var CountryCapitalResolverService $countryCapitalResolver
     */
    private $countryCapitalResolver;

    public function getPlaceTemperature(string $place): float
    {
        $countryCapital = $this->countryCapitalResolver->getCountryCapitalByCode($place);
        $weatherInformation = $this->weatherDataProvider->getPlaceWeatherInformation($countryCapital);
        return $weatherInformation->temp;

    }

    /**
     * @param WeatherDataProvider $weatherDataProviderService
     */
    public function setDataProvider(WeatherDataProvider $weatherDataProviderService): void
    {
        $this->weatherDataProvider = $weatherDataProviderService;
    }

    /**
     * @param CountryCapitalResolverService $countryCapitalResolverService
     */
    public function setCountryCapitalResolver(CountryCapitalResolverService $countryCapitalResolverService):void
    {
        $this->countryCapitalResolver = $countryCapitalResolverService;
    }

}