<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;

class Uuid extends Type\AbstractSingleValue implements Identifier
{    
    protected function validator()
    {
        return Validator::regex('/([a-f\d]{8}(-[a-f\d]{4}){3}-[a-f\d]{12}?)/i');
    }

    public function is_null()
    {
        return $this->equals(new Uuid('00000000-0000-0000-0000-000000000000'));
    }
}
