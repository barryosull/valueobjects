<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class EmailAddress extends AbstractSingleValue
{        
    protected function validator_class()
    {
        return Validator\EmailAddress::class;
    }
}
