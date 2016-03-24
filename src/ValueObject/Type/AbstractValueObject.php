<?php

namespace EventSourced\ValueObject\Type;

use EventSourced\Contract\ValueObject;
use EventSourced\Assert\Assert;

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