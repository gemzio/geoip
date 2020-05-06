<?php

namespace Gemz\GeoIp;

use Gemz\GeoIp\Exceptions\BadRequestException;
use Gemz\GeoIp\Exceptions\InvalidArgument;
use Gemz\HttpClient\Client;

class GeoIp
{
    const LOCALE_DE = 'de';
    const LOCALE_EN = 'en';
    const LOCALE_FR = 'fr';
    const LOCALE_ES = 'es';

    /** @var string */
    protected $search;

    /** @var string */
    protected $locale = 'en';

    /** @var Client */
    protected $client;

    /** @var string */
    protected $baseUrl = 'http://ip-api.com';

    /** @var array */
    protected $fields = [
        'status',
        'query',
        'country',
        'countryCode',
        'region',
        'regionName',
        'city',
        'zip',
        'lat',
        'lon',
        'timezone',
        'isp',
        'org',
        'as',
        'asname',
        'proxy',
        'reverse',
    ];

    /** @var array */
    protected $allowedLocales = [
        self::LOCALE_DE,
        self::LOCALE_EN,
        self::LOCALE_FR,
        self::LOCALE_ES
    ];

    public static function for(string $search): self
    {
        return new self($search);
    }

    public function __construct(string $search)
    {
        $this->client = Client::create();

        $this->resolveSearch($search);
    }

    public function locale(string $locale): self
    {
        if (! in_array($locale, $this->allowedLocales)) {
            throw InvalidArgument::localeNotValid($locale);
        }

        $this->locale = $locale;

        return $this;
    }

    public function baseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    public function get(): array
    {
        return $this->getResult();
    }

    protected function resolveSearch(string $search): string
    {
        if (empty($search)) {
            throw InvalidArgument::emptyQuery();
        }

        $search = str_replace(['http://', 'https://'], '', $search);
        $search = strtolower($search);

        return $this->search = $search;
    }

    protected function getResult(): array
    {
        $this->prepareClient();

        try {
            $response = $this->client->get("json/{$this->search}");

            if (! $response->isOk()) {
                throw BadRequestException::requestNotValid($response->body());
            }

            return $response->asArray();
        } catch (\Exception $e) {
            throw BadRequestException::requestNotValid($e->getMessage());
        }
    }

    protected function prepareClient(): void
    {
        $this->client
            ->baseUri($this->baseUrl)
            ->doNotVerifySsl()
            ->throwErrors()
            ->queryParam('lang', $this->locale);

        if ($this->fields) {
            $this->client->queryParam('fields', implode(',', $this->fields));
        }
    }
}
