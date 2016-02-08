<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Integer extends AbstractSingleValue 
{    
    protected function validator_class()
    {
        return Validator\Integer::class;
    }
}
