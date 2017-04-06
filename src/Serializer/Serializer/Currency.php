<?php

namespace EventSourced\ValueObject\Serializer\Serializer;

class Currency
{
    public function serialize(\Money\Currency $currency)
    {
        return $currency->getCode();
    }
}
