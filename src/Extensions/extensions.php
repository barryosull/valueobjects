<?php

return [
    \Money\Money::class =>
        \EventSourced\ValueObject\Extensions\Serializers\Money::class,

    \Money\Currency::class =>
        \EventSourced\ValueObject\Extensions\Serializers\Currency::class,

    \Carbon\Carbon::class =>
        \EventSourced\ValueObject\Extensions\Serializers\Carbon::class
];
