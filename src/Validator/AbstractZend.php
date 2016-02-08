<?php

namespace EventSourced\Validator;

abstract class AbstractZend extends AbstractComposite
{
    private $zend_validator;
    
    public function __construct($validator)
    {
        $this->zend_validator = $validator;
    }
        
    public function is_satisfied_by($arguments)
    {
        return $this->zend_validator->isValid($arguments[0]);
    }
}
