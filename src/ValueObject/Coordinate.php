<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;

class Coordinate extends Type\AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::floatVal()->between(-90, 90);
    }
}
