<?php

namespace App\Controller;

use App\Exception\MangahighWeatherApiException;
use App\Model\Temperature;
use App\Service\Factory\TemperatureServiceFactory;
use App\Providers\WeatherDataProvider;
use App\Service\TemperatureServiceTypeResolver;
use App\Utility\TemperatureResponseUtil;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TemperatureController
 * @package App\Controller
 */
class TemperatureController
{

    /**
     * @param Request $data
     * @param WeatherDataProvider $weatherDataProviderService
     * @param TemperatureServiceTypeResolver $temperatureServiceTypeResolver
     * @param TemperatureServiceFactory $temperatureServiceFactory
     * @return Temperature|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(
        Request $data,
        WeatherDataProvider $weatherDataProviderService,
        TemperatureServiceTypeResolver $temperatureServiceTypeResolver,
        TemperatureServiceFactory $temperatureServiceFactory)
    {
        try{
            $serviceType = $temperatureServiceTypeResolver->resolveServiceType($data);
            $temperatureService = $temperatureServiceFactory->build($serviceType);
            $place = $data->query->get($serviceType);
            $temperatureInCelsius = $temperatureService->getPlaceTemperature($place);

        }catch (MangahighWeatherApiException $mangahighWeatherApiException){
            return  TemperatureResponseUtil::failureResponse();
        }

        return TemperatureResponseUtil::successResponse($temperatureInCelsius);

    }

}