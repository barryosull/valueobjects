<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class Integer extends AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::intVal();
    }
}
