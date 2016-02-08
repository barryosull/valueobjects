<?php

namespace EventSourced\Specification;

use EventSourced\Contract\Specification;

class Wrapper extends AbstractComposite
{
    protected $wrapped;

    public function __construct(Specification $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function is_satisfied_by($value)
    {
        return $this->wrapped->is_satisfied_by($value);
    }
}