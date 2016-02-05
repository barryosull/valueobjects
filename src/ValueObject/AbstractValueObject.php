<?php

namespace EventSourced\ValueObject\ValueObject;

use EventSourced\ValueObject\Contract;

use EventSourced\ValueObject\Assert;

abstract class AbstractValueObject implements Contract\ValueObject
{	
    protected $assert;
    
    public function equals(ValueObject $valueobject) 
	{
		return $this->serialize() == $valueobject->serialize();
	}
    
    protected function assert()
    {
        $this->assert = $this->assert ?: new Assert();
        return $this->assert;
    }
}