# Indigo Money

[![Latest Version](https://img.shields.io/github/release/indigophp/money.svg?style=flat-square)](https://github.com/indigophp/money/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/money/develop.svg?style=flat-square)](https://travis-ci.org/indigophp/money)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/money.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/money)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/money.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/money)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/money.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/money)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/money.svg?style=flat-square)](https://packagist.org/packages/indigophp/money)

**This package provides some extensions for [mathiasverraes/money](https://github.com/mathiasverraes/money).**


## Install

Via Composer

``` bash
$ composer require indigophp/money
```


## Usage

See the list of extensions bellow:

- DBAL type
- Exchange

The extensions are kept in the same namespace as the extended library (either Money or any third-party).


### Exchange

``` php
use Money\Exchange;
use Money\Provider\Local;
use Money\Currency;

$exchange = new Exchange(new Local(['EUR' => ['USD' => 1.25]]));

$baseCurrency = new Currency('EUR');
$currencyCurrency = new Currency('USD');

$currencyPair = $exchange->getCurrencyPair($baseCurrency, $counterCurrency);

// returns 1.25
$currencyPair->getConversionRate();
```

You can use this extension to create `CurrencyPair`s with conversion rate from a third party source. Currently (WIP) the following `Provider`s are availaible:

- Local (array)
- Batch
- Yahoo Finance
- [Open Exchange Rates](https://openexchangerates.org)
- [Rate Exchange (Appspot)](http://rate-exchange.appspot.com)
- [Currency API (Appspot)](http://currency-api.appspot.com)
- [WebserviceX](http://www.webservicex.net/ws/WSDetails.aspx?CATID=2&WSID=10)
- [European Central Bank](http://www.ecb.europa.eu/home/html/index.en.html)

Most of the providers use third party public APIs.


#### Local

You can store conversion rates locally and use them as an array source using this provider. The array MUST be an associative array of base currencies containing an associative array of rates indexed by counter currencies. Rates MUST be numeric (CAN be string).

``` php
use Money\Provider\Local;

$provider = new Local(['EUR' => ['USD' => 1.25]]);
```

General scheme for array representation:

``` php
[
    'baseCurrency' => [
        'counterCurrency1' => <rate1>,
        'counterCurrency2' => <rate2>,
    ],
]
```

#### Batch

Third party services are not always reliable. With Batch provider you can build up a stack of `Provider`s and try getting the appropriate rate until one is returned.

``` php
use Money\Provider\Batch;
use Money\Provider\Local;

$provider = new Batch;
$provider->addProvider(new Local(['EUR' => ['USD' => 1.25]]));
```


## Testing

``` bash
$ phpspec run
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/money/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
