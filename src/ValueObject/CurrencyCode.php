<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class CurrencyCode extends AbstractSingleValue 
{    
    protected function validator()
    {
        return new Validator\CurrencyCode();
    }
}
