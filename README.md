# Laravel Swivel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-scrutinizer-build]][link-build]
[![Coverage Status][ico-scrutinizer-coverage]][link-scrutinizer-coverage]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

[Zumba Swivel](https://github.com/zumba/swivel) is a library that allows PHP
applications to manage features to multiple users via buckets. It consists
with 10 buckets, allowing the same code have up to 10 different behaviors.

This package is a bridge between Laravel/Lumen and Swivel. It provides a Facade,
and Entity classes to be used in your Laravel application.

## Structure

If you want to make a contribution, please make sure you follow Laravel package
structure.

## Install

Via Composer

``` bash
$ composer require webkod3r/laravel-swivel
```

Rgister the new service provider in your application:

```php
$app->register(LaravelSwivel\SwivelServiceProvider::class);
```

After installing the package you can copy the default configuration and replace
it with your own. In order to do that copy the file inside
`vendor/webkod3r/laravel-swivel/config/swivel.php` into your onw project.

## Usage

Calling the app IoC and making your own instance

``` php
$swivel = app()->make('swivel');
$swivel->returnValue('CoolFeature', 'Active', 'No Active');
```

or, using the shipped `Facade`

``` php
use LaravelSwivel\Facades\Swivel;

Swivel::returnValue('CoolFeature', 'Active', 'No Active');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please notify and open an issue.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Dcoker usage
```
docker run --rm -it --volume $(pwd):/var/www/html/ php:7.4-fpm-alpine /bin/ash
docker run --rm -it --volume $(pwd):/var/www/html/ php:8.0-fpm-alpine /bin/ash
```

[ico-version]: https://img.shields.io/packagist/v/webkod3r/laravel-swivel.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer-coverage]: https://scrutinizer-ci.com/g/webkod3r/laravel-swivel/badges/coverage.png?b=master
[ico-scrutinizer-build]: https://scrutinizer-ci.com/g/webkod3r/laravel-swivel/badges/build.png?b=master
[ico-code-quality]: https://scrutinizer-ci.com/g/webkod3r/laravel-swivel/badges/quality-score.png?b=master
[ico-downloads]: https://img.shields.io/packagist/dt/webkod3r/laravel-swivel.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/webkod3r/laravel-swivel
[link-build]: https://scrutinizer-ci.com/g/webkod3r/laravel-swivel/badges/build.png?b=master
[link-scrutinizer-coverage]: https://scrutinizer-ci.com/g/webkod3r/laravel-swivel/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/webkod3r/laravel-swivel
[link-downloads]: https://packagist.org/packages/webkod3r/laravel-swivel
[link-author]: https://github.com/webkod3r
