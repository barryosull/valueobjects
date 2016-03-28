<?php

namespace EventSourced\ValueObject\ValueObject;

class Boolean extends Type\AbstractSingleValue 
{    
    protected function validator()
    {
        return parent::validator()->boolType();
    }
    
    public function true()
    {
        return $this->value();
    }
    
    public function false()
    {
        return !$this->value(); 
    }
}
