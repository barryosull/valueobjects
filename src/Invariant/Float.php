<?php

namespace EventSourced\Invariant;

use EventSourced\Contract\Invariant;

class Float implements Invariant
{   
    public function is_satisfied_by($arguments)
    {   
        return is_numeric($arguments[0]);
    }
}
