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

/**
 * Money depends on storing values as integers.
 * In some cases subunits must be introduced to fully store a value
 * This decorator helps handling this case by dividing the amount with tbe subunit
 *
 * This will probably end up with a float value in the Money object therefore we clone it before
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Subunit implements Formatter
{
    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * @var integer
     */
    private $subunit;

    /**
     * @var ReflectionProperty
     */
    private $reflectionProperty;

    /**
     * @param Formatter $formatter
     * @param integer   $subunit
     */
    public function __construct(Formatter $formatter, $subunit)
    {
        if (!is_int($subunit) or $subunit < 1) {
            throw new \InvalidArgumentException('Subunit should be an integer greater than 0');
        }

        $this->formatter = $formatter;
        $this->subunit = $subunit;

        $this->reflectionProperty = new \ReflectionProperty('Money\Money', 'amount');
        $this->reflectionProperty->setAccessible(true);
    }

    /**
     * {@inheritdoc}
     */
    public function format(Money $money)
    {
        $money = clone $money;
        $amount = $money->getAmount() / pow(10, $this->subunit);
        $this->reflectionProperty->setValue($money, $amount);

        return $this->formatter->format($money);
    }
}
