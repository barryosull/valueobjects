<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

abstract class AbstractAscendingCollection extends AbstractOrderedCollection
{
    protected function order_validator_class()
    {
       return Validator\GreaterThan::class;
    }
}
