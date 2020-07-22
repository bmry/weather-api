<?php

namespace App\Service;


use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CountryCapitalResolverService
{
    /**
     * @var ParameterBagInterface $parameterBag
     */
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getCountryCapitalByCode(string $countryCode)
    {
        $httpClient = new Client();
        $countriesInfoAPI = $this->parameterBag->get('countries_info_url');
        $countriesDatasource = $countriesInfoAPI.$countryCode;

        try {
            $response = $httpClient->request('GET', $countriesDatasource);
            $countryInformation = json_decode($response->getBody()->getContents());
            $countryCapital = $countryInformation->capital;

        } catch (\Exception $e) {

            $countryCapital = null;
        }

        return $countryCapital;
    }

}