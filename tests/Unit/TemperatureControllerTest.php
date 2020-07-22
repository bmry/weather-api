<?php

namespace App\Tests\Unit;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use PHPUnit\Framework\TestCase;

class TemperatureControllerTest extends ApiTestCase
{

    public function testTemperatureSuccessResponseIsReturnedIfCountryCodeIsValid()
    {
        $response = static::createClient()->request('GET', '/api/temperatures?countryCode=AU',
            [
             'headers' => [
                 'Accept' => 'application/json'
             ]
        ]);

        $content = json_decode($response->getContent());

        $this->assertObjectHasAttribute('temperature_in_celsius', $content);
        $this->assertObjectHasAttribute('temperature_in_kelvin', $content);
        $this->assertObjectHasAttribute('temperature_in_fahrenheit', $content);
        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');
    }

    public function testTemperatureFailureResponseIsReturnedIfCountryCodeIsInValid()
    {
        $response = static::createClient()->request('GET', '/api/temperatures?countryCode=AUY',
            [
             'headers' => [
                 'Accept' => 'application/json'
             ]
        ]);

        $content = $response->getContent();
        $this->assertEquals('"No weather record found"', $content);
    }

    public function testTemperatureFailureResponseIsReturnedIfCityNameIsInValid()
    {
        $response = static::createClient()->request('GET', '/api/temperatures?countryCode=ANKDWJ',
            [
             'headers' => [
                 'Accept' => 'application/json'
             ]
        ]);

        $content = $response->getContent();
        $this->assertEquals('"No weather record found"', $content);
    }

    public function testTemperatureSuccessResponseIsReturnedIfCityNameIsValid()
    {
        $response = static::createClient()->request('GET', '/api/temperatures?cityName=London',
            [
             'headers' => [
                 'Accept' => 'application/json'
             ]
        ]);

        $content = json_decode($response->getContent());

        $this->assertObjectHasAttribute('temperature_in_celsius', $content);
        $this->assertObjectHasAttribute('temperature_in_kelvin', $content);
        $this->assertObjectHasAttribute('temperature_in_fahrenheit', $content);
        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');
    }


}