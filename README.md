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

**Note:** Since PSR-0 is (going to be) deprecated, the package now uses a bit weird autoloading config. This is going to be addressed before the first release, however I would like to keep the namespace segregation if possible.


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
