<?php

namespace EventSourced\Assert;

class Assert 
{        
    private $calling_class;
    
    public function __construct($calling_class) 
    {
        $this->calling_class = $calling_class;
    }
    
    public function is($class, $arguments) 
    {
        $validator = new $class();
        if (!$validator->is_satisfied_by($arguments)) {
            throw new IsException($class, $arguments, $this->calling_class);
        }
    }
    
    public function not($class, $arguments) 
    {
        $validator = new $class();
        if ($validator->is_satisfied_by($arguments)) {
            throw new NotException($class, $arguments, $this->calling_class);
        }
    }
}
