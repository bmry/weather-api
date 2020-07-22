<?php

namespace App\Service;




use App\Service\Factory\TemperatureServiceFactory;
use Symfony\Component\HttpFoundation\Request;

class TemperatureServiceTypeResolver
{
    /**
     * @param Request $request
     * @return null|string
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

        return $serviceType;
    }

}