<?php

/*
 * This file is part of the Indigo Money package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Money\Formatter;

use Money\Money;
use Money\Formatter;
use NumberFormatter;

/**
 * International formatter
 *
 * Can be used with ISO Currencies
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Intl implements Formatter
{
    /**
     * @var NumberFormatter
     */
    private $numberFormatter;

    /**
     * @param string $locale
     */
    public function __construct($locale)
    {
        $this->numberFormatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
    }

    /**
     * Returns the NumberFormatter
     *
     * We expose it to be able to extend its functionality
     *
     * @return NumberFormatter
     */
    public function getNumberFormatter()
    {
        return $this->numberFormatter;
    }

    /**
     * {@inheritdoc}
     */
    public function format(Money $money)
    {
        return $this->numberFormatter->formatCurrency(
            $money->getAmount(),
            $money->getCurrency()->getCode()
        );
    }
}
