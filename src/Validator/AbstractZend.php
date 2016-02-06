<?php

namespace EventSourced\Validator;

use EventSourced\Contract\Validator;

abstract class AbstractZend implements Validator
{
    private $validator;
    
    public function __construct($validator)
    {
        $this->validator = $validator;
    }
        
    public function is_valid($arguments)
    {
        return $this->validator->isValid($arguments[0]);
    }

    public function error_message()
    {
        return join(", ", $this->validator->getMessages());
    }
}
