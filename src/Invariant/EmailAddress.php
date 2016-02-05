<?php

namespace EventSourced\Invariant;

use EventSourced\Contract\Invariant;

class EmailAddress implements Invariant
{
    private $validator;
    
    public function __construct(\Zend\Validator\EmailAddress $validator) 
    {
        $this->validator = $validator;
    }
    
    public function is_satisfied_by($arguments)
    {
        return $this->validator->isValid($arguments[0]);
    }
}
