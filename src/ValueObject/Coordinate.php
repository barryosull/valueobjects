<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Coordinate extends AbstractSingleValue 
{    
    protected function validator_class()
    {
        return Validator\Coordinate::class;
    }
}
