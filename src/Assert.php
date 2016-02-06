<?php

namespace EventSourced;

class AssertException extends \Exception {}

class Assert 
{        
    public function is($class, $arguments) 
    {
        $validator = DI::make($class);
        if (!$validator->is_valid($arguments)) {
            throw new AssertException("Invariant $class error: [".join(", ", $arguments)."] is invalid. ".$validator->error_message());
        }
    }
    
    public function not($class, $arguments) 
    {
        $validator = DI::make($class);
        if ($validator->is_valid($arguments)) {
            throw new AssertException("Invariant $class error: [".join(", ", $arguments)."] is valid");
        }
    }
}
