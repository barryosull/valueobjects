<?php

namespace EventSourced\ValueObject;

use EventSourced\Invariant;

class Coordinate extends AbstractSingleValue 
{    
    public function __construct($value) 
	{
        $this->assert()->is(Invariant\Coordinate::class, [$value]);
        parent::__construct($value);
    }
}
