<?php

namespace EventSourced\ValueObject\ValueObject;

class CurrencyCode extends Type\AbstractSingleValue 
{    
    protected function validator()
    {
        return parent::validator()->currencyCode();
    }
}
