<?php

namespace EventSourced\Validator;

class Integer extends AbstractValidator
{    
    public function is_satisfied_by($value)
    {
        return is_numeric($value) && (int)$value == $value;
    }
}
