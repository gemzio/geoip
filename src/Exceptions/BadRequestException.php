<?php

namespace Gemz\GeoIp\Exceptions;

class BadRequestException extends \Exception
{
    public static function requestNotValid(string $message): self
    {
        return new self("The given request throws an exception with message `{$message}`");
    }
}
