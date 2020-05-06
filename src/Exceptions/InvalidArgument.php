<?php

namespace Gemz\GeoIp\Exceptions;

class InvalidArgument extends \Exception
{
    public static function queryNotValid(string $query): self
    {
        return new self("The given query `{$query}` is not a valid url or ipv4 or ipv6 address");
    }

    public static function localeNotValid(string $locale): self
    {
        return new self("The given locale `{$locale}` is not a valid locale");
    }

    public static function emptyQuery()
    {
        return new self("There is no query. Please provide a query in form of for('domain')");
    }
}
