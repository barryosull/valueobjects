<?php

namespace EventSourced\Validator;

abstract class AbstractEnum extends AbstractValidator
{    
    public function is_satisfied_by($value)
    {
        return in_array($value, $this->enums());
    }
    
    abstract protected function enums();
}
