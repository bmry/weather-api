<?php

namespace App\Exception;


class NonExistentCountryException extends MangahighWeatherApiException
{
    public const MESSAGE = 'A country with the code: %s does not exist';

    public function __construct(string $countryCode, \Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $countryCode), self::CODE, $previous);
    }

}