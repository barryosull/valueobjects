<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class CurrencyCode extends AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::currencyCode();
    }
}
