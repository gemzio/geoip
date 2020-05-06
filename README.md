# Get GeoIp informations from ip-api.com

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gemz/geoip.svg?style=flat-square)](https://packagist.org/packages/gemz/geoip)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/gemzio/geoip/run-tests?label=tests)](https://github.com/gemzio/geoip/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Quality Score](https://img.shields.io/scrutinizer/g/gemzio/geoip.svg?style=flat-square)](https://scrutinizer-ci.com/g/gemzio/geoip)
[![Total Downloads](https://img.shields.io/packagist/dt/gemz/geoip.svg?style=flat-square)](https://packagist.org/packages/gemz/geoip)

This package uses [ip-api.com](https://ip-api.com) for getting geo ip informations.

## Installation

You can install the package via composer:

```bash
composer require gemz/geoip
```

## Usage

``` php
use \Gemz\GeoIp\GeoIp;

// get by domain
$result = GeoIp::for('gemz.io')->get();

// get by ip
$result = GeoIp::for('52.59.200.190')->get();

// result in specific locale
// supported are de, en, fr, es default is en
$result = GeoIp::for('gemz.io')->locale('en')->get();

// response is an array with these values
array:17 [
  "status" => "success"
  "country" => "Germany"
  "countryCode" => "DE"
  "region" => "HE"
  "regionName" => "Hesse"
  "city" => "Frankfurt am Main"
  "zip" => "60313"
  "lat" => 50.1109
  "lon" => 8.68213
  "timezone" => "Europe/Berlin"
  "isp" => "Amazon Technologies Inc."
  "org" => "AWS EC2 (eu-central-1)"
  "as" => "AS16509 Amazon.com, Inc."
  "asname" => "AMAZON-02"
  "reverse" => "ec2-52-59-200-190.eu-central-1.compute.amazonaws.com"
  "proxy" => false
  "query" => "52.59.200.190"
]

// if request is not successful
[
    "status" => "fail",
    "query" => "notvalid domain",
]
```

### Testing

``` bash
composer test
composer test-coverage
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email stefan@sriehl.com instead of using the issue tracker.

## Credits

- [Stefan Riehl](https://github.com/stefanriehl)

## Support us

Gemz.io is maintained by [Stefan Riehl](https://github.com/stefanriehl). You'll find all open source
projects on [Gemz.io github](https://github.com/gemzio).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
