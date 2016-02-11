<?php

namespace EventSourced\ValueObject;

abstract class AbstractEntity extends AbstractComposite
{	
    private $id;
    
    public function __construct()
    {
        $this->id = func_get_arg(0);
        $args = func_get_args();
        parent::__construct(...$args);
    }
    
    public function id() 
    {
        return $this->id;
    }
}