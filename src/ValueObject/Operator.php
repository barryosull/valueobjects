<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;

class Operator extends Type\AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::in([
                '<',
                '>',
                'equals',
                '+',
                '-',
                'is',
                'or',
                'and'
        ]);
    }
}
