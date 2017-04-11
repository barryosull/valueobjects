<?php

namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Money\Currency;

class SampleCountry extends AbstractComposite
{
    protected $name;
    protected $currency;

    public function __construct(NotBlankString $name, Currency $currency)
    {
        $this->name = $name;
        $this->currency = $currency;
    }

    public function name()
    {
        return $this->name;
    }

    public function currency()
    {
        return $this->currency;
    }
}
