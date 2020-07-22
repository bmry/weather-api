<?php

namespace App\Exception;


class MangahighWeatherApiException extends \Exception
{
    public const CODE = 3000;

    public function __construct($message = "", $code = self::CODE, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}