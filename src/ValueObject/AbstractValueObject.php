<?php

namespace EventSourced\ValueObject;

use EventSourced\Contract;
use EventSourced\Assert;

abstract class AbstractValueObject implements Contract\ValueObject
{	
    private static $assert;
    
    public function equals(Contract\ValueObject $valueobject) 
	{
		return $this->serialize() == $valueobject->serialize();
	}
    
    protected function assert()
    {
        self::$assert = self::$assert ?: new Assert();
        return self::$assert;
    }
}