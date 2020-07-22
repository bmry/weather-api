<?php

namespace App\Utility;


use App\Model\Temperature;
use Symfony\Component\HttpFoundation\JsonResponse;

class TemperatureResponseUtil
{
    /**
     * @param $temperatureInCelsius
     * @return Temperature
     */
    public static function successResponse($temperatureInCelsius): Temperature
    {
        $temperature = new Temperature();
        $temperature->setTemperatureInCelsius($temperatureInCelsius);
        $temperature->setTemperatureInFahrenheit(TemperatureConverterUtil::convertCelsiusToFahrenheit($temperatureInCelsius));
        $temperature->setTemperatureInKelvin(TemperatureConverterUtil::convertCelsiusToKelvin($temperatureInCelsius));

        return $temperature;
    }

    public static function failureResponse()
    {
        return new JsonResponse("No weather record found");
    }

}