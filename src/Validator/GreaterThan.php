<?php

namespace EventSourced\Validator;

class GreaterThan extends AbstractZend
{    
    public function __construct($min)
    {
        parent::__construct( 
            new \Zend\Validator\GreaterThan(['min' => $min, 'inclusive' => false])
        );
    }
}
