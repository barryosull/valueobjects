<?php

namespace EventSourced\Validator;

class EmailAddress extends AbstractZend
{ 
    public function __construct() 
    {
        parent::__construct(new \Zend\Validator\EmailAddress());
    }
}
