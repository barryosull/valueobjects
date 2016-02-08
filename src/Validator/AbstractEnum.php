<?php

namespace EventSourced\Validator;

abstract class AbstractEnum extends AbstractComposite
{
    private $enums;
    
    public function __construct($enums) 
    {
        $this->enums = $enums;
    }
    
    public function is_satisfied_by($arguments)
    {
        return in_array($arguments[0], $this->enums);
    }
}
