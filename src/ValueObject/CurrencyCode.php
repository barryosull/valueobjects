<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class CurrencyCode extends AbstractSingleValue 
{    
    public function __construct($value) 
	{
        $this->assert()->is(Validator\CurrencyCode::class, [$value]);
        parent::__construct($value);
    }
}
