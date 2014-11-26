<?php

/*
 * This file is part of the Indigo Money package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Money\Provider;

use Money\Provider;
use Money\Currency;
use Money\Exception\UnsupportedCurrency;

/**
 * Provides rates from an array
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Local implements Provider
{
    /**
     * @var array
     */
    private $rates = [];

    /**
     * @param array $rates
     */
    public function __construct(array $rates)
    {
        $this->rates = $rates;
    }

    /**
     * {@inheritdoc}
     */
    public function getRate(Currency $baseCurrency, Currency $counterCurrency)
    {
        $baseCurrencyCode = $baseCurrency->getCode();
        $counterCurrencyCode = $counterCurrency->getCode();

        if (!isset($this->rates[$baseCurrencyCode])) {
            throw new UnsupportedCurrency($baseCurrency);
        }

        if (!isset($this->rates[$baseCurrencyCode][$counterCurrencyCode])) {
            throw new UnsupportedCurrency($counterCurrency);
        }

        return $this->rates[$baseCurrencyCode][$counterCurrencyCode];
    }
}
