<?php

namespace EventSourced\Invariant;

class Exception extends \Exception {
    
    private $invariant_class;
    private $invariant_args;
    private $calling_class;
    
    public function __construct($invariant_class, $invariant_args, $calling_class)
    {
        $this->invariant_class = $invariant_class;
        $this->invariant_args = $invariant_args;
        $this->calling_class = $calling_class;
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
    
    public function calling_class()
    {
        return $this->calling_class;
    }
}