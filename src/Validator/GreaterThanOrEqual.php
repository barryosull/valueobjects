<?php

namespace EventSourced\Validator;

use EventSourced\Contract\Validator;

class GreaterThanOrEqual implements Validator
{
    private $validator;
    
    public function __construct($min)
    {
        $this->validator = new \Zend\Validator\GreaterThan(['min' => $min, 'inclusive' => true]);
    }
    
    public function error_message()
    {
        return join(", ", $this->validator->getMessages());
    }

    public function is_valid($arguments)
    {
        return $this->validator->isValid(floatval($arguments[0]));
    }

}
