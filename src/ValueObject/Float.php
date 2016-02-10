<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Float extends AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator\Float();
    }
}
