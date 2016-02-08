<?php

namespace EventSourced\Contract;

interface Specification 
{
    public function is_satisfied_by($arguments);
}
