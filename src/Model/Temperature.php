<?php

namespace App\Model;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * Class Temperature
 * @package App\Model
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={
 *          "temperature"={
 *              "method"="GET",
 *              "path"="/temperatures",
 *              "controller"="App\Controller\TemperatureController",
 *              "defaults"={ "_api_receive"=false}
 *     }
 * }
 * )
 */
class Temperature
{
    /**
     * @ApiProperty(identifier=true)
     * @var float $temperatureInCelsius
     */
    protected $temperatureInCelsius;

    /**
     * @var float $temperatureInKelvin
     */
    protected $temperatureInKelvin;

    /**
     * @var float $temperatureInFahrenheit
     */
    protected $temperatureInFahrenheit;

    /**
     * @return float
     */
    public function getTemperatureInCelsius(): float
    {
        return $this->temperatureInCelsius;
    }

    /**
     * @param float $temperatureInCelsius
     * @return Temperature
     */
    public function setTemperatureInCelsius(float $temperatureInCelsius): self
    {
        $this->temperatureInCelsius = $temperatureInCelsius;

        return $this;
    }

    /**
     * @return float
     */
    public function getTemperatureInKelvin(): float
    {
        return $this->temperatureInKelvin;
    }

    /**
     * @param $temperatureInKelvin
     * @return Temperature
     */
    public function setTemperatureInKelvin($temperatureInKelvin): self
    {
        $this->temperatureInKelvin = $temperatureInKelvin;

        return $this;
    }

    /**
     * @return float
     */
    public function getTemperatureInFahrenheit(): float
    {
        return $this->temperatureInFahrenheit;
    }

    /**
     * @param string $temperatureInFahrenheit
     * @return Temperature
     */
    public function setTemperatureInFahrenheit(string $temperatureInFahrenheit): self
    {
        $this->temperatureInFahrenheit = $temperatureInFahrenheit;

        return $this;
    }


}