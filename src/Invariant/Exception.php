<?php

namespace EventSourced\Invariant;

class Exception extends \Exception 
{
    private $value;
    private $valueobject_class;
    
    public function __construct($value, $valueobject_class)
    {
        $this->value = $value;
        $this->valueobject_class = $valueobject_class;
        parent::__construct("", 0, null);
    }
    
    public function value()
    {
        return $this->value;
    }
    
    public function valueobject_class()
    {
        return $this->valueobject_class;
    }
}