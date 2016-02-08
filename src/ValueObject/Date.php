<?php

namespace EventSourced\ValueObject;

use EventSourced\Validator;

class Date extends AbstractSingleValue 
{    
    protected function validator_class()
    {
        return Validator\Date::class;
    }
    
    public function add_seconds(Integer $seconds)
    {
        $new_unix_time = strtotime($this->value) + $seconds->value;
        return new Date(date("Y-m-d H:i:s", $new_unix_time));
    }
}
