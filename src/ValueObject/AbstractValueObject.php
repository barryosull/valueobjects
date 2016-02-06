<?php

namespace EventSourced\ValueObject;

use EventSourced\Contract;
use EventSourced\Assert;

abstract class AbstractValueObject implements Contract\ValueObject
{	
    private $assert;
    
    public function equals(Contract\ValueObject $valueobject) 
	{
		return $this->serialize() == $valueobject->serialize();
	}
    
    protected function assert()
    {
        $this->assert = $this->assert ?: new Assert();
        return $this->assert;
    }
}