<?php

namespace EventSourced\Validator;

class GreaterThanOrEqual extends AbstractZend
{
    private $validator;
    
    public function __construct($min)
    {
        parent::__construct( 
            new \Zend\Validator\GreaterThan(['min' => $min, 'inclusive' => true])
        );
    }
}
