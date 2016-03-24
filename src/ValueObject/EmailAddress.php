<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class EmailAddress extends Type\AbstractSingleValue
{        
    protected function validator()
    {
        return Validator::Email();
    }
}
