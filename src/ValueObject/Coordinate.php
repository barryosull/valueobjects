<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Coordinate extends AbstractSingleValue 
{    
    public function __construct($value) 
	{
        $this->assert()->is(Validator\Coordinate::class, [$value]);
        parent::__construct($value);
    }
}
