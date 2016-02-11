<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class Coordinate extends AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::floatVal()->between(-90, 90);
    }
}
