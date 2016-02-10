<?php

namespace EventSourced\Validator;

abstract class AbstractZend extends AbstractValidator
{
    private $zend_validator;
    
    public function __construct($validator)
    {
        $this->zend_validator = $validator;
    }
        
    public function is_satisfied_by($value)
    {
        return $this->zend_validator->isValid($value);
    }
}
