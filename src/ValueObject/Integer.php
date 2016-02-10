<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Integer extends AbstractSingleValue 
{    
    protected function validator()
    {
        return new Validator\Integer();
    }
}
