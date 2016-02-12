<?php

namespace EventSourced\ValueObject;

abstract class AbstractComposite extends AbstractValueObject
{  
    protected $value_objects;
    
    public function __construct()
    {
        $this->value_objects = func_get_args();
    }
}