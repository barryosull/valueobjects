<?php

use EventSourced\ValueObject\Invariant;

class Coordinate implements Invariant
{
    private $float;
    private $less_than;
    private $greater_than;
    
    public function __construct(
        Zend\I18n\Validator\IsFloat $float,
        Zend\Validator\LessThan $less_than,
        Zend\Validator\GreaterThan $greater_than
    ){
        $this->float = $float;
        $this->less_than = $less_than;
        $this->greater_than = $greater_than;
    }
    
    public function is_satisfied_by($arguments)
    {
        return ($this->float->isValid($arguments[0])
            && $this->less_than->isValid($arguments[0])
            && $this->greater_than->isValid($arguments[0]));
    }
}
