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
 * Create a batch of multiple providers
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Batch implements Provider
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
     * Returns the rate
     *
     * @param Currency $baseCurrency
     * @param Currency $counterCurrency
     *
     * @return numeric
     */
    public function getRate(Currency $baseCurrency, Currency $counterCurrency)
    {
        if (empty($this->providers)) {
            throw new \RuntimeException('No providers added');
        }

        foreach ($this->providers as $provider) {
            try {
                $rate = $provider->getRate($baseCurrency, $counterCurrency);
            } catch (UnsupportedCurrency $e) {
                // move to the next provider if available
            }
        }

        if (!isset($rate)) {
            if (isset($e)) {
                throw $e;
            }

            throw new \RuntimeException('Rate could not be determined');
        }

        return $rate;
    }
}
