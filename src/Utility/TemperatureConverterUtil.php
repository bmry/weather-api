<?php


namespace App\Utility;


class TemperatureConverterUtil
{
    const UNIT_KELVIN = 273.15;

    const UNIT_FAHRENHEIT = 32;
    /**
     * @param float $temperatureInCelsius
     * @return float
     */
    public static function convertCelsiusToKelvin(float $temperatureInCelsius): float
    {
        return $temperatureInCelsius + self::UNIT_KELVIN;

    }

    /**
     * @param float $temperatureFahrenheit
     * @return float
     */
    public static function convertCelsiusToFahrenheit(float $temperatureInCelsius ): float
    {
        return (($temperatureInCelsius * (9/5)) + 32);

    }

}