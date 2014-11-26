<?php

namespace spec\Money\Exception;

use Money\Currency;
use PhpSpec\ObjectBehavior;

class UnsupportedCurrencySpec extends ObjectBehavior
{
    function let()
    {
        $currency = new Currency('EUR');

        $this->beConstructedWith($currency);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Exception\UnsupportedCurrency');
        $this->shouldHaveType('InvalidArgumentException');
    }

    function it_should_have_a_currency()
    {
        $currency = new Currency('EUR');

        $this->getCurrency()->equals($currency)->shouldReturn(true);
    }
}
