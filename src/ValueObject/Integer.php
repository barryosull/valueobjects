<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Integer extends AbstractSingleValue 
{    
    public function __construct($value) 
	{
        $this->assert()->is(Validator\Integer::class, [$value]);
        parent::__construct($value);
    }
}
