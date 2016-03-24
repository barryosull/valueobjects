<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;

class Integer extends Type\AbstractSingleValue
{    
    protected function validator()
    {
        return Validator::intVal();
    }
    
    public function is_greater_than(Integer $integer)
    {
        return $this->value > $integer->value;
    }
}
