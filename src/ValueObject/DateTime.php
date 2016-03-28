<?php

namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\Contracts;

class DateTime extends Type\AbstractSingleValue implements Contracts\ValueObject\DateTime
{    
    protected function validator()
    {
        return parent::validator()->Date()->length(11, null);
    }
    
    public function add_seconds(Integer $seconds)
    {
        $new_unix_time = strtotime($this->value) + $seconds->value;
        return new DateTime(date("Y-m-d H:i:s", $new_unix_time));
    }
}
