<?php

namespace EventSourced\Specification;

use EventSourced\Contract\Specification;

abstract class AbstractComposite implements Specification
{
    public function and_x(Specification $specification)
    {
        return new AndX($this, $specification);
    }

    public function or_x(Specification $specification)
    {
        return new OrX($this, $specification);
    }

    public function not(Specification $specification)
    {
        return new Not($specification);
    }
}
