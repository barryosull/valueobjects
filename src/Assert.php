<?php

namespace EventSourced\ValueObject;

use App;

class Assert 
{        
    public function is($class, $arguments) 
    {
        $invariant = App::make($class);
        if (!$invariant->is_satisfied_by($arguments)) {
            throw new \Exception();
        }
    }
    
    public function not($class, $arguments) 
    {
        $invariant = App::make($class);
        if ($invariant->is_satisfied_by($arguments)) {
            throw new \Exception();
        }
    }
}
