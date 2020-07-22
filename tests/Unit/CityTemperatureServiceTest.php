<?php

namespace App\Tests\Unit;


use App\Providers\WeatherDataProvider;
use App\Service\CityTemperatureService;
use PHPUnit\Framework\TestCase;

class CityTemperatureServiceTest extends TestCase
{

    private $weatherDataProviderMock;

    public function setUp():void
    {
        $this->weatherDataProviderMock = $this->createMock(WeatherDataProvider::class);
    }


    public function testThatCityWillbeReturnedIfWeatherInformationIsProvided()
    {
        $weatherInformation = new \stdClass();
        $weatherInformation->temp = 278;

        $this->weatherDataProviderMock->method('getPlaceWeatherInformation')
            ->willReturn($weatherInformation);

        $cityTemperatureService =  new CityTemperatureService();
        $cityTemperatureService->setDataProvider($this->weatherDataProviderMock);
        $this->assertEquals(278, $cityTemperatureService->getPlaceTemperature('Lagos'));
    }
}