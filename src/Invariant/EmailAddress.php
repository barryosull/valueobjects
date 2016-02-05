<?php

use EventSourced\ValueObject\Invariant;

class EmailAddress implements Invariant
{
    private $validator;
    
    public function __construct(Zend\Validator\EmailAddress $validator) 
    {
        $this->validator = $validator;
    }
    
    public function is_satisfied_by($arguments)
    {
        return $this->validator->isValid($arguments[0]);
    }
}
