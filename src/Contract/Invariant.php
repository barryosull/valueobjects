<?php

namespace EventSourced\Contract;

interface Invariant 
{
    public function is_satisfied_by($arguments);
}
