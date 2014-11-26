<?php

namespace spec\Money\Formatter;

use Money\Money;
use PhpSpec\ObjectBehavior;

class IntlSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('en_US');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Formatter\Intl');
        $this->shouldHaveType('Money\Formatter');
    }

    function it_should_have_number_formatter()
    {
        $this->getNumberFormatter()->shouldHaveType('NumberFormatter');
    }

    function it_should_be_able_to_format_a_value()
    {
        $money = Money::USD(1234);

        $this->format($money)->shouldReturn('$1,234.00');
    }
}
