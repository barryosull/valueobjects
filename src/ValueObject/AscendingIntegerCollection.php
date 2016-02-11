<?php

namespace EventSourced\ValueObject;

class AscendingIntegerCollection  extends AbstractOrderedCollection 
{    
    protected function collection_of_class()
    {
        return Integer::class;
    }
    
    protected function order_validator_class()
    {
       return Validator\GreaterThan::class;
    }
}
