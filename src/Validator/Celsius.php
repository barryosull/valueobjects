<?php

namespace EventSourced\Validator;

class Celsius extends AbstractWrapper
{    
    public function compostite_validator()
    {
        return (new Float())
            ->and_x(new GreaterThanOrEqual(-100))
            ->and_x(new LessThanOrEqual(100));
    }
}
