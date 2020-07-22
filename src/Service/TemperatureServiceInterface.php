<?php

namespace App\Service;


use App\Model\Temperature;
use App\Providers\WeatherDataProvider;

interface TemperatureServiceInterface
{
    public function getPlaceTemperature(string $place): float ;

    public function setDataProvider(WeatherDataProvider $weatherDataProvider): void;

}