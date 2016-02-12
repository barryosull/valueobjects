<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class AscendingIntegerCollection  extends AbstractOrderedCollection 
{    
    public function collection_of_class()
    {
        return Integer::class;
    }
    
    protected function order_validator($preceding_value)
    {
        Validator::with('EventSourced\\ValueObject\\Validator\\');
        return Validator::GreaterThanOrEqual($preceding_value);
    }
}
