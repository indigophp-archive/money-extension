<?php

namespace spec\Money\Provider;

use Money\Currency;
use PhpSpec\ObjectBehavior;

class LocalSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([
            'EUR' => ['USD' => 1.25],
            'USD' => ['EUR' => 0.8],
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Provider\Local');
        $this->shouldHaveType('Money\Provider');
    }

    function it_should_be_able_to_get_a_rate()
    {
        $rate = 1.25;
        $baseCurrency = new Currency('EUR');
        $counterCurrency = new Currency('USD');

        $this->getRate($baseCurrency, $counterCurrency)->shouldReturn($rate);
    }
}
