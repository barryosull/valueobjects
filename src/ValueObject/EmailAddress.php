<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;

class EmailAddress extends Type\AbstractSingleValue
{        
    protected function validator()
    {
        return Validator::Email();
    }
}
