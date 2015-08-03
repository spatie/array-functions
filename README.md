

# Some handy array functions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/array-functions.svg?style=flat-square)](https://packagist.org/packages/spatie/array-functions)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/array-functions/master.svg?style=flat-square)](https://travis-ci.org/spatie/array-functions)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/array-functions.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/array-functions)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/860364d5-1d74-4cf8-bdb1-c5e18cdc8a70/mini.png)](https://insight.sensiolabs.com/projects/860364d5-1d74-4cf8-bdb1-c5e18cdc8a70)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/array-functions.svg?style=flat-square)](https://packagist.org/packages/spatie/array-functions)

This package provides some handy array functions. 

Spatie is webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Install

You can install this package via composer:

``` bash
composer require spatie/array-functions
```

## Usage

The following functions are provided in the `Spatie`-namespace:

### array_rand_value
```php
/**
 * Get a random value from an array.
 *
 * @param array $array
 * @param int $numReq  The amount of values to return
 * @return mixed
 */
function array_rand_value(array $array, $numReq = 1)
```

### array_rand_weighted
```php
/**
 * Get a random value from an array, with the ability to skew the results.
 * Example: array_rand_weighted(['foo' => 1, 'bar' => 2]) has a 66% chance of returning bar.
 * 
 * @param array $key
 * 
 * @return mixed
 */
function array_rand_weighted(array $array)
```

### values_in_array
```php
/**
 * Determine if all given needles are present in the haystack.
 *
 * @param array|string $needles
 * @param array $haystack
 *
 * @return bool
 */
function values_in_array($needles, array $haystack)
```

### array_keys_exist
```php
/**
 * Determine if all given needles are present in the haystack as array keys.
 * 
 * @param array|string $needles
 * @param array $haystack
 *
 * @return bool
 */
function array_keys_exist($needles, array $haystack)
```

### array_split_filter
```php
/**
 * Returns an array with two elements.
 * 
 * Iterates over each value in the array passing them to the callback function.
 * If the callback function returns true, the current value from array is returned in the first
 * element of result array. If not, it is return in the second element of result array.
 *
 * Array keys are preserved.
 *
 * @param array $array
 * @param callable $callback
 * @return array
 *
 */
function array_split_filter(array $array, callable $callback)
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

You can run the tests with:

```bash
vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## About Spatie
Spatie is webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
