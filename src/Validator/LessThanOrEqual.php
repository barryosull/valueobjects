<?php

namespace EventSourced\Validator;

use EventSourced\Contract\Validator;

class LessThanOrEqual implements Validator
{
    private $validator;
    
    public function __construct($max)
    {
        $this->validator = new \Zend\Validator\LessThan(['max' => $max, 'inclusive' => true]);
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
