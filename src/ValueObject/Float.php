<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class Float extends AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::floatVal();
    }
}
