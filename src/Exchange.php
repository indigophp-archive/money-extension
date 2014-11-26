<?php

/*
 * This file is part of the Indigo Money package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Money;

/**
 * Creates a CurrencyPair from two Currencies and their rate
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Exchange
{
    /**
     * @var Provider
     */
    private $provider;

    /**
     * @param Provider $provider
     */
    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns the Provider
     *
     * @return Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Sets the Provider
     *
     * @param Provider $provider
     */
    public function setProvider(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns a CurrencyPair
     *
     * @param Currency $baseCurrency
     * @param Currency $counterCurrency
     *
     * @return CurrencyPair
     */
    public function getCurrencyPair(Currency $baseCurrency, Currency $counterCurrency)
    {
        $rate = 1.0;

        if (!$baseCurrency->equals($counterCurrency)) {
            $rate = $this->provider->getRate($baseCurrency, $counterCurrency);
        }

        return new CurrencyPair($baseCurrency, $counterCurrency, $rate);
    }
}
