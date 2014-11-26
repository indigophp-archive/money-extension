<?php

namespace spec\Money\Formatter;

use Money\Formatter;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubunitSpec extends ObjectBehavior
{
    function let(Formatter $formatter)
    {
        $this->beConstructedWith($formatter, 2);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Formatter\Subunit');
        $this->shouldHaveType('Money\Formatter');
    }

    function it_should_throw_an_exception_when_subunit_is_invalid(Formatter $formatter)
    {
        $this->shouldThrow('InvalidArgumentException')->during('__construct', [$formatter, -1]);
    }

    function it_should_be_able_to_format_a_value(Formatter $formatter)
    {
        $money = Money::USD(123456);

        $formatter->format(Argument::type('Money\Money'))->will(function($args) {
            return number_format($args[0]->getAmount(), 2);
        });

        $this->format($money)->shouldReturn('1,234.56');
    }
}
