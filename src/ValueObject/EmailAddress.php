<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class EmailAddress extends AbstractSingleValue
{        
    protected function validator()
    {
        return new Validator\EmailAddress();
    }
}
