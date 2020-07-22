<?php

namespace App\Service\Factory;


use App\Providers\WeatherDataProvider;
use App\Service\CityTemperatureService;
use App\Service\CountryCapitalResolverService;
use App\Service\CountryTemperatureService;
use App\Service\TemperatureServiceInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TemperatureServiceFactory
{
    const SERVICE_TYPE_CITY_NAME = 'cityName';
    const SERVICE_TYPE_COUNTRY_CODE = 'countryCode';

    /**
     * @var WeatherDataProvider $weatherDataProvider
     */
    private $weatherDataProvider;

    /**
     * @var CountryCapitalResolverService $countryCapitalResolver
     */
    private $countryCapitalResolver;

    public function __construct(
        WeatherDataProvider $weatherDataProviderService,
        CountryCapitalResolverService $countryCapitalResolverService
    )
    {
        $this->weatherDataProvider = $weatherDataProviderService;
        $this->countryCapitalResolver = $countryCapitalResolverService;
    }
    public function build(string $serviceType): TemperatureServiceInterface
    {
        switch ($serviceType){
            case self::SERVICE_TYPE_CITY_NAME:
                $cityTemperatureService = new CityTemperatureService();
                $cityTemperatureService->setDataProvider($this->weatherDataProvider);

                return $cityTemperatureService;
                break;
            case self::SERVICE_TYPE_COUNTRY_CODE;
                $countryTemperatureService = new CountryTemperatureService();
                $countryTemperatureService->setDataProvider($this->weatherDataProvider);
                $countryTemperatureService->setCountryCapitalResolver($this->countryCapitalResolver);
                return $countryTemperatureService;
                break;
            default:
                throw new BadRequestHttpException();
        }


    }

}