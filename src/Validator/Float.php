<?php

namespace EventSourced\Validator;

use EventSourced\Contract\Validator;

class Float implements Validator
{
    private $value;
    
    public function error_message()
    {
        return "'$this->value' is not a valid float";
    }

    public function is_valid($arguments)
    {
        $this->value = $arguments[0];
        return is_numeric($arguments[0]);
    }

}
