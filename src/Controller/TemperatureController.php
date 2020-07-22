<?php

namespace App\Controller;

use App\Model\Temperature;
use App\Service\Factory\TemperatureServiceFactory;
use App\Providers\WeatherDataProvider;
use App\Service\TemperatureServiceTypeResolver;
use App\Utility\TemperatureResponseUtil;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @return Temperature
     */
    public function __invoke(
        Request $data,
        WeatherDataProvider $weatherDataProviderService,
        TemperatureServiceTypeResolver $temperatureServiceTypeResolver,
        TemperatureServiceFactory $temperatureServiceFactory): Temperature
    {
        $serviceType = $temperatureServiceTypeResolver->resolveServiceType($data);
        $temperatureService = $temperatureServiceFactory->build($serviceType);
        $place = $data->query->get($serviceType);

        $temperatureInCelsius = $temperatureService->getPlaceTemperature($place);

        return TemperatureResponseUtil::TemperatureResponse($temperatureInCelsius);

    }

}