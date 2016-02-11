<?php

namespace EventSourced\ValueObject;

abstract class AbstractEntity extends AbstractComposite
{	
    private $id;
    
    public function __construct()
    {
        $this->id = func_get_args()[0];
        parent::__construct(func_get_args());
    }
    
    public function id() 
    {
        return $this->id;
    }
}