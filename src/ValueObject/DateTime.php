<?php

namespace EventSourced\ValueObject\ValueObject;

use Respect\Validation\Validator;
use EventSourced\ValueObject\Contracts;

class DateTime extends Type\AbstractSingleValue implements Contracts\ValueObject\DateTime
{    
    protected function validator()
    {
        return Validator::Date()->length(11, null);
    }
    
    public function add_seconds(Integer $seconds)
    {
        $new_unix_time = strtotime($this->value) + $seconds->value;
        return new DateTime(date("Y-m-d H:i:s", $new_unix_time));
    }
}
