<?php

namespace EventSourced;

class AssertException extends \Exception {}

class Assert 
{        
    public function is($class, $arguments) 
    {
        $validator = DI::make($class);
        if (!$validator->is_valid($arguments)) {
            throw new AssertException("$class: \n".$validator->error_message());
        }
    }
    
    public function not($class, $arguments) 
    {
        $validator = DI::make($class);
        if ($validator->is_valid($arguments)) {
            throw new AssertException("$class: [".join(", ", $arguments)."] was considered valid");
        }
    }
}
