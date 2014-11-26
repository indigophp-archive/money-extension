<?php

namespace spec\Money;

use Money\Provider;
use Money\Currency;
use PhpSpec\ObjectBehavior;

class ExchangeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Exchange');
    }

    function it_should_be_able_to_add_a_provider(Provider $provider)
    {
        $this->hasProvider($provider)->shouldReturn(false);

        $this->addProvider($provider);

        $this->hasProvider($provider)->shouldReturn(true);
    }

    function it_should_be_able_to_get_a_currency_pair(Provider $provider)
    {
        $rate = 1.25;
        $baseCurrency = new Currency('EUR');
        $counterCurrency = new Currency('USD');

        $provider->getRate($baseCurrency, $counterCurrency)->willReturn($rate);
        $this->addProvider($provider);

        $currencyPair = $this->getCurrencyPair($baseCurrency, $counterCurrency);

        $currencyPair->getConversionRatio()->shouldReturn($rate);
    }

    function it_should_be_able_to_get_a_currency_pair_for_same_currencies()
    {
        $currency = new Currency('EUR');

        $currencyPair = $this->getCurrencyPair($currency, $currency);

        $currencyPair->getConversionRatio()->shouldReturn(1.0);
    }
}
