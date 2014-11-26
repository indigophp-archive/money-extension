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
     * @var Provider[]
     */
    private $providers = [];

    /**
     * Adds a Provider to the stack
     *
     * @param Provider $provider
     */
    public function addProvider(Provider $provider)
    {
        if (!$this->hasProvider($provider)) {
            $this->providers[] = $provider;
        }
    }

    /**
     * Checks if the Provider exists in the stack
     *
     * @param Provider $provider
     *
     * @return boolean
     */
    public function hasProvider(Provider $provider)
    {
        return in_array($provider, $this->providers, true);
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
        $rate = 1;

        if (!$baseCurrency->equals($counterCurrency)) {
            $rate = $this->getRate($baseCurrency, $counterCurrency);
        }

        return new CurrencyPair($baseCurrency, $counterCurrency, $rate);
    }

    /**
     * Returns the rate
     *
     * @param Currency $baseCurrency
     * @param Currency $counterCurrency
     *
     * @return numeric
     */
    private function getRate(Currency $baseCurrency, Currency $counterCurrency)
    {
        foreach ($this->providers as $provider) {
            try {
                $rate = $provider->getRate($baseCurrency, $counterCurrency);
            } catch (Exception\UnsupportedCurrency $e) { }
        }

        if (!isset($rate)) {
            // we don't have a rate
            // either because no provider added or no provider supported one of the currencies
        }

        return $rate;
    }
}
