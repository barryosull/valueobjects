<?php

namespace EventSourced\ValueObject;

use EventSourced\Contract\ValueObject\ValueObject;

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
    
    public function equals(ValueObject $other_valueobject)
    {
        return $this->is_same_class($other_valueobject) 
                && $this->id()->equals($other_valueobject->id());
    }
}