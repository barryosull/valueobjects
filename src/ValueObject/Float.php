<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Float extends AbstractSingleValue 
{    
    protected function validator_class()
    {
        return Validator\Float::class;
    }
}
