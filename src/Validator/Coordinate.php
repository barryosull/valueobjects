<?php

namespace EventSourced\Validator;

use EventSourced\Validator;

class Coordinate extends AbstractWrapper
{
    public function __construct()
    {
        $validator = (new Validator\Float())
            ->and_x(new Validator\GreaterThanOrEqual(-90))
            ->and_x(new Validator\LessThanOrEqual(90));
        
        parent::__construct($validator);
    }
}
