<?php

namespace EventSourced\ValueObject;

use Respect\Validation\Validator;

class DateTime extends AbstractSingleValue 
{    
    protected function validator()
    {
        return Validator::Date();
    }
    
    public function add_seconds(Integer $seconds)
    {
        $new_unix_time = strtotime($this->value) + $seconds->value;
        return new DateTime(date("Y-m-d H:i:s", $new_unix_time));
    }
}
