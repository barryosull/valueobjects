<?php

namespace EventSourced\Validator;

use Respect\Validation\Rules\AbstractRule;

class GreaterThanOrEqual extends AbstractRule
{
    private $number;
    
    public function __construct($number)
    {
        $this->number = $number;
    }
    
    public function validate($number)
    {
        return $number->is_greater_than($this->number) || ($number->equals($this->number));
    }
}