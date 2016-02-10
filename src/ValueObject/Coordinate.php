<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Coordinate extends AbstractSingleValue 
{    
    protected function validator()
    {
        return (new Validator\Float())
            ->and_x(new Validator\GreaterThanOrEqual(-90))
            ->and_x(new Validator\LessThanOrEqual(90));
    }
}
