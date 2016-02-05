<?php

namespace EventSourced\Invariant;

use EventSourced\Contract\Invariant;

class Coordinate implements Invariant
{
    private $float;
    private $less_than;
    private $greater_than;
    
    public function __construct(){
        $this->float = new Float();
        $this->less_than = new \Zend\Validator\LessThan(['max' => 90, 'inclusive' => true]);
        $this->greater_than = new \Zend\Validator\GreaterThan(['min' => -90, 'inclusive' => true]);
    }
    
    public function is_satisfied_by($arguments)
    {
        $float = (float)$arguments[0];
        return ($this->float->is_satisfied_by([$float])
            && $this->less_than->isValid($float)
            && $this->greater_than->isValid($float));
    }
}
