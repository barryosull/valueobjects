<?php

namespace EventSourced\Validator;

class Date extends AbstractValidator
{ 
    public function is_satisfied_by($value)
    {
        return strtotime($value) !== false;
    }
}
