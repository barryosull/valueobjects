<?php

namespace EventSourced\ValueObject;

use EventSourced\Contract;
use EventSourced\Assert\Assert;

abstract class AbstractValueObject implements Contract\ValueObject
{	
    private static $asserts;
    
    public function equals(Contract\ValueObject $valueobject) 
	{
		return $this->serialize() == $valueobject->serialize();
	}
    
    protected function assert()
    {
        return new Assert(get_called_class());
    }
}