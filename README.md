# Laravel Swivel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
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
LaravelSwivel\Facades\Swivel::returnValue('CoolFeature', 'Active', 'No Active');
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

[ico-version]: https://img.shields.io/packagist/v/webkod3r/laravel-swivel.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/webkod3r/laravel-swivel/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/webkod3r/laravel-swivel.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/webkod3r/laravel-swivel.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/webkod3r/laravel-swivel.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/webkod3r/laravel-swivel
[link-travis]: https://travis-ci.org/webkod3r/laravel-swivel
[link-scrutinizer]: https://scrutinizer-ci.com/g/webkod3r/laravel-swivel/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/webkod3r/laravel-swivel
[link-downloads]: https://packagist.org/packages/webkod3r/laravel-swivel
[link-author]: https://github.com/webkod3r
