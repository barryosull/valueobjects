<?php

namespace EventSourced\Validator;

class ClassType extends AbstractValidator
{    
    private $class_type;
    
    public function __construct($class_type)
    {
        $this->class_type = $class_type;
    }
    
    public function is_satisfied_by($value)
    {
        return is_object($value) && get_class($value) == $this->class_type;
    }
}
