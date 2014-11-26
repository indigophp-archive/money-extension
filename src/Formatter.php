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
 * Can be used to format Money objects
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Formatter
{
    /**
     * Formats a Money object into a string
     *
     * @param Money $money
     *
     * @return string
     */
    public function format(Money $money);
}
