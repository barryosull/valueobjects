<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class EmailAddress extends AbstractSingleValue
{        
    protected function validator()
    {
        return Validator::Email();
    }
}
