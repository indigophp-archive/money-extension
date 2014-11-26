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
 * Returns rates for currency pair
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Provider
{
    /**
     * Returns the rate
     *
     * @param Currency $baseCurrency
     * @param Currency $counterCurrency
     *
     * @return numeric
     *
     * @throws Exception\UnsupportedCurrency If base or counter currency is not supported
     */
    public function getRate(Currency $baseCurrency, Currency $counterCurrency);
}
