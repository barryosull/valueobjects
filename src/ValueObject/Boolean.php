<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;

class Boolean extends Type\AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::boolType();
    }
    
    public function true()
    {
        return $this->value();
    }
    
    public function false()
    {
        return !$this->value(); 
    }
}
