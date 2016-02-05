<?php

namespace EventSourced\ValueObject\Contract;

interface Invariant 
{
    public function is_satisfied_by($arguments);
}
