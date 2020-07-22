<?php

namespace App\Service;




use App\Exception\MangahighWeatherApiException;
use App\Service\Factory\TemperatureServiceFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class TemperatureServiceTypeResolver
{
    /**
     * @var LoggerInterface $logger
     */
    private  $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @return null|string
     * @throws MangahighWeatherApiException
     */
    public function resolveServiceType(Request $request): ?string
    {
        $serviceType = null;

        if($request->query->has('cityName') && $request->query->get('cityName')){
            $serviceType = TemperatureServiceFactory::SERVICE_TYPE_CITY_NAME;
        }

        if($request->query->has('countryCode') && $request->query->get('countryCode')){
            $serviceType = TemperatureServiceFactory::SERVICE_TYPE_COUNTRY_CODE;
        }

        if(!$serviceType){
            $message = "Unknown operation.Please provide cityName or a Countrycode";
            $this->logger->error($message);
            throw new MangahighWeatherApiException($message);
        }
        return $serviceType;
    }

}