<?php

namespace EventSourced\Validator;

class GreaterThanOrEqual extends AbstractZend
{    
    public function __construct($min)
    {
        parent::__construct( 
            new \Zend\Validator\GreaterThan(['min' => $min, 'inclusive' => true])
        );
    }
}
