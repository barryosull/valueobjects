<?php

namespace EventSourced\ValueObject\Serializer\Serializer;

class Money
{
    public function serialize(\Money\Money $money)
    {
        return [
            'amount' => $money->getAmount(),
            'currency' => $money->getCurrency()->getCode()
        ];
    }
}
