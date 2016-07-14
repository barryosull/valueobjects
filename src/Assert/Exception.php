<?php

namespace EventSourced\ValueObject\Assert;

class Exception extends \Exception 
{
    private $value;
    private $valueobject_class;
    
    public function __construct($value, $valueobject_class)
    {
        $this->value = is_object($value) ? get_class($value) : $value;
        $this->valueobject_class = $valueobject_class;
        $message = "'$this->value' is not a valid value for ValueObject '$valueobject_class'";
        parent::__construct($message, 0, null);
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