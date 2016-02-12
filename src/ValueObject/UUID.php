<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class UUID extends AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::regex('/([a-f\d]{8}(-[a-f\d]{4}){3}-[a-f\d]{12}?)/i');
    }
    
    public function to_string()
    {
        return $this->value;
    }
}
