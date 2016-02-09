<?php

namespace EventSourced\Validator;

class Fahrenheit extends AbstractWrapper
{    
    public function compostite_validator()
    {
        return (new Float())
            ->and_x(new GreaterThanOrEqual(-148))
            ->and_x(new LessThanOrEqual(212));
    }
}
