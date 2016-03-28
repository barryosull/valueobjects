<?php

namespace EventSourced\ValueObject\ValueObject;

class Operator extends Type\AbstractSingleValue 
{    
    protected function validator()
    {
        return parent::validator()->in([
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
