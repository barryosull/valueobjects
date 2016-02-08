<?php

namespace EventSourced\Validator;

class LessThanOrEqual extends AbstractZend
{    
    public function __construct($max)
    {
        parent::__construct( 
            new \Zend\Validator\LessThan(['max' => $max, 'inclusive' => true])
        );
    }
}
