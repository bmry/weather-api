<?php

namespace App\Service\Factory;


use App\Exception\InvalidServiceTypeException;
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

    /**
     * TemperatureServiceFactory constructor.
     * @param WeatherDataProvider $weatherDataProviderService
     * @param CountryCapitalResolverService $countryCapitalResolverService
     */
    public function __construct(
        WeatherDataProvider $weatherDataProviderService,
        CountryCapitalResolverService $countryCapitalResolverService
    )
    {
        $this->weatherDataProvider = $weatherDataProviderService;
        $this->countryCapitalResolver = $countryCapitalResolverService;
    }

    /**
     * @param string $serviceType
     * @return TemperatureServiceInterface
     * @throws InvalidServiceTypeException
     */
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
               throw new InvalidServiceTypeException("Unknown service");
        }


    }

}