<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Float extends AbstractSingleValue 
{    
    protected function validator()
    {
        return new Validator\Float();
    }
}
