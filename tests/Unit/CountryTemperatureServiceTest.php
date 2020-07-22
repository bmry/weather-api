<?php

namespace App\Tests\Unit;


use App\Providers\WeatherDataProvider;
use App\Service\CountryCapitalResolverService;
use App\Service\CountryTemperatureService;
use PHPUnit\Framework\TestCase;

class CountryTemperatureServiceTest extends TestCase
{

    private $weatherDataProviderMock;

    private $countryCapitalResolverMock;

    public function setUp():void
    {
        $this->weatherDataProviderMock = $this->createMock(WeatherDataProvider::class);
        $this->countryCapitalResolverMock = $this->createMock(CountryCapitalResolverService::class);
    }

    public function testThatTemperatureWillbeReturnedIfWeatherInformationIsProvided()
    {
        $weatherInformation = new \stdClass();
        $weatherInformation->temp = 278;

        $this->weatherDataProviderMock->method('getPlaceWeatherInformation')
            ->willReturn($weatherInformation);
        $this->countryCapitalResolverMock->method('getCountryCapitalByCode')
            ->willReturn('Abuja');

        $cityTemperatureService =  new CountryTemperatureService();
        $cityTemperatureService->setDataProvider($this->weatherDataProviderMock);
        $cityTemperatureService->setCountryCapitalResolver($this->countryCapitalResolverMock);
        $this->assertEquals(278, $cityTemperatureService->getPlaceTemperature('Nigeria'));
    }
}