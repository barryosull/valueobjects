<?php

namespace EventSourced;

class InvariantException extends \Exception {
    
    private $invariant_class;
    private $invariant_args;
    
    public function __construct($invariant_class, $invariant_args)
    {
        $this->invariant_class = $invariant_class;
        $this->invariant_args = $invariant_args;
        parent::__construct("", 0, null);
    }
    
    public function invariant_class()
    {
        return $this->invariant_class;
    }
    
    public function invariant_arguments()
    {
        return $this->invariant_args;
    }
}
class AssertIsException extends InvariantException {}
class AssertNotException extends InvariantException {}

class Assert 
{        
    public function is($class, $arguments) 
    {
        $validator = DI::make($class);
        if (!$validator->is_satisfied_by($arguments)) {
            throw new AssertIsException($class, $arguments);
        }
    }
    
    public function not($class, $arguments) 
    {
        $validator = DI::make($class);
        if ($validator->is_satisfied_by($arguments)) {
            throw new AssertNotException($class, $arguments);
        }
    }
}
