<?php

namespace EventSourced\Validator;

class Coordinate extends AbstractWrapper
{
    protected function compostite_validator()
    {
        return (new Float())
            ->and_x(new GreaterThanOrEqual(-90))
            ->and_x(new LessThanOrEqual(90));
    }
}
