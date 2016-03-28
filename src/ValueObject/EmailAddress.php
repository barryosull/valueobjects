<?php

namespace EventSourced\ValueObject\ValueObject;

class EmailAddress extends Type\AbstractSingleValue
{        
    protected function validator()
    {
        return parent::validator()->Email();
    }
}
