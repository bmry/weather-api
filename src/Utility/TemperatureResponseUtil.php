<?php

namespace App\Utility;


use App\Model\Temperature;

class TemperatureResponseUtil
{
    /**
     * @param $temperatureInCelsius
     * @return Temperature
     */
    public static function TemperatureResponse($temperatureInCelsius): Temperature
    {
        $temperature = new Temperature();
        $temperature->setTemperatureInCelsius($temperatureInCelsius);
        $temperature->setTemperatureInFahrenheit(TemperatureConverterUtil::convertCelsiusToFahrenheit($temperatureInCelsius));
        $temperature->setTemperatureInKelvin(TemperatureConverterUtil::convertCelsiusToKelvin($temperatureInCelsius));

        return $temperature;
    }
}