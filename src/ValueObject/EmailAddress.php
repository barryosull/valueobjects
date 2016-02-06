<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class EmailAddress extends AbstractSingleValue
{    
    public function __construct($value) 
	{
        $this->assert()->is(Validator\EmailAddress::class, [$value]);
        parent::__construct($value);
    }
}
