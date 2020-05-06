<?php

namespace Gemz\GeoIp\Tests;

use Gemz\GeoIp\Exceptions\InvalidArgument;
use Gemz\GeoIp\GeoIp;
use PHPUnit\Framework\TestCase;

class GeoIpTest extends TestCase
{
    /** @var GeoIp */
    protected $geoip;

    public function setup(): void
    {
        $this->geoip = GeoIp::for('gemz.io');
    }

    public function test_can_query_domain()
    {
        $result = $this->geoip->get();

        $this->assertTrue($result['status'] == 'success');
    }

    public function test_can_query_ip_with_locale()
    {
        $result = GeoIp::for('52.59.200.190')->locale(GeoIp::LOCALE_DE)->get();

        $this->assertTrue($result['status'] == 'success');
    }

    public function test_throws_exception_for_empty_domain()
    {
        $this->expectException(InvalidArgument::class);

        GeoIp::for('')->get();
    }

    public function test_throws_exception_for_invalid_locale()
    {
        $this->expectException(InvalidArgument::class);

        $this->geoip->locale('en-us')->get();
    }
}
