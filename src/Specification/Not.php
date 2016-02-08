<?php

namespace EventSourced\Specification;

class Not extends Wrapped
{
    public function is_satisfied_by($value)
    {
        return !parent::is_satisfied_by($value);
    }

    public function error_message()
    {
        
    }
}
