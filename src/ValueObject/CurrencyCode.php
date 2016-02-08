<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class CurrencyCode extends AbstractSingleValue 
{    
    protected function validator_class()
    {
        return Validator\CurrencyCode::class;
    }
}
