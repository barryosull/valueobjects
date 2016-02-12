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
       return Validator::floatVal()->min($preceding_value);
    }
}
