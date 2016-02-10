<?php

namespace EventSourced\Validator;

class Float extends AbstractValidator
{    
    public function is_satisfied_by($value)
    {
        return is_numeric($value);
    }
}
