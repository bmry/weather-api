<?php


namespace App\Tests\Unit;



use App\Exception\InvalidServiceTypeException;
use App\Providers\WeatherDataProvider;
use App\Service\CityTemperatureService;
use App\Service\CountryCapitalResolverService;
use App\Service\CountryTemperatureService;
use App\Service\Factory\TemperatureServiceFactory;
use PHPUnit\Framework\TestCase;

class TemperatureServiceFactoryTest extends TestCase
{
    private $weatherDataProviderMock;

    private $countryCapitalResolverMock;

    public function setUp():void
    {
        $this->weatherDataProviderMock = $this->createMock(WeatherDataProvider::class);
        $this->countryCapitalResolverMock = $this->createMock(CountryCapitalResolverService::class);
    }

    public function testThatCityTemperatureServiceIsReturnedIfServiceTypeIsCity()
    {
       $temperatureServiceFactory = new TemperatureServiceFactory(
           $this->weatherDataProviderMock, $this->countryCapitalResolverMock);
       $temperatureService = $temperatureServiceFactory->build(TemperatureServiceFactory::SERVICE_TYPE_CITY_NAME);

       $this->assertInstanceOf(CityTemperatureService::class, $temperatureService);
    }

    public function testThatCountryTemperatureServiceIsReturnedIfServiceTypeIsCountry()
    {
       $temperatureServiceFactory = new TemperatureServiceFactory(
           $this->weatherDataProviderMock, $this->countryCapitalResolverMock);
       $temperatureService = $temperatureServiceFactory->build(TemperatureServiceFactory::SERVICE_TYPE_COUNTRY_CODE);

       $this->assertInstanceOf(CountryTemperatureService::class, $temperatureService);
    }

    /**
     * @expectedException InvalidServiceTypeException
     */
    public function testThatExceptionIsThrowIfInvalidTypeIsPassed()
    {
        $temperatureServiceFactory = new TemperatureServiceFactory(
            $this->weatherDataProviderMock, $this->countryCapitalResolverMock);
        $this->expectException(InvalidServiceTypeException::class);
        $temperatureService = $temperatureServiceFactory->build('town');
    }
}