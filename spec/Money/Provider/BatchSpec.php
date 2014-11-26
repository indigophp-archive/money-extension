<?php

namespace spec\Money\Provider;

use Money\Provider;
use Money\Currency;
use Money\Exception\UnsupportedCurrency;
use PhpSpec\ObjectBehavior;

class BatchSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Provider\Batch');
        $this->shouldHaveType('Money\Provider');
    }

    function it_should_have_providers(Provider $provider)
    {
        $this->hasProvider($provider)->shouldReturn(false);

        $this->addProvider($provider);

        $this->hasProvider($provider)->shouldReturn(true);
    }

    function it_should_be_able_to_get_a_rate(Provider $provider1, Provider $provider2)
    {
        $rate = 1.25;
        $baseCurrency = new Currency('EUR');
        $counterCurrency = new Currency('USD');

        $exception = new UnsupportedCurrency($baseCurrency);

        $provider1->getRate($baseCurrency, $counterCurrency)->willThrow($exception);
        $provider2->getRate($baseCurrency, $counterCurrency)->willReturn($rate);

        $this->addProvider($provider1);
        $this->addProvider($provider2);

        $this->getRate($baseCurrency, $counterCurrency)->shouldReturn($rate);
    }
}
