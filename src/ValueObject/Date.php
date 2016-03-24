<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;

class Date extends Type\AbstractSingleValue 
{    
    public function __construct($value)
    {
        parent::__construct(substr($value, 0, 10));
    }
    
    protected function validator()
    {
        return Validator::Date();
    }
}
