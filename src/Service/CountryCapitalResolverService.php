<?php

namespace App\Service;


use App\Exception\NonExistentCountryException;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CountryCapitalResolverService
{
    /**
     * @var ParameterBagInterface $parameterBag
     */
    private $parameterBag;

    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger,
        ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
        $this->logger = $logger;
    }

    /**
     * @param string $countryCode
     * @return mixed
     * @throws NonExistentCountryException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
            $this->logger->error($e->getMessage());
            throw new NonExistentCountryException($countryCode);
        }

        return $countryCapital;
    }

}