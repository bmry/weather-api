<?php

namespace App\Exception;


class NoWeatherRecordFoundException extends MangahighWeatherApiException
{
    public const MESSAGE = 'No weather record found for: %s';

    public function __construct(string $place, \Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $place), self::CODE, $previous);
    }

}