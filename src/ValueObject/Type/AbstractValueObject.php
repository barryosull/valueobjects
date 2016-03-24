<?php

namespace EventSourced\ValueObject\ValueObject\Type;

use EventSourced\ValueObject\Contracts\ValueObject;
use EventSourced\ValueObject\Assert\Assert;

abstract class AbstractValueObject implements ValueObject
{	    
    protected function is_same_class(ValueObject $valueobject) 
	{
		return (get_class($this) == get_class($valueobject));
	}
    
    protected function assert()
    {
        return new Assert(get_called_class());
    }
}