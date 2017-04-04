<?php

namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use Money\Money;

class SampleSellable extends AbstractComposite
{
    protected $name;
    protected $price;

    public function __construct(
        NotBlankString $name,
        Money $price
    ) {
        $this->name = $name;
        $this->price = $price;
    }

    public function name()
    {
        return $this->name;
    }

    public function price()
    {
        return $this->price;
    }
}
