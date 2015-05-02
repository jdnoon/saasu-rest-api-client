# saasu-rest-api-client

[![Latest Version](https://img.shields.io/github/release/terah/saasu-rest-api-client.svg?style=flat-square)](https://github.com/terah/saasu-rest-api-client/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/terah/saasu-rest-api-client/master.svg?style=flat-square)](https://travis-ci.org/terah/saasu-rest-api-client)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/terah/saasu-rest-api-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/terah/saasu-rest-api-client/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/terah/saasu-rest-api-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/terah/saasu-rest-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/terah/saasu-rest-api-client.svg?style=flat-square)](https://packagist.org/packages/terah/saasu-rest-api-client)

A PHP Rest Client for Saasu

## Install

Via Composer

``` bash
$ composer require terah/saasu-rest-api-client
```

## Usage

``` php
$skeleton = new Terah\Saasu();
echo $skeleton->echoPhrase('Hello, Terah!');
```

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email terry@terah.com.au instead of using the issue tracker.

## Credits

- [Terry Cullen](https://github.com/terah)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
