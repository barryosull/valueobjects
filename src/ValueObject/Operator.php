<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class Operator extends AbstractSingleValue 
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
