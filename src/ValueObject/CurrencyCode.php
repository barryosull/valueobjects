<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class CurrencyCode extends Type\AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::currencyCode();
    }
}
