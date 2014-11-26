<?php

/*
 * This file is part of the Indigo Money package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Money\Exception;

use Money\Currency;

/**
 * Thrown when a currency is not supported by a provider
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class UnsupportedCurrency extends \InvalidArgumentException
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;

        parent::__construct(sprintf('The currency "%s" is not supported', $currency->getCode()));
    }

    /**
     * Returns the Currency
     *
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
