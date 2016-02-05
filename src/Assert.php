<?php

namespace EventSourced;

class Assert 
{        
    public function is($class, $arguments) 
    {
        $invariant = DI::make($class);
        if (!$invariant->is_satisfied_by($arguments)) {
            throw new \Exception("Invariant $class error: ["+join(", ", $arguments)+"] is invalid");
        }
    }
    
    public function not($class, $arguments) 
    {
        $invariant = DI::make($class);
        if ($invariant->is_satisfied_by($arguments)) {
            throw new \Exception("Invariant $class error: ["+join(", ", $arguments)+"] is valid");
        }
    }
}
