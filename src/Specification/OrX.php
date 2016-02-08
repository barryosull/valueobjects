<?php

namespace EventSourced\Specification;

class OrX extends AndX
{
    public function is_satisfied_by($value)
    {
        return $this->x->is_satisfied_by($value) || $this->y->is_satisfied_by($value);
    }
}