<?php

namespace EventSourced\Specification;

use EventSourced\Contract\Specification;

class AndX extends AbstractComposite
{
    protected $x;
    protected $y;

    public function __construct(Specification $x, Specification $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function is_satisfied_by($value)
    {
        return $this->x->is_satisfied_by($value) && $this->y->is_satisfied_by($value);
    }

    public function error_message()
    {
        
    }

}