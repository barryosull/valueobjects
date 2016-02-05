<?php

namespace EventSourced\ValueObject;

use EventSourced\Invariant;

class EmailAddress extends AbstractSingleValue
{    
    public function __construct($value) 
	{
        $this->assert()->is(Invariant\EmailAddress::class, [$value]);
        parent::__construct($value);
    }
}
