<?php

namespace EventSourced\ValueObject\ValueObject\Type;

use EventSourced\ValueObject\ValueObject\Uuid;
use EventSourced\ValueObject\Contracts\ValueObject;

abstract class AbstractEntity extends AbstractComposite
{	
    protected $id;
    
    public function __construct(Uuid $id)
    {
        $this->id = $id;
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