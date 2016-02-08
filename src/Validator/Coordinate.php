<?php

namespace EventSourced\Validator;

use EventSourced\Contract;
use EventSourced\Validator;
use EventSourced\Specification\Wrapper;

class Coordinate extends Wrapper implements Contract\Validator
{
    public function __construct()
    {
        $validator = (new Validator\Float())
            ->and_x(new Validator\GreaterThanOrEqual(-90))
            ->and_x(new Validator\LessThanOrEqual(90));
        
        parent::__construct($validator);
    }
}
