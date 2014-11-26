<?php

namespace spec\Money;

use Money\Provider;
use Money\Currency;
use PhpSpec\ObjectBehavior;

class ExchangeSpec extends ObjectBehavior
{
    function let(Provider $provider)
    {
        $this->beConstructedWith($provider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Exchange');
    }

    function it_should_have_a_provider(Provider $provider, Provider $anotherProvider)
    {
        $this->getProvider()->shouldReturn($provider);

        $this->setProvider($anotherProvider);

        $this->getProvider()->shouldReturn($anotherProvider);
    }

    function it_should_be_able_to_get_a_currency_pair(Provider $provider)
    {
        $rate = 1.25;
        $baseCurrency = new Currency('EUR');
        $counterCurrency = new Currency('USD');

        $provider->getRate($baseCurrency, $counterCurrency)->willReturn($rate);

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
